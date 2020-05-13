<?php namespace App\Models;

use CodeIgniter\Model;

class PretplateIzvodjaciModel extends Model
{
    protected $table      = 'pretplate_na_izvodjace';
    protected $primaryKey = 'Izvodjac';
    protected $returnType = 'object';
    protected $allowedFields = ['Izvodjac','Posmatrac'];
}