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

class OrganizatorController extends KorisnikController
{
    public function obavesti_izvodjace($organizator)
    {
        $izvModel = new IzvodjacModel();
        $tipovi = array('muzicar','bend','zabavljac');
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
        $this->prikaz('moj_nalog_o',[]);
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
                $path=$_SERVER['DOCUMENT_ROOT'];

                echo($path);
                if(file_exists("$path/assets/uploads/organizatori/$username/Logo.png")){
                    unlink("$path/assets/uploads/organizatori/$username/Logo.png");
                }
                $file->move("$path/assets/uploads/organizatori/$username",'Logo.png');
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
                $this->obavesti_izvodjace($this->session->get('korisnik'));
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