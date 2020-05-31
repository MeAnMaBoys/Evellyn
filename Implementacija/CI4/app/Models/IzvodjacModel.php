<?php namespace App\Models;

/**
 * @author - Rastko Sapic 0398/2017
 */
use CodeIgniter\Model;

/**
 * IzvodjacModel - klasa koja predstavlja Tabelu Izvodjac u bazi podataka
 * @version 1.0
 */
class IzvodjacModel extends Model
{
        /**
         * @var string $table Table
         */
        protected $table = "Izvodjac";
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
        protected $allowedFields = ['Ime', 'Prezime','Telefon','Prosek_Ocena','Broj_Ocena','Tipovi','ID_K'];
    
        /**
         * Ubacivanje elementa u tabelu izvodjac
         */
        public function ubaci_el($data)
        {
            $data_in=[];
            $data_in['Ime']=$data['name_val'];
            $data_in['Prezime']=$data['surename_val'];
            $data_in['Telefon']=$data['phone_val'];
            $data_in['ID_K']=$data['id'];
            $data_in['Tipovi']=$data['tip_val'];
            $this->insert($data_in);
        }
}