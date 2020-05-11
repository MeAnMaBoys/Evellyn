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
}