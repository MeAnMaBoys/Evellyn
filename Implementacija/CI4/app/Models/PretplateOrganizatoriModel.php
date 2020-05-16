<?php namespace App\Models;

use CodeIgniter\Model;

class PretplateOrganizatoriModel extends Model
{
    protected $table      = 'pretplate_na_organizatora';
    protected $primaryKey = 'Organizator';
    protected $returnType = 'object';
    protected $allowedFields = ['Organizator','Posmatrac'];
}