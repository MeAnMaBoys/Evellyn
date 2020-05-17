<?php namespace App\Controllers;

use App\Models\IzvodjacModel;
use App\Models\OrganizatorModel;
use App\Models\KorisnikModel;
use App\Models\PosetilacModel;
use \Config\Services\EmailModel;
use App\Models\PretplateIzvodjaciModel;
use App\Models\PretplateOrganizatoriModel;
use App\Models\OceneIzvodjacaModel;
use App\Models\OceneDogadjajaModel;



class PosetilacController extends KorisnikController
{
    public function izvodjac(){
        $izv_model = new IzvodjacModel();
        $kor_model=new KorisnikModel();
        $pretplacivanje=new PretplateIzvodjaciModel();

        $id=$_GET['id'];
        $korisnik=$kor_model->find("$id");
        $izvodjac=$izv_model->find("$id");

        $id_k=$this->session->get('korisnik')->ID_K;
        $pretplate=$pretplacivanje->where('Izvodjac',$izvodjac->ID_K)->where('Posmatrac',$id_k)->findAll();

        $pretplacen=!empty($pretplate);
        $data['korisnik_prikaz']=$korisnik;
        $data['izvodjac_prikaz']=$izvodjac;
        $data['pretplacen']=$pretplacen;
	    return $this->prikaz('posmatrac',$data);
    }
    public function pretplacivanje(){
        $id = $this->request->getVar("id");
        $idp = $this->session->get('korisnik')->ID_K;
        $pretplate = new PretplateIzvodjaciModel();
        $data = ['Izvodjac'=>$id, 'Posmatrac'=>$idp];
        $pretplate->insert($data);
        return  redirect()->to(site_url("PosetilacController/izvodjaci"));
    }
    
    public function pretplacivanje_organizator(){
        $org = $this->request->getVar('id');
        $id = $this->session->get('korisnik')->ID_K;
        $po = new PretplateOrganizatoriModel();
        $po->insert(['Organizator'=>$org , 'Posmatrac'=>$id]);
        return redirect()->to(site_url("PosetilacController/dogadjaji"));
        
    }
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
        $stara=$oc->where('Posmatrac',$pos)->where('Izvodjac',$izv)->findAll();
        $data = ['Ocena'=>$ocena, 'Izvodjac'=>$izv , 'Posmatrac'=>$pos];
        //print_r($data);
        if(empty($stara)){
            $oc->insert($data);
        }
        else if($ocena!=$stara[0]->Ocena){
            $oc->replace($data);
        }

        
       
        return redirect()->to(site_url("PosetilacController/izvodjac?id=$izv"));
    }
    
    
    public function ocenjivanje_d(){
        $ocena = $this->request->getVar('ocena');
        $dog = $this->request->getVar('id');
        $pos = $this->session->get('korisnik')->ID_K;

        if($ocena>5){
            $ocena=5;
        }
        if($ocena<1){
            $ocena=1;
        }

        $oc = new OceneDogadjajaModel();


        $data = ['Ocena'=>$ocena, 'ID_Dog'=>$dog , 'Posmatrac'=>$pos];
        $stara=$oc->where('Posmatrac',$pos)->where('ID_Dog',$dog)->findAll();
        if(empty($stara))
            $oc->insert($data);
        else if($ocena!=$stara[0]->Ocena){
            $oc->replace($data);
        }
        return redirect()->to(site_url("PosetilacController/dogadjaj?id=$dog"));
    }
}



