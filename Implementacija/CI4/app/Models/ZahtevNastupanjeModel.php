<?php namespace App\Models;

use CodeIgniter\Model;

class ZahtevNastupanjeModel extends Model
{
    protected $table      = 'zahtev_za_nastupanje';
    protected $primaryKey = 'ID_Dog';
    protected $returnType = 'object';
    protected $allowedFields = ['ID_Dog','ID_K'];
}