<?php namespace App\Models;
/**
 * @author - Rastko Sapic 0398/2017
 */
use CodeIgniter\Model;

/**
 * VerifikacijaModel - predstavlja tabelu verifikacija u bazi podataka
 * @version 1.0
 */
class VerifikacijaModel extends Model{

    /**
     * @var string $table Table
     */
    protected $table = "Verifikacija";
    /**
     * @var string $id ID
     */
    protected $primaryKey = 'id';
    /**
     * @var string $returntType Type
     */
    protected $returnType = 'object';
    /**
     * @var array $allowedFields fields
     */
    protected $allowedFields = ['id','email','kod'];

    public function ubaci_el($data)
    {
        $this->insert($data);
    }

}