<?php namespace App\Models;

use CodeIgniter\Model;

class OceneIzvodjacaModel extends Model
{
    protected $table      = 'Ocene_Izvodjaca';
    protected $primaryKey = 'Izvodjac';
    protected $returnType = 'object';
    protected $allowedFields = ['Ocena','Izvodjac','Posmatrac'];
}