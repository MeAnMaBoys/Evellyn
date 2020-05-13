<?php namespace App\Controllers;

use App\Models\Izvodjac;
use App\Models\Organizator;
use App\Models\Korisnik;
use App\Models\Posetilac;
use \Config\Services\Email;

class OrganizatorController extends KorisnikController
{
    public function obavesti_izvodjace()
    {
        $izvModel = new Izvodjac();
        $tipovi = $this->request->getPost('tipovi');
        $korModel = new Korisnik();
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
        $this->prikaz('moj_nalog_o',[]);
    }
    public function kreiranje_konkursa(){
        $this->prikaz('kreiranje_konkursa',[]);
    }
    public function kreiranje_dogadjaja(){
        $this->prikaz('kreiranje_dogadjaja',[]);
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
     return redirect()->to(site_url("Organizator/moj_nalog"));
    }
    public function kreiraj_konkurs(){
        $date=$this->request->getVar('date');
        $time=$this->request->getVar('time');
        $type=$this->request->getVar('type');
        $location=$this->request->getVar('location');
        $deadline_date=$this->request->getVar('deadline_date');
        $deadline_time=$this->request->getVar('deadline_time');

        $data_valid=true;

        $curr_date=date("Y-m-d");
       if(!(strcmp($curr_date,$date)<0)){
            $data_valid=false;
        }
        if(!(strcmp($deadline_date,$date)<0)){
            $data_valid=false;
        }
        
        if($data_valid){
            $dog_model=new DogadjajModel();
            $konk_model=new KonkursModel();
            $organizator=$this->session->get('organizator')->ID_K;
            $dog_model->save([
                'Datum_Vreme'=>"$date $time:00",
                'Tip'=>"$type",
                'Lokacija'=>"$location",
                'Organizator'=>"$organizator",
                'Status'=>'Konkurs'
            ]);
            $id_dog=$dog_model->getInsertId();
            $data=[
                'ID_Dog'=>$id_dog,
                'Rok_Za_Projavu'=>"$deadline_date $deadline_time:00"
            ];
            $konk_model->insert($data);


            return redirect()->to(site_url("Organizator/moj_nalog"));
        }
        else{
            $this->prikaz('kreiranje_konkursa',[]);
        }
    }
    public function kreiraj_dogadjaj(){
        $date=$this->request->getVar('date');
        $time=$this->request->getVar('time');
        $type=$this->request->getVar('type');
        $location=$this->request->getVar('location');

        $data_valid=true;

        $curr_date=date("Y-m-d");
        if(!(strcmp($curr_date,$date)<0)){
            $data_valid=false;
        }
        if($data_valid){
            $dog_model=new DogadjajModel();
            $organizator=$this->session->get('organizator')->ID_K;
            $dog_model->save([
                'Datum_Vreme'=>"$date $time:00",
                'Tip'=>"$type",
                'Lokacija'=>"$location",
                'Organizator'=>"$organizator",
                'Status'=>'Objavljen'
            ]);

            return redirect()->to(site_url("Organizator/moj_nalog"));
        }
        else{
            $this->prikaz('kreiranje_konkursa',[]);
        }
    }
}