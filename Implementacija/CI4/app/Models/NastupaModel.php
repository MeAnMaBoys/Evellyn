<?php namespace App\Models;
/**
 * @author Nikola Mirkovic 0325/2017
 */
use CodeIgniter\Model;
/**
 * Klasa koja predstavlja tabelu Nastupa u bazi podataka
 * @version 1.0
 */
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