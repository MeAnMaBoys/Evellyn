<?php namespace App\Controllers;

use App\Models\OrganizatorModel;
use App\Models\KorisnikModel;
use App\Models\KonkursModel;
use App\Models\DogadjajModel;

class Izvodjac extends BaseController
{
    protected function prikaz($page,$data)
    {
        $data['controller']='Izvodjac';
        $data['korisnik']=$this->session->get('korisnik');
        $data['izvodjac']=$this->session->get('izvodjac');
        echo view('header_korisnik',$data);
        echo view($page);
        echo view('footer');
    }

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
        return redirect()->to(site_url("Izvodjac/moj_nalog"));
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