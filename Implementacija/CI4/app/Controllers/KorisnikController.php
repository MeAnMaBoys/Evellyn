<?php namespace App\Controllers;
/**
 * @author Rastko Sapic 0398/2017
 */
use App\Models\IzvodjacModel;
use App\Models\OrganizatorModel;
use App\Models\KorisnikModel;
use App\Models\PosetilacModel;
use \Config\Services\Email;

/**
 * KorisnikController - funkcionalnosti zajednicke za sve korisnike
 * @version 1.0
 */
class KorisnikController extends BaseController
{
    /**
     * Prikaz stranica za sve tipove korisnika
     * @param string $page
     * @param array $data
     */
    protected function prikaz($page,$data)
    {
    
        $data['controller']=$this->session->get('tip');
        $data['korisnik']=$this->session->get('korisnik');
        $data['tip']=$this->session->get($this->session->get('tip'));

        echo view('header_korisnik',$data);
        echo view($page,$data);
        echo view('footer');
    
    }

    /**
     * loguout - funkcija za odjavljivanje korisnika
     * 
     */
    public function logout()
    {
		$this->session->destroy();
		return redirect()->to(base_url('Gost'));
    }
}
