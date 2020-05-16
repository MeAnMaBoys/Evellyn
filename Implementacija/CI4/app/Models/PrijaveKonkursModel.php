<?php namespace App\Models;

use CodeIgniter\Model;

class PrijaveKonkursModel extends Model
{
    protected $table      = 'Prijave_Na_Konkurs';
    protected $primaryKey = 'ID_K';
    protected $returnType = 'object';
    protected $allowedFields = ['ID_K','ID_Dog'];
}