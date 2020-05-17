<?php namespace App\Models;

use CodeIgniter\Model;

class OceneDogadjajaModel extends Model
{
    protected $table      = 'ocene_dogadjaja';
    protected $primaryKey = 'ID_Dog';
    protected $returnType = 'object';
    protected $allowedFields = ['Ocena','ID_Dog','Posmatrac'];
}