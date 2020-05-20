<?php namespace App\Controllers;

use App\Models\IzvodjacModel;
use App\Models\OrganizatorModel;
use App\Models\KorisnikModel;
use App\Models\PosetilacModel;
use App\Models\PrijaveKonkursModel;
use App\Models\KonkursModel;
use App\Models\DogadjajModel;
use \Config\Services\Email;
use App\Models\ZahtevNastupanjeModel;
use App\Models\NastupaModel;
use App\Models\PretplateIzvodjaciModel;

class IzvodjacController extends KorisnikController
{
    public function moj_nalog()
    {
        $this->prikaz('moj_nalog_i',[]);
    }
    public function zahtevi(){
        $zn=new ZahtevNastupanjeModel();
        $id=$this->session->get('korisnik')->ID_K;

        $zahtevi=$zn->where('ID_K',$id)->findAll();

        $data=['zahtevi'=>$zahtevi];

        $this->prikaz('zahtevi',$data);
    }
    public function zahtev(){
        $id=$_GET['id'];
        $dm=new DogadjajModel();
        $dogadjaj=$dm->find($id);

        $this->prikaz('zahtev',['dogadjaj'=>$dogadjaj]);
    }
    public function prihvati_zahtev(){
        $id_dog=$this->request->getVar('id');
        $id_k=$this->session->get('korisnik')->ID_K;

        $zn=new ZahtevNastupanjeModel();
        $zahtev=$zn->where('ID_Dog',$id_dog)->where('ID_K',$id_k)->findAll();

        if(sizeof($zahtev)==1){

            $nm=new NastupaModel();
            $nm->insert(['ID_Dog'=>$id_dog,'Izvodjac'=>$id_k]);

            $zn->where('ID_Dog',$id_dog)->where('ID_K',$id_k)->delete();
            $po=new PretplateIzvodjaciModel();
            $posetioci=$po->where('Izvodjac',$id_k)->findAll();

            $kor=new KorisnikModel();
            $izvodjac=$this->session->get('korisnik');
            $dog=new DogadjajModel();
            $dogadjaj=$dog->find($id_dog);
            $path=base_url("gost/dogadjaj?id=$id_dog");
            $link=$path;
            foreach($posetioci as $posetilac){
                $mail=$kor->find($posetilac->Posmatrac)->Email;
                $this->obavesti_posetioce($mail,$izvodjac,$link);
            }
        }

        
        return redirect()->to(site_url("IzvodjacController/moj_nalog"));
    }
    
    public function kacenje_sadrzaja(){
        $this->prikaz('kacenje_sadrzaja',[]);
    }
    public function okaci_sadrzaj(){
        $korisnik=$this->session->get('korisnik');

        $root_path=$_SERVER['DOCUMENT_ROOT'];

        $dir_path="$root_path\assets\uploads\izvodjaci\\$korisnik->Korisnicko_Ime";
        //echo($dir_path);
        if(file_exists($dir_path)){
            $images=scandir($dir_path);
        }
        else{
            $images=[];
        }
        if(sizeof($images)<11){
            if(isset($_FILES['file'])){
                $file=$this->request->getFile('file');
                helper('filesystem');
                $username=$korisnik->Korisnicko_Ime;
                //echo($file->getName());
                if($file->isValid()){
                    $file->move("$root_path/assets/uploads/izvodjaci/$username");
                }
            }
            else{
                echo('GRESKA!!!');
            }
        }
        else{
            echo("Maksimalan broj fotografija i snimaka dostignut");
        }
        return redirect()->to(site_url("IzvodjacController/moj_nalog"));
    }
    public function konkursi(){
        $konk_model=new KonkursModel();
        $dog_model=new DogadjajModel();
        $konkursi=$konk_model->findAll();
        $names=[];
        foreach($konkursi as $konkurs){
            $names["$konkurs->ID_Dog"]=$dog_model->find("$konkurs->ID_Dog")->Naziv;
        }
        $this->prikaz('konkursi',['konkursi'=>$konkursi,'names'=>$names]);
    }
    public function konkurs(){
        $konk_model=new KonkursModel();
        $dog_model=new DogadjajModel();
        $prijava_model=new PrijaveKonkursModel();
        $id=$_GET['id'];
        $id_k=$this->session->get('korisnik')->ID_K;
		$konkurs=$konk_model->find("$id");
        $dogadjaj=$dog_model->find("$id");
        
        $prijavljen=!empty($prijava_model->where('ID_K',$id_k)->where('ID_Dog',$id)->findAll());

		$data['konkurs']=$konkurs;
        $data['dogadjaj']=$dogadjaj;
        $data['prijavljen']=$prijavljen;
		return $this->prikaz('konkurs',$data);
    }
    public function prijava_na_konkurs(){
        $id=$this->request->getVar('id');
        $id_k=$this->session->get('korisnik')->ID_K;
        $prijava_model=new PrijaveKonkursModel();
        $prijave=$prijava_model->where('ID_K',$id_k)->where('ID_Dog',$id)->findAll();
        if(empty($prijave)){
            $data=[
                'ID_Dog'=>$id,
                'ID_K'=>$id_k
            ];
                $prijava_model->insert($data);
        }
        else{
           //print_r($prijave);
        }
        return redirect()->to(site_url("IzvodjacController/moj_nalog"));
    }
}