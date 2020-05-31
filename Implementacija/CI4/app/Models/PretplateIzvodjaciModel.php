<?php namespace App\Models;
/**
 * @author Mladen Jugovic 0502/2017
 */
use CodeIgniter\Model;

class PretplateIzvodjaciModel extends Model
{
    /**
     * @var string $table Table
     */
    protected $table      = 'Pretplate_Na_Izvodjace';
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
    protected $allowedFields = ['Izvodjac','Posmatrac'];
}