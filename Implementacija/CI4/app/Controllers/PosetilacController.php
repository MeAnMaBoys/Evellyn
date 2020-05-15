<?php namespace App\Controllers;

use App\Models\IzvodjacModel;
use App\Models\OrganizatorModel;
use App\Models\KorisnikModel;
use App\Models\PosetilacModel;
use \Config\Services\EmailModel;
use App\Models\PretplateIzvodjaciModel;

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
}



