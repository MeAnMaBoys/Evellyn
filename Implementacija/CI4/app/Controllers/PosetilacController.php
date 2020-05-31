<?php namespace App\Controllers;
/**
 * @author Mladen Jugovic 0502/2017
 */

use App\Models\IzvodjacModel;
use App\Models\OrganizatorModel;
use App\Models\KorisnikModel;
use App\Models\DogadjajModel;
use App\Models\PosetilacModel;
use \Config\Services\EmailModel;
use App\Models\PretplateIzvodjaciModel;
use App\Models\PretplateOrganizatoriModel;
use App\Models\OceneIzvodjacaModel;
use App\Models\OceneDogadjajaModel;



class PosetilacController extends KorisnikController
{
    
    
    /**
     * izvodjac -  prikazuje profil izvodjaca sa funkcijama za pretplacivanje i ocenjivanje
     */
    public function izvodjac(){
        $izv_model = new IzvodjacModel();
        $ocene_izv = new OceneIzvodjacaModel();
        $kor_model=new KorisnikModel();
        $pretplacivanje=new PretplateIzvodjaciModel();

        $id=$_GET['id'];
        $ocene = $ocene_izv->where('izvodjac', $id )->findAll();
        $korisnik=$kor_model->find("$id");
        $izvodjac=$izv_model->find("$id");

        $id_k=$this->session->get('korisnik')->ID_K;
        $pretplate=$pretplacivanje->where('Izvodjac',$izvodjac->ID_K)->where('Posmatrac',$id_k)->findAll();

        $pretplacen=!empty($pretplate);
        $data['korisnik_prikaz']=$korisnik;
        $data['izvodjac_prikaz']=$izvodjac;
        $data['pretplacen']=$pretplacen;
        $data['ocene'] = $ocene;
	return $this->prikaz('posmatrac',$data);
    }
    /**
     * pretplacivanje - funkcija kojom se belezi i upisuje pretplata nad odredjenim izvodjacem u bazu
     */
    
    public function pretplacivanje(){
        $id = $this->request->getVar("id");
        $idp = $this->session->get('korisnik')->ID_K;
        $pretplate = new PretplateIzvodjaciModel();
        $pretplata=$pretplate->where('Izvodjac',$id)->where('Posmatrac',$idp)->findAll();
        if(empty($pretplata)){
            $data = ['Izvodjac'=>$id, 'Posmatrac'=>$idp];
            $pretplate->insert($data);
            echo 'pretplacen';
        }
        else{
            $pretplate->where('Izvodjac',$id)->where('Posmatrac',$idp)->delete();
            echo 'odjavljen';
        }
        //return  redirect()->to(site_url("PosetilacController/izvodjac?id=$id"));
        
    }
    /**
     * pretplacivanje_organizator - funkcija kojom se belezi i upisuje pretplata nad odredjenim organizatorom u bazu
     */
    
    public function pretplacivanje_organizator(){
        $org = $this->request->getVar('id');
        $id = $this->session->get('korisnik')->ID_K;
        $po = new PretplateOrganizatoriModel();
        $pretplata=$po->where('Organizator',$org)->where('Posmatrac',$id)->findAll();
        if(empty($pretplata)){
            $po->insert(['Organizator'=>$org , 'Posmatrac'=>$id]);
            echo 'pretplacen';
        }
        else{
            $po->where('Organizator',$org)->where('Posmatrac',$id)->delete();
            echo 'odjavljen';
        }
    }
    /**
     * ocenjivanje_i - funkcija kojom se belezi/update-uje posetioceva ocena izvodjacu, upisuje u bazu i uracunava u prosek ocena izvodjaca
     */
    
    public function ocenjivanje_i(){
        $ocena = $this->request->getVar('ocena');
        $izv = $this->request->getVar('id');
        $pos = $this->session->get('korisnik')->ID_K;
        if($ocena>5){
            $ocena=5;
        }
        if($ocena<1){
            $ocena=1;
        }
        $oc = new OceneIzvodjacaModel();
        $iz = new IzvodjacModel();
        $izvodjac = $iz->find($izv);
        $stara=$oc->where('Posmatrac',$pos)->where('Izvodjac',$izv)->findAll();
        $data = ['Ocena'=>$ocena, 'Izvodjac'=>$izv , 'Posmatrac'=>$pos];
        //print_r($data);
        if(empty($stara)){
            $izvodjac->Prosek_Ocena= ($izvodjac->Prosek_Ocena*$izvodjac->Broj_Ocena+$ocena) / (++$izvodjac->Broj_Ocena);
            //$userModel->update($id, $data);
            $iz -> update($izv,['Prosek_Ocena' => $izvodjac->Prosek_Ocena , 'Broj_Ocena'=> $izvodjac->Broj_Ocena ]);
            $oc->insert($data);
        }
        else if($ocena!=$stara[0]->Ocena){
            $oc->replace($data);
            $razlika = $ocena - $stara[0]->Ocena;
            $izvodjac->Prosek_Ocena += $razlika / $izvodjac->Broj_Ocena*1.;
            $iz -> update($izv,['Prosek_Ocena' => $izvodjac->Prosek_Ocena]);
        }
        
        
       
        return redirect()->to(site_url("PosetilacController/izvodjac?id=$izv"));
    }
    /**
     * ocenjivanje_d - funkcija kojom se belezi/update-uje posetioceva ocena dogadjaja, upisuje u bazu i uracunava u prosek ocena organizatora
     */
    
    public function ocenjivanje_d(){
        $ocena = $this->request->getVar('ocena');
        $org = new OrganizatorModel();
        $dogadjaj = new DogadjajModel();
        $dog = $this->request->getVar('id');
        $d = $dogadjaj ->find($dog);
        $organizator = $org -> find($d->Organizator);
        
        $pos = $this->session->get('korisnik')->ID_K;

        if($ocena>5){
            $ocena=5;
        }
        if($ocena<1){
            $ocena=1;
        }

        $oc = new OceneDogadjajaModel();


        $data = ['Ocena'=>$ocena, 'ID_Dog'=>$dog , 'Posmatrac'=>$pos ,'Organizator'=>$d ->Organizator];
        $stara=$oc->where('Posmatrac',$pos)->where('ID_Dog',$dog)->findAll();
        if(empty($stara)){
            $oc->insert($data);
            $organizator->Prosek_Ocena= ($organizator->Prosek_Ocena*$organizator->Broj_Ocena+$ocena) / (++$organizator->Broj_Ocena);
            $org -> update($d -> Organizator,['Prosek_Ocena' => $organizator->Prosek_Ocena , 'Broj_Ocena'=> $organizator->Broj_Ocena ]);
        }
        else if($ocena!=$stara[0]->Ocena){
            $oc->replace($data);
            $razlika = $ocena - $stara[0]->Ocena;
            $organizator->Prosek_Ocena += $razlika / $organizator ->Broj_Ocena*1.;
            $org -> update($d -> Organizator,['Prosek_Ocena' => $organizator->Prosek_Ocena ]);
        }
        return redirect()->to(site_url("PosetilacController/dogadjaj?id=$dog"));
    }
    /*
     * * moj_nalog - prikazuje profil posmatraca
     */

    function moj_nalog()
    {
        $korisnik = $this->session->get('korisnik');
        $this->prikaz('nalog_posetilac',['email'=>$korisnik->Email,'username'=>$korisnik->Korisnicko_Ime]);
    }
}



