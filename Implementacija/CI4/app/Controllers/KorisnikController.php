<?php namespace App\Controllers;

use App\Models\Izvodjac;
use App\Models\Organizator;
use App\Models\Korisnik;
use App\Models\Posetilac;
use \Config\Services\Email;

class KorisnikController extends BaseController
{
    protected function prikaz($page,$data)
    {
    
        $data['controller']=$this->session->get('tip');
        $data['korisnik']=$this->session->get('korisnik');
        $data['tip']=$this->session->get($this->session->get('tip'));

        echo view('header_korisnik',$data);
        echo view($page,$data);
        echo view('footer');
    
    }

    public function logout()
    {
		$this->session->destroy();
		return redirect()->to(base_url('Gost'));
    }
}
