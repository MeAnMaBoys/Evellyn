<?php namespace App\Models;
/**
 * @author Nikola Mirkovic 0325/2017
 */
use CodeIgniter\Model;

/**
 * Klasa koja predstavlja tabelu Dogadjaj u bazi podataka
 * @version 1.0
 */
class DogadjajModel extends Model
{
    /**
     * @var string $table Table
     */
    protected $table = 'Dogadjaj';
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
    protected $allowedFields = ['Datum_Vreme', 'Tip', 'Lokacija', 'Organizator','Status','Naziv','Opis'];
}