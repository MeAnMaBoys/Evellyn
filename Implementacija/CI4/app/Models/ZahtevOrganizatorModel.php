<?php namespace App\Models;

use CodeIgniter\Model;

class ZahtevOrganizatorModel extends Model
{
    protected $table      = 'Zahtev_Za_Organizatora';
    protected $primaryKey = 'ID_K';
    protected $returnType = 'object';
    protected $allowedFields = ['ID_K'];
}