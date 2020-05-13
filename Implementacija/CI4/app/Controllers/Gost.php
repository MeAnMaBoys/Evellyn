<?php namespace App\Controllers;

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

    public function registruj()
    {
        $name = $_POST['password'];

        $this->registracija_izvodjac();
    }
}