<?php namespace App\Models;

use CodeIgniter\Model;

class Verifikacija extends Model{

    protected $table = "Verifikacija";
    protected $primaryKey = 'id';

    protected $returnType = 'object';

    protected $allowedFields = ['id','email','kod'];

    public function ubaci_el($data)
    {
        $this->insert($data);
    }

}