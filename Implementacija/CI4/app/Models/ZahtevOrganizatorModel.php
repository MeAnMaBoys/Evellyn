<?php namespace App\Models;

use CodeIgniter\Model;

class ZahtevOrganizatorModel extends Model
{
    protected $table      = 'zahtev_za_organizatora';
    protected $primaryKey = 'ID_K';
    protected $returnType = 'object';
    protected $allowedFields = ['ID_K'];
}