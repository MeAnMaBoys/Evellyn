<?php namespace App\Models;

use CodeIgniter\Model;

class KonkursModel extends Model
{
    protected $table      = 'Konkurs';
    protected $primaryKey = 'ID_Dog';
    protected $returnType = 'object';
   
    protected $allowedFields = ['ID_Dog','Rok_Za_Prijavu']; 
}