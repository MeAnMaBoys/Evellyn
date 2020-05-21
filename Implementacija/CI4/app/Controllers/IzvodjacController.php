<?php namespace App\Controllers;

use App\Models\IzvodjacModel;
use App\Models\OrganizatorModel;
use App\Models\KorisnikModel;
use App\Models\PosetilacModel;
use App\Models\PrijaveKonkursModel;
use App\Models\KonkursModel;
use App\Models\DogadjajModel;
use \Config\Services\Email;

class IzvodjacController extends KorisnikController
{
    public function moj_nalog()
    {
        $ocene_izv = new OceneIzvodjacaModel();
        $id = $this->session->get('korisnik')->ID_K;
        $ocene = $ocene_izv->where('izvodjac', $id )->findAll();
        $data['ocene'] = $ocene;
        $this->prikaz('moj_nalog_i',$data);
    }
    public function kacenje_sadrzaja(){
        $this->prikaz('kacenje_sadrzaja',[]);
    }
    public function okaci_sadrzaj(){
        $korisnik=$this->session->get('korisnik');
        $dir_path="C:\wamp64\www\CI4\public\assets\uploads\izvodjaci\\$korisnik->Korisnicko_Ime";
        $images=scandir($dir_path);
        if(sizeof($images)<9){
            if(isset($_FILES['file'])){
                $file=$this->request->getFile('file');
                helper('filesystem');
                $username=$korisnik->Korisnicko_Ime;
                //echo($file->getName());
                if($file->isValid()){
                    $file->move("C:/wamp64/www/CI4/public/assets/uploads/izvodjaci/$username");
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