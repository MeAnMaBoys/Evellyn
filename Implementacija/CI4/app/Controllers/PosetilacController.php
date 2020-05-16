<?php namespace App\Controllers;

use App\Models\IzvodjacModel;
use App\Models\OrganizatorModel;
use App\Models\KorisnikModel;
use App\Models\PosetilacModel;
use \Config\Services\EmailModel;
use App\Models\PretplateIzvodjaciModel;
use App\Models\PretplateOgranizatoriModel;
use App\Models\OceneIzvodjacaModel;
use App\Models\OceneDogadjajaModel;



class PosetilacController extends KorisnikController
{

    public function izvodjac(){
        $izv_model = new IzvodjacModel();
        $kor_model=new KorisnikModel();
        $id=$_GET['id'];
        $korisnik=$kor_model->find("$id");
        $izvodjac=$izv_model->find("$id");
        $data['korisnik_prikaz']=$korisnik;
	$data['izvodjac_prikaz']=$izvodjac;
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
        $po = new \App\Models\PretplateOrganizatoriModel();
        $po->insert(['Organizator'=>$org , 'Posmatrac'=>$id]);
        return redirect()->to(site_url("PosetilacController/dogadjaji"));
        
    }
    public function ocenjivanje_i(){
        $ocena = $this->request->getVar('ocena');
        $izv = $this->request->getVar('id');
        $pos = $this->session->get('korisnik')->ID_K;
        $oc = new OceneIzvodjacaModel();
        $data = ['Ocena'=>$ocena, 'Izvodjac'=>$izv , 'Posmatrac'=>$pos];
        $oc->insert($data);
        return redirect()->to(site_url("PosetilacController/izvodjac?id=$izv"));
    }
    
    
    public function ocenjivanje_d(){
        $ocena = $this->request->getVar('ocena');
        $dog = $this->request->getVar('id');
        $pos = $this->session->get('korisnik')->ID_K;
        $oc = new OceneDogadjajaModel();
        $data = ['Ocena'=>$ocena, 'ID_Dog'=>$dog , 'Posmatrac'=>$pos];
        $oc->insert($data);
        return redirect()->to(site_url("PosetilacController/dogadjaj?id=$dog"));
    }





    function moj_nalog()
    {
        $korisnik = $this->session->get('korisnik');
        $this->prikaz('nalog_posetilac',['email'=>$korisnik->Email,'username'=>$korisnik->Korisnicko_Ime]);
    }
}

