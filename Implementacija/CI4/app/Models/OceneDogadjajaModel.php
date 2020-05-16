<?php namespace App\Models;

use CodeIgniter\Model;

class OceneDogadjajaModel extends Model
{
    protected $table      = 'Ocene_Dogadjaja';
    protected $primaryKey = 'ID_Dog';
    protected $returnType = 'object';
    protected $allowedFields = ['Ocena','ID_Dog','Posmatrac'];
}