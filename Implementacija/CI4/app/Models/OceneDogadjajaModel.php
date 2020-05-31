<?php namespace App\Models;
/**
 * @author Mladen Jugovic 0502/2017
 */
use CodeIgniter\Model;

class OceneDogadjajaModel extends Model
{
    /**
     * @var string $table Table
     */
    protected $table      = 'Ocene_Dogadjaja';
    /**
     * @var string $primaryKey ID
     */
    protected $primaryKey = 'ID_Dog';
    /**
     * @var string $returnType Type
     */
    protected $returnType = 'object';
    /**
     * @var array $allowedFields Fields
     */
    protected $allowedFields = ['Ocena','ID_Dog','Posmatrac','Organizator'];
}