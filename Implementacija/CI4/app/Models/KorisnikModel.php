<?php namespace App\Models;
/**
 * @author - Rastko Sapic 0398/2017
 */
use CodeIgniter\Model;

/**
 * KorisnikModel - klasa koja predstavlja tabelu korisnik u bazi podataka
 * @version 1.0
 */
class KorisnikModel extends Model
{
        /**
         * @var string $table Table
        */
        protected $table = "Korisnik";
        /**
         * @var string $primaryKey ID
        */
        protected $primaryKey = 'ID_K';
        /**
         * @var string $returnType Type
        */
        protected $returnType = 'object';
        /**
         * @var array $allowedFields Fields
        */
        protected $allowedFields = ['Korisnicko_Ime', 'Sifra','Email'];
    
        /**
         * funkcija koja sluzi za ubacivanje elementa u bazu podataka
         */
        public function ubaci_el($data)
        {
            $data_in=[];
            $data_in['Email']=$data['email_val'];
            $data_in['Korisnicko_Ime']=$data['username_val'];
            $data_in['Sifra']=$data['password_val'];
            $this->insert($data_in);
        }
}