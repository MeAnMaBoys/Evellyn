<?php namespace App\Models;
/**
 * @author Nikola Mirkovic 0325/2017
 */
use CodeIgniter\Model;

class NastupaModel extends Model
{
    /**
     * @var string $table Table
     */
    protected $table      = 'Nastupa';
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
    protected $allowedFields = ['ID_Dog','Izvodjac'];
}