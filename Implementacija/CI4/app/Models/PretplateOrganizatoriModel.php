<?php namespace App\Models;

use CodeIgniter\Model;

class PretplateOrganizatoriModel extends Model
{
    protected $table      = 'Pretplate_Na_Organizatora';
    protected $primaryKey = 'Organizator';
    protected $returnType = 'object';
    protected $allowedFields = ['Organizator','Posmatrac'];
}