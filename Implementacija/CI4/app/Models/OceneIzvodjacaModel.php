<?php namespace App\Models;
/**
 * @author Mladen Jugovic 0502/2017
 */
use CodeIgniter\Model;

class OceneIzvodjacaModel extends Model
{
    /**
     * @var string $table Table
     */
    protected $table      = 'Ocene_Izvodjaca';
    /**
     * @var string $primaryKey ID
     */
    protected $primaryKey = 'Izvodjac';
    /**
     * @var string $returnType Type
     */
    protected $returnType = 'object';
    /**
     * @var array $allowedFields Fields
     */
    protected $allowedFields = ['Ocena','Izvodjac','Posmatrac'];
}