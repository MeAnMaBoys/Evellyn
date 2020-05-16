<?php namespace App\Models;

use CodeIgniter\Model;

class ZahtevNastupanjeModel extends Model
{
    protected $table      = 'Zahtev_Za_Nastupanje';
    protected $primaryKey = 'ID_Dog';
    protected $returnType = 'object';
    protected $allowedFields = ['ID_Dog','ID_K'];
}