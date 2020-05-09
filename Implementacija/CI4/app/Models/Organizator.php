<?php namespace App\Models;

use CodeIgniter\Model;

class Organizator extends Model{

    protected $table = "Izvodjac";
    protected $primaryKey = 'ID_K';

    protected $returnType = 'object';

    protected $allowedFields = ['Ime', 'Prezime','Telefon','Prosek_Ocena','Broj_Ocena','ID_K'];

    public function ubaci_el($data)
    {
        $data_in=[];
        $data_in['Ime']=$data['name_val'];
        $data_in['Prezime']=$data['surename_val'];
        $data_in['Telefon']=$data['phone_val'];
        $data_in['ID_K']=$data['id'];
        $this->insert($data_in);
    }

}