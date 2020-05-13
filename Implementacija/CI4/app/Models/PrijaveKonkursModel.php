<?php namespace App\Models;

use CodeIgniter\Model;

class PrijaveKonkursModel extends Model
{
    protected $table      = 'prijave_na_konkurs';
    protected $primaryKey = 'ID_K';
    protected $returnType = 'object';
    protected $allowedFields = ['ID_K','ID_Dog'];
}