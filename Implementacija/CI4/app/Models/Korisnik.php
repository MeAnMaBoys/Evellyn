<?php namespace App\Models;

use CodeIgniter\Model;


class Korisnik extends Model{

    protected $table = "Korisnik";
    protected $primaryKey = 'ID_K';

    protected $returnType = 'object';

    protected $allowedFields = ['Korisnicko_Ime', 'Sifra','Email'];

    public function ubaci_el($data)
    {
        $data_in=[];
        $data_in['Email']=$data['email_val'];
        $data_in['Korisnicko_Ime']=$data['username_val'];
        $data_in['Sifra']=$data['password_val'];
        $this->insert($data_in);
    }

}