<?php namespace App\Models;

use CodeIgniter\Model;

class IzvodjacModel extends Model
{
        protected $table = "Izvodjac";
        protected $primaryKey = 'ID_K';
    
        protected $returnType = 'object';
    
        protected $allowedFields = ['Ime', 'Prezime','Telefon','Prosek_Ocena','Broj_Ocena','Tipovi','ID_K'];
    
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