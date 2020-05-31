<?php namespace App\Models;
/**
 * @author Rastko Sapic 0398/2017
 */
use CodeIgniter\Model;
/**
 * OrganizatorModel - klasa koja predstavlja tabelu organizator u bazi podataka
 * @version 1.0
 */
class OrganizatorModel extends Model
{
    /**
     * @var string $table Table
     */
    protected $table = "Organizator";
    /**
     * @var string $primaryKey Table
     */
    protected $primaryKey = 'ID_K';
    /**
     * @var string $returnType Type
     */
    protected $returnType = 'object';
    /**
     * @var array $allowedFields Fields
     */
    protected $allowedFields = ['Ime', 'Prezime','Telefon','Prosek_Ocena','Broj_Ocena','ID_K'];
    /**
     * funkcija za unos elementa u bazu podataka
     */
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