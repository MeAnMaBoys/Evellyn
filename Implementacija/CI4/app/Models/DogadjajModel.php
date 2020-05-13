<?php namespace App\Models;

use CodeIgniter\Model;

class DogadjajModel extends Model
{
    protected $table      = 'dogadjaj';
    protected $primaryKey = 'ID_Dog';
    protected $returnType = 'object';
    protected $allowedFields = ['Datum_Vreme', 'Tip', 'Lokacija', 'Organizator','Status'];
}