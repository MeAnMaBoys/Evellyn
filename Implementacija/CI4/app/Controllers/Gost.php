<?php namespace App\Controllers;

use App\Models\IzvodjacModel;
use App\Models\OrganizatorModel;
use App\Models\KorisnikModel;
use App\Models\PosetilacModel;
use App\Models\VerifikacijaModel;
use \Config\Services\Email;

class Gost extends BaseController
{
    protected function prikaz($page,$data)
    {
        $data['controller']='gost';

        echo view('header_gost');
        echo view($page,$data);
        echo view('footer');
    }

    public function moj_nalog()
    {
        $this->prikaz('moj_nalog',[]);
    }

    public function registracija()
    {
        $this->prikaz('registracija',[]);
    }

    public function registracija_izvodjac()
    {
        $this->prikaz('registracija_izvodjac',[]);
    }

    public function registracija_organizator()
    {
        $this->prikaz('registracija_organizator',[]);
    }

    public function registracija_posetilac()
    {
        $this->prikaz('registracija_posetilac',[]);
    }


    private function proveri_podatke_posetilac()
    {
        $data=[];
        $data['email']='is-valid';
        $data['username']='is-valid';

        $data['email_val']=$this->request->getPost('email');
        $data['username_val']=$this->request->getPost('username');
        $data['password_val']=$this->request->getPost('password');
        $data['tip_val']=$this->request->getPost('tip');
        
        $flag = false;
        if(preg_match("/^[\w\.]+@\w+([\.-]\w+)*(\.\w{2,3})+$/",$this->request->getPost('email')===0))
        {
            $data['email']="is-invalid";
            $flag = true;
            $data['email_val']="";
        }
        if((preg_match("/[^a-zA-Z0-9]/",$this->request->getPost('username'))==1)||(strlen($this->request->getPost('username'))<3)||(strlen($this->request->getPost('username'))>12))
        {
            $data['username']='is-invalid';
            $flag = true;
            $data['username_val']="";
        }

        if(strcmp($this->request->getPost('password'),$this->request->getPost('password_cf'))!=0)
        {
            $data['password_cf']="is-invalid";
            $flag=true;
        }
        $korModel = new KorisnikModel();

        $row = $korModel->where('Email',$data['email_val'])->first();

        $data['enter']=false;
        if(($row)!=null)
        {
            $data['email']="is-invalid";
            $flag = true;
            $data['enter']=true;
        }

        $ret = ['data'=>$data,'flag'=>$flag];
        return $ret;
    }

    protected function proveri_podatke()
    {

        $data=[];
        $data['email']='is-valid';
        $data['name']='is-valid';
        $data['surename']='is-valid';
        $data['username']='is-valid';
        $data['phone']='is-valid';

        $data['email_val']=$this->request->getPost('email');
        $data['name_val']=$this->request->getPost('name');
        $data['surename_val']=$this->request->getPost('surename');
        $data['username_val']=$this->request->getPost('username');
        $data['phone_val']=$this->request->getPost('phone');
        $data['password_val']=$this->request->getPost('password');

        $flag = false;
        if(preg_match("/^[\w\.]+@\w+([\.-]\w+)*(\.\w{2,3})+$/",$this->request->getPost('email'))==0)
        {
            $data['email']="is-invalid";
            $flag = true;
            $data['email_val']="";
        }
        if((preg_match("/[^a-zA-Z]+/",$this->request->getPost('name'))==1)||(strlen($this->request->getPost('name'))<2)||(strlen($this->request->getPost('name'))>15))
        {
            $data['name']='is-invalid';
            $flag = true;
            $data['name_val']="";
        }
        if((preg_match("/[^a-zA-Z]+/",$this->request->getPost('surename'))==1)||(strlen($this->request->getPost('surename'))<2)||(strlen($this->request->getPost('surename'))>15))
        {
            $data['surename']='is-invalid';
            $flag = true;
            $data['surename_val']="";
        }
        if((preg_match("/[^a-zA-Z0-9]/",$this->request->getPost('username'))==1)||(strlen($this->request->getPost('username'))<3)||(strlen($this->request->getPost('username'))>12))
        {
            $data['username']='is-invalid';
            $flag = true;
            $data['username_val']="";
        }
        if((preg_match("/[^0-9]/",$this->request->getPost('phone'))==1)||(strlen($this->request->getPost('phone'))<9)||(strlen($this->request->getPost('phone'))>12))
        {
            $data['phone']='is-invalid';
            $flag = true;
            $data['phone_val']="";
        }

        if(strcmp($this->request->getPost('password'),$this->request->getPost('password_cf'))!=0)
        {
            $data['password_cf']="is-invalid";
            $flag=true;
        }
        $korModel = new KorisnikModel();

        $row = $korModel->where('Email',$data['email_val'])->first();

        $data['enter']=false;
        if(($row)!=null)
        {
            $data['email']="is-invalid";
            $flag = true;
            $data['enter']=true;
        }

        $ret = ['data'=>$data,'flag'=>$flag];
        return $ret;
    }

    protected function kreiraj_korisnika($vector)
    {
        $korModel = new KorisnikModel();
        $korModel->ubaci_el($vector['data']);
        $row = $korModel->where('Email',$vector['data']['email_val'])->first();

        return $row;
    }

    protected function kreiraj_organizatora($vector)
    {
        $orgModel = new OrganizatorModel();
        $orgModel->ubaci_el($vector['data']);
    }

    protected function kreiraj_posetioca($vector)
    {
        $posModel = new PosetilacModel();
        $posModel->ubaci_el($vector['data']);
    }
    protected function kreiraj_izvodjaca($vector)
    {
        $izvModel = new IzvodjacModel();
        $izvModel->ubaci_el($vector['data']);
    }

    public function ver_kod()
    {
        $num=$this->request->getPost('first').$this->request->getPost('second').$this->request->getPost('third').$this->request->getPost('fourth').$this->request->getPost('fifth');

        $num=(int)$num;

        $verModel = new VerifikacijaModel();
        $rows = $verModel->where('kod',$num)->findAll();

        if(count($rows)===0)
        {
            return $this->prikaz('ver_kod',['opis'=>'Pogresan verifikacioni kod!']);
        }
        $vector = $this->session->get('vector');
        
        $flag = false;
        foreach($rows as $row):
            if(($row->email===$vector['data']['email_val']))
            { 
                $flag= true;
            break;
            }
        endforeach;

        if($flag===false)
        {
            return $this->prikaz('ver_kod',['opis'=>'Pogresan verifikacioni kod!']);
        }
        
        $korModel = new KorisnikModel();
        $rowx = $korModel->where('email',$vector['data']['email_val'])->findAll();
        if(count($rowx)>0):
            return $this->prikaz('ver_kod',['opis'=>'Nalog sa ovim emailom je nazalost vec verifikovan!']);
        endif;
        
        $row2 = $this->kreiraj_korisnika($vector);

        $vector['data']['id']=$row2->ID_K;

        $reg_tip = $this->session->get('reg_tip');
        if($reg_tip==='i')
        {
            $this->kreiraj_izvodjaca($vector);
        }
        else if($reg_tip==='o')
        {
            $this->kreiraj_organizatora($vector);
        }
        else
        {
            $this->kreiraj_posetioca(($vector));
        }

        $this->unsetAll($vector);
        return $this->prikaz('ver_kod',['flag'=>'prosao']);
    }

    public function registruj_izvodjac()
    {   
        $vector = $this->proveri_podatke();
        if($vector['flag']==true)
        {
            $this->prikaz('registracija_izvodjac',$vector['data']);
            $this->unsetAll($vector);
            return;
        }
        if($this->sendEmail($vector['data']['email_val'])==true){
            $this->session->set('vector',$vector); 
            $this->session->set('reg_tip','i');
            return $this->prikaz('ver_kod',[]);
        }
        //ispisi gresku da mail ne valja, i obrisi iz tabele Verifikacija taj red
        return $this->prikaz('proba',['radi'=>'ne radi']);
    }

    public function registruj_organizator()
    {
        $vector = $this->proveri_podatke();
        if($vector['flag']==true)
        {
            $this->prikaz('registracija_organizator',$vector['data']);
            $this->unsetAll($vector);
            return;
        }
        
        if($this->sendEmail($vector['data']['email_val'])==true){
            $this->session->set('vector',$vector); 
            $this->session->set('reg_tip','o');
            return $this->prikaz('ver_kod',[]);
        }
        //ispisi gresku da mail ne valja, i obrisi iz tabele Verifikacija taj red
        return $this->prikaz('proba',['radi'=>'ne radi']);
    }

    public function registruj_posetilac()
    {
        $vector = $this->proveri_podatke_posetilac();
        if($vector['flag']==true)
        {
            $this->prikaz('registracija_posetilac',$vector['data']);
            $this->unsetAll($vector);
            return;
        }

        if($this->sendEmail($vector['data']['email_val'])==true){
            $this->session->set('vector',$vector); 
            $this->session->set('reg_tip','p');
            return $this->prikaz('ver_kod',[]);
        }
        //ispisi gresku da mail ne valja, i obrisi iz tabele Verifikacija taj red
        return $this->prikaz('proba',['radi'=>'Error trying to send email!']);
    }

    private function unsetAll($vector)
    {
        unset($vector);
    }

    public function loginSubmit()
    {
        $data = [];
        $data['usr']="is-valid";
        $data['password']='is-valid';
        $data['user_val']=$this->request->getPost('user');

        if(!($this->validate(['user'=>'required', 'password'=>'required'])))
        {
            $data['usr']="is-invalid";
            $data['password']='is-invalid';
            $data['user_msg']="Niste uneli Korisinicko ime, ili sifru!";
            return $this->prikaz('moj_nalog',$data);
        }

        $pattern="Email";
        if(strpos($this->request->getPost('user'),'@')===false)
        {
            $pattern="Korisnicko_Ime";
        }
        
        $korModel = new KorisnikModel();

        $row = $korModel->where($pattern,$this->request->getPost('user'))->first();

        if(($row)===null)
        {
            $data['usr']="is-invalid";
            $data['user_val']="";
            $data['user_msg']="Ne postoji zadati korisnik u nasoj aplikaciji!";
            return $this->prikaz('moj_nalog',$data);
        }
        $pw = $this->request->getPost('password');

        if(($row->Sifra) !== ($pw))
        {
            $data['password']='is-invalid';
            $data['password_msg']="uneli ste pogresnu lozinku!";
            return $this->prikaz('moj_nalog',$data);
        }
        $this->session->set('korisnik',$row);

        $posModel = new PosetilacModel();
        $user = $posModel->find($row->ID_K);
        
        if($user!==null)
        {
            $this->session->set('PosetilacController',$user);
            $this->session->set('tip','PosetilacController');
            return redirect()->to(site_url('PosetilacController'));
        }

        $orgModel = new OrganizatorModel();
        $user = $orgModel->find($row->ID_K);
        
        if($user!==null)
        {
            $this->session->set('OrganizatorController',$user);
            $this->session->set('tip','OrganizatorController');
            return redirect()->to(site_url('OrganizatorController'));
        }

        $izvModel = new IzvodjacModel();

        $user = $izvModel->find($row->ID_K);

        $this->session->set('IzvodjacController',$user);
        $this->session->set('tip','IzvodjacController');
        return redirect()->to(site_url('IzvodjacController'));
    }
}
