<?php namespace App\Controllers;

use App\Models\IzvodjacModel;
use App\Models\OrganizatorModel;
use App\Models\PretplateOrganizatoriModel;
use App\Models\PretplateIzvodjaciModel;
use App\Models\KorisnikModel;
use App\Models\PosetilacModel;
use App\Models\DogadjajModel;
use App\Models\KonkursModel;
use App\Models\NastupaModel;
use App\Models\PrijaveKonkursModel;
use App\Models\ZahtevNastupanjeModel;
use \Config\Services\EmailModel;
use \App\Models\OceneDogadjajaModel;

class OrganizatorController extends KorisnikController
{
    public function obavesti_izvodjace($organizator,$type)
    {
        $izvModel = new IzvodjacModel();
        $arr = ['zurka'=>['Muzicar','Zabavljac'],'nastup'=>['Bend','Muzicar'],'koncert'=>['Bend','Muzicar'],'drugo'=>['Bend','Muzicar','Zabavljac']];
        $tipovi = $arr[$type];
        $korModel = new KorisnikModel();
        foreach($tipovi as $tip):
            $rows = $izvModel->where('Tipovi',$tip)->findAll();
            
            foreach($rows as $row):
                $user = $korModel->find($row->ID_K);

                $this->posalji_obavestenje($user->Email,$organizator);
            endforeach;
        endforeach;
    }
    public function posalji_obavestenje($email,$organizator){
        $this->email->setFrom('evelynn.app.psi@gmail.com','Evelynn');
        $this->email->setTo($email);

        $this->email->setSubject('Kreiran konkurs');
        $this->email->setMessage("Postovani,\n\tObavestavamo vas da je organizator $organizator->Korisnicko_Ime objavio konkurs za izvodjace koji ce nastupati na pretstojecem dogadjaju. \n\tHvala vam sto koristite Evelynn!");

        return $this->email->send();
    }
    public function zavrseni_konkursi(){
        $konk=new KonkursModel();
        $org=$this->session->get('korisnik');
        $konkursi=$konk->findAll();
        $dog=new DogadjajModel();
        $validni_konkursi=[];
        $curr_date=date("Y-m-d H:i:s");
        foreach($konkursi as $konkurs){
            $dogadjaj=$dog->find($konkurs->ID_Dog);
            
            if($dogadjaj->Organizator==$org->ID_K && strcmp($konkurs->Rok_Za_Prijavu,$curr_date)<0&&$dogadjaj->Status=='Konkurs'){
                $validni_konkursi[]=$konkurs;
            }
        }
        $this->prikaz('zavrseni_konkursi',['konkursi'=>$validni_konkursi]);
    }
    public function z_konkurs(){
        $id_dog= $_GET['id_k'];
        $pk=new PrijaveKonkursModel();
        $izv=new IzvodjacModel();
        $prijave=$pk->where('ID_Dog',$id_dog)->findAll();
        $izvodjaci=[];
        foreach($prijave as $prijava){
            $izvodjaci[]=$izv->find($prijava->ID_K);
        }
        $this->prikaz('odaberi_izvodjace',['id_dog'=>$id_dog,'izvodjaci'=>$izvodjaci]);
    }
    public function prihvati_zahteve(){
        $id_dog=$this->request->getVar('id_dog');
        $izvodjaci=$this->request->getVar('izvodjaci');
        $nm=new NastupaModel();
        $po=new PretplateOrganizatoriModel();
        $pi=new PretplateIzvodjaciModel();
        $km=new KorisnikModel();
        $dm=new DogadjajModel();
        $dogadjaj=$dm->find($id_dog);
        if(!empty($izvodjaci)){
            foreach($izvodjaci as $izvodjac){
                $izv=$km->find($izvodjac);
                $nm->insert(['ID_Dog'=>$id_dog,'Izvodjac'=>$izvodjac]);
                $pretplate=$pi->where('Izvodjac',$izvodjac)->findAll();
                foreach($pretplate as $pretplata){
                    $korisnik=$km->find($pretplata->Posmatrac);
                    $path=base_url("gost/dogadjaj?id=$id_dog");
                    $link=$path;
                    $this->obavesti_posetioce($korisnik->Email,$izv,$link);
                }
            }
        }
       
        $id_o=$this->session->get('korisnik')->ID_K;
        $org=$km->find($id_o);
        $pretplate_o=$po->where('Organizator',$id_o)->findAll();
        if(!empty($pretplate_o)){
            foreach($pretplate_o as $pretplata_o){
                $korisnik=$km->find($pretplata_o->Posmatrac);
                $path=base_url("gost/dogadjaj?id=$id_dog");
                $link=$path;
                //echo("$pretplata_o->Posmatrac");
                $this->obavesti_posetioce_o($korisnik->Email,$org,$link);
            }
        }
        $dm->update($id_dog,['Status'=>'Objavljen']);
        return redirect()->to(site_url("OrganizatorController/moj_nalog"));
    }
    public function obavesti_posetioce_o($email,$korisnik,$link){
        $this->email->setFrom('evelynn.app.psi@gmail.com','Evelynn');
        $this->email->setTo($email);

        $this->email->setSubject('Nastupi');
        $this->email->setMessage("Postovani,\n\tObavestavamo vas da je organizator $korisnik->Korisnicko_Ime objavio jos jedan dogadjaj dogadjaj: $link \n\n\n\tHvala vam sto koristite Evelynn!");

        return $this->email->send();
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
           
            if($file->isValid()){

                
                
                $type=$file->getMimeType();
                $test_img="/image/";
                if(preg_match($test_img,$type)!=0){
                    $username=$this->session->get('korisnik')->Korisnicko_Ime;
                    $pth = $_SERVER['SCRIPT_FILENAME'];
                    $rest = substr($pth,0,strlen($pth)-10);
                    $root_path=$rest;
                    $path="$root_path/assets/uploads/organizatori/$username";
                    if(file_exists("$path/Logo.png")){
                        unlink("$path/Logo.png");
                    }
                    $file->move("$path",'Logo.png');

                }
                else{
                    $poruka='Format fajla nije podrzan!!!';
                    return $this->prikaz('zamena_loga',['poruka'=>$poruka]);
                }
            }
            else{
                $poruka='Greska prilikom prijema fajla!!!';
                return $this->prikaz('zamena_loga',['poruka'=>$poruka]);
            }
           
        }
        else{
            $poruka='GRESKA!!!';
            return $this->prikaz('zamena_loga',['poruka'=>$poruka]);
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



        $valid=[
            'date'=>true,
            'time'=>true,
            'type'=>true,
            'location'=>true,
            'deadline_date'=>true,
            'deadline_time'=>true,
            'name'=>true,
            'desc'=>true
        ];
        $values=[
            'date'=>$date,
            'time'=>$time,
            'type'=>$type,
            'location'=>$location,
            'deadline_date'=>$deadline_date,
            'deadline_time'=>$deadline_time,
            'name'=>$name,
            'desc'=>$desc
        ];
        $curr_date=date("Y-m-d");
        $test='/^[^;]{3,40}$/';
        if($date==''||!(strcmp($curr_date,$date)<0)){
            $data_valid=false;
            $valid['date']=false;
            $valid['time']=false;
        }
        if($deadline_date==''||!(strcmp($deadline_date,$date)<0)){
            $data_valid=false;
            $valid['deadline_date']=false;
            $valid['deadline_time']=false;
        }
        if($time==''){
            $data_valid=false;
            $valid['time']=false;
        }
        if($deadline_time==''){
            $data_valid=false;
            $valid['deadline_time']=false;
        }
        if($type==''){
            $data_valid=false;
            $valid['type']=false;
        }
        if($location==''){
            $data_valid=false;
            $valid['location']=false;
        }
        if($name==''){
            $data_valid=false;
            $valid['name']=false;
        }
        if(preg_match($test,$name)==0){
            $data_valid=false;
            $valid['name']=false;
        }
        $test_opis='/^[^;]{3,100}$/';
        if(preg_match($test_opis,$desc)==0){
            $data_valid=false;
            $valid['desc']=false;
        }
        
        if(preg_match($test,$location)==0){
            $data_valid=false;
            $valid['location']=false;
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
                $this->obavesti_izvodjace($this->session->get('korisnik'),$type);
            }

            return redirect()->to(site_url("OrganizatorController/moj_nalog"));
        }
        else{
            $this->prikaz('kreiranje_konkursa',['values'=>$values,'valid'=>$valid]);
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
        $valid=[
            'date'=>true,
            'time'=>true,
            'type'=>true,
            'location'=>true,
            'deadline_date'=>true,
            'deadline_time'=>true,
            'name'=>true,
            'desc'=>true
        ];
        $values=[
            'date'=>$date,
            'time'=>$time,
            'type'=>$type,
            'location'=>$location,
            'deadline_date'=>$deadline_date,
            'deadline_time'=>$deadline_time,
            'name'=>$name,
            'desc'=>$desc
        ];
        $curr_date=date("Y-m-d");
        $test='/^[^;]{3,40}$/';
        if($date==''||!(strcmp($curr_date,$date)<0)){
            $data_valid=false;
            $valid['date']=false;
            $valid['time']=false;
        }
        if($time==''){
            $data_valid=false;
            $valid['time']=false;
        }
        if($type==''){
            $data_valid=false;
            $valid['type']=false;
        }
        if($location==''){
            $data_valid=false;
            $valid['location']=false;
        }
        if($name==''){
            $data_valid=false;
            $valid['name']=false;
        }
        if(preg_match($test,$name)==0){
            $data_valid=false;
            $valid['name']=false;
        }
        $test_opis='/^[^;]{3,100}$/';
        if(preg_match($test_opis,$desc)==0){
            $data_valid=false;
            $valid['desc']=false;
        }
      
        if(preg_match($test,$location)==0){
            $data_valid=false;
            $valid['location']=false;
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
            $im=new IzvodjacModel();
            $izv=$im->findAll();
            $this->prikaz('kreiranje_dogadjaja',['izvodjaci'=>$izv,'values'=>$values,'valid'=>$valid]);
        }
    }
}