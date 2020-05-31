<?php namespace App\Models;
/**
 * @author Rastko Sapic 0398/2017
 */
use CodeIgniter\Model;

/**
 * PosetilacModel - klasa koja predstavlja tabelu posmatrac u bazi podataka
 * @version 1.0
 */
class PosetilacModel extends Model{
    /**
     * @var string $table Table
     */
    protected $table = "Posmatrac";
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
    protected $allowedFields = ['ID_K'];

    /**
     * funkcija ubacuje element u bazu podataka
     */
    public function ubaci_el($data)
    {
        $data_in=[];
        $data_in['ID_K']=$data['id'];
        $this->insert($data_in);
    }

}