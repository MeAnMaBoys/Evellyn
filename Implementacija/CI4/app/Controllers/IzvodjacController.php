<?php namespace App\Controllers;

use App\Models\IzvodjacModel;
use App\Models\OrganizatorModel;
use App\Models\KorisnikModel;
use App\Models\PosetilacModel;
use \Config\Services\Email;

class IzvodjacController extends KorisnikController
{
    public function moj_nalog()
    {
        $this->prikaz('moj_nalog_i',[]);
    }
    public function kacenje_sadrzaja(){
        $this->prikaz('kacenje_sadrzaja',[]);
    }
    public function okaci_sadrzaj(){
        $korisnik=$this->session->get('korisnik');
        $dir_path="C:\wamp64\www\CI4\public\assets\uploads\izvodjaci\\$korisnik->Korisnicko_Ime";
        if(file_exists($dir_path))
            $images=scandir($dir_path);
        else 
            $images=[];
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
        $konkursi=$konk_model->findAll();
        $this->prikaz('konkursi',['konkursi'=>$konkursi]);
    }
    public function konkurs(){
        $konk_model=new KonkursModel();
        $dog_model=new DogadjajModel();
		$id=$_GET['id'];
		$konkurs=$konk_model->find("$id");
		$dogadjaj=$dog_model->find("$id");
		$data['konkurs']=$konkurs;
		$data['dogadjaj']=$dogadjaj;
		return $this->prikaz('konkurs',$data);
    }
    public function prijava_na_konkurs(){
        $id=$this->request->getVar('id');
        echo($id);
    }
}