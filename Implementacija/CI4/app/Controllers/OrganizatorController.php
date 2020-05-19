<?php namespace App\Controllers;

use App\Models\IzvodjacModel;
use App\Models\OrganizatorModel;
use App\Models\KorisnikModel;
use App\Models\PosetilacModel;
use App\Models\DogadjajModel;
use App\Models\KonkursModel;
use App\Models\ZahtevNastupanjeModel;
use \Config\Services\EmailModel;
use \App\Models\OceneDogadjajaModel;

class OrganizatorController extends KorisnikController
{
    public function obavesti_izvodjace()
    {
        $izvModel = new IzvodjacModel();
        $tipovi = array('muzicar','bend','zabavljac');
        $korModel = new KorisnikModel();
        foreach($tipovi as $tip):
            $rows = $izvModel->where('Tipovi',$tip)->findAll();
            
            foreach($rows as $row):
                $user = $korModel->find($row->ID_K);

                $this->sendEmail($user->Email);
            endforeach;
        endforeach;
    }
    public function moj_nalog()
    {
        $ocd = new OceneDogadjajaModel();
        $id = $this -> session-> get('korisnik')->ID_K;
        $ocene = $ocd -> where('Organizator', $id)-> findAll(); 
        $this->prikaz('moj_nalog_o',['ocene'=>$ocene]);
    }
    public function kreiranje_konkursa(){
        $this->prikaz('kreiranje_konkursa',[]);
    }
    public function kreiranje_dogadjaja(){
        $izv_model=new IzvodjacModel();
        $izvodjaci=$izv_model->findAll();
        $this->prikaz('kreiranje_dogadjaja',['izvodjaci'=>$izvodjaci]);
    }
    public function zamena_loga(){
        $this->prikaz('zamena_loga',[]);
    }
    public function zameni_logo(){
        
        if(isset($_FILES['file'])){
            $file=$this->request->getFile('file');
            helper('filesystem');
           
            //echo($file->getName());
            if($file->isValid()){
                
                $username=$this->session->get('korisnik')->Korisnicko_Ime;
                if(file_exists("C:/wamp64/www/CI4/public/assets/uploads/organizatori/$username/Logo.png")){
                    unlink("C:/wamp64/www/CI4/public/assets/uploads/organizatori/$username/Logo.png");
                }
                $file->move("C:/wamp64/www/CI4/public/assets/uploads/organizatori/$username",'Logo.png');
            }
            else{
               
            }
           
        }
        else{
            echo('GRESKA!!!');
        }
     return redirect()->to(site_url("OrganizatorController/moj_nalog"));
    }
    public function kreiraj_konkurs(){
        $date=$this->request->getVar('date');
        $time=$this->request->getVar('time');
        $type=$this->request->getVar('Radios');
        $location=$this->request->getVar('location');
        $deadline_date=$this->request->getVar('deadline_date');
        $deadline_time=$this->request->getVar('deadline_time');
        $name=$this->request->getVar('naziv');
        $desc=$this->request->getVar('opis');
        $data_valid=true;
        $mail=$this->request->getVar('send_mails');

        $curr_date=date("Y-m-d");

        $test='/^[^;]*$/';
        if($date==''||!(strcmp($curr_date,$date)<0)){
            $data_valid=false;
            echo("Greska 1");
        }
        else if($deadline_date==''||!(strcmp($deadline_date,$date)<0)){
            $data_valid=false;
           
        }

        else if($time==''||$type==''||$location==''||$deadline_time==''||$name==''){
            $data_valid=false;
           
        }
       
        else if(preg_match($test,$name)==0){
            $data_valid=false;
           
        }
        else if(preg_match($test,$desc)==0){
            $data_valid=false;
           
        }
        else if(preg_match($test,$location)==0){
            $data_valid=false;
            
        }


        if($data_valid){
            $dog_model=new DogadjajModel();
            $konk_model=new KonkursModel();
            $organizator=$this->session->get('korisnik')->ID_K;
            $dog_model->save([
                'Datum_Vreme'=>"$date $time:00",
                'Tip'=>"$type",
                'Lokacija'=>"$location",
                'Organizator'=>"$organizator",
                'Status'=>'Konkurs',
                'Naziv'=>$name,
                'Opis'=>$desc
            ]);
            $id_dog=$dog_model->getInsertId();
            $data=[
                'ID_Dog'=>$id_dog,
                'Rok_Za_Prijavu'=>"$deadline_date $deadline_time:00"
            ];
            $konk_model->insert($data);
            if($mail=='send_mails'){
                $this->obavesti_izvodjace();
            }

            return redirect()->to(site_url("OrganizatorController/moj_nalog"));
        }
        else{
            $this->prikaz('kreiranje_konkursa',[]);
        }
    }
    public function kreiraj_dogadjaj(){
        $date=$this->request->getVar('date');
        $time=$this->request->getVar('time');
        $type=$this->request->getVar('Radios');
        $location=$this->request->getVar('location');
        $deadline_date=$this->request->getVar('deadline_date');
        $deadline_time=$this->request->getVar('deadline_time');
        $name=$this->request->getVar('naziv');
        $desc=$this->request->getVar('opis');
        $izvodjaci=$this->request->getVar('izvodjaci');
        $data_valid=true;
        
        $curr_date=date("Y-m-d");
        $test='/^[^;]*$/';
        if(!(strcmp($curr_date,$date)<0)){
            $data_valid=false;
        }
        else if($time==''||$type==''||$location==''||$name==''){
            $data_valid=false;
           
        }
       
        else if(preg_match($test,$name)==0){
            $data_valid=false;
           
        }
        else if(preg_match($test,$desc)==0){
            $data_valid=false;
           
        }
        else if(preg_match($test,$location)==0){
            $data_valid=false;
            
        }
        if($data_valid){
            $dog_model=new DogadjajModel();
            $zahtev_nastupanje=new ZahtevNastupanjeModel();
            
            $organizator=$this->session->get('korisnik')->ID_K;
            $dog_model->save([
                'Datum_Vreme'=>"$date $time:00",
                'Tip'=>"$type",
                'Lokacija'=>"$location",
                'Organizator'=>"$organizator",
                'Status'=>'Objavljen',
                'Naziv'=>$name,
                'Opis'=>$desc
            ]);
            $id_dog=$dog_model->getInsertId();

            if(!empty($izvodjaci)){
                foreach($izvodjaci as $id){
                    $data=[
                        'ID_K'=>$id,
                        'ID_Dog'=>$id_dog
                    ];
                    $zahtev_nastupanje->insert($data);
                }

            }

            return redirect()->to(site_url("OrganizatorController/moj_nalog"));
        }
        else{
            $this->prikaz('kreiranje_konkursa',[]);
        }
    }
}