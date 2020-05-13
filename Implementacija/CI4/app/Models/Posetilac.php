<?php namespace App\Models;

use CodeIgniter\Model;

class Posetilac extends Model{

    protected $table = "Posmatrac";
    protected $primaryKey = 'ID_K';

    protected $returnType = 'object';

    protected $allowedFields = ['ID_K'];

    public function ubaci_el($data)
    {
        $data_in=[];
        $data_in['ID_K']=$data['id'];
        $this->insert($data_in);
    }

}