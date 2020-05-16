<?php namespace App\Models;

use CodeIgniter\Model;

class PretplateIzvodjaciModel extends Model
{
    protected $table      = 'Pretplate_Na_Izvodjace';
    protected $primaryKey = 'Izvodjac';
    protected $returnType = 'object';
    protected $allowedFields = ['Izvodjac','Posmatrac'];
}