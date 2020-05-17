<?php namespace App\Models;

use CodeIgniter\Model;

class NastupaModel extends Model
{
    protected $table      = 'Nastupa';
    protected $primaryKey = 'ID_Dog';
    protected $returnType = 'object';
    protected $allowedFields = ['ID_Dog','Izvodjac'];
}