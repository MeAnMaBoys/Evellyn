<?php namespace App\Controllers;

use App\Models\IzvodjacModel;
use App\Models\OrganizatorModel;
use App\Models\KorisnikModel;
use App\Models\PosetilacModel;
use \Config\Services\EmailModel;

class PosetilacController extends KorisnikController
{
    function moj_nalog()
    {
        $korisnik = $this->session->get('korisnik');
        $this->prikaz('nalog_posetilac',['email'=>$korisnik->Email,'username'=>$korisnik->Korisnicko_Ime]);
    }
}