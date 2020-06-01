<?php
namespace App\Controllers;
/**
 * @author Rastko Sapic 0398/2017
 * @author Mladen Jugovic 0502/2017
 */
/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
 */

use CodeIgniter\Controller;

use App\Models\OrganizatorModel;
use App\Models\KorisnikModel;
use App\Models\IzvodjacModel;
use App\Models\VerifikacijaModel;
use App\Models\DogadjajModel;
use App\Models\PretplateOrganizatoriModel;
use App\Models\OceneIzvodjacaModel;
use App\Models\OceneDogadjajaModel;

class BaseController extends Controller
{

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = ['form','url','filesystem'];

	/**
	 * Constructor.
	 */
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.:
		
		date_default_timezone_set("Europe/Belgrade");

		/**
		 * @var session $session Session
		 * @var email $email Email
		 */
		$this->session = \Config\Services::session();
		$this->email = \Config\Services::email();
	}

	/**
	 * Prikazivanje pogleda
	 * @throws pageNotFoundException
	 */
	protected function prikaz($page,$data)
	{
		throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
	}

	/**
	 * prikaz pogleda indeks
	 * @return void
	 */
	public function index()
	{
		$this->prikaz('index',[]);
	}
	/**
	 * prikaz mog naloga
	 * @throws pageNotFoundException
	 */
	public function moj_nalog()
	{
		throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
	}
        /**
	 * funkcija koja prikazuje aktuelne izvodjace
	 */
	public function izvodjaci(){
		$izvModel = new IzvodjacModel();
		$izvodjaci = $izvModel->findAll();
		return $this->prikaz('izvodjaci',['izvodjaci'=>$izvodjaci]);
	}
        /**
         * prikaz izvodjaca
         */
	public function izvodjac(){
		$izv_model = new IzvodjacModel();
		$kor_model=new KorisnikModel();
                $ocene_izv = new OceneIzvodjacaModel();
		$id=$_GET['id'];

		$usr=$this->session->get('korisnik');
		if((isset($usr))&&($usr->ID_K === $id))
		{
			$this->moj_nalog();
		}
		
        $ocene = $ocene_izv->where('izvodjac', $id )->findAll();
		$korisnik=$kor_model->find("$id");
		$izvodjac=$izv_model->find("$id");
		$data['korisnik_prikaz']=$korisnik;
		$data['izvodjac_prikaz']=$izvodjac;
        $data['ocene'] = $ocene;
		return $this->prikaz('izvodjac',$data);
	}
	public function obavesti_posetioce($email,$korisnik,$link){
        $this->email->setFrom('evelynn.app.psi@gmail.com','Evelynn');
        $this->email->setTo($email);

        $this->email->setSubject('Nastupi');
        $this->email->setMessage("Postovani,\n\tObavestavamo vas da ce izvodjac $korisnik->Korisnicko_Ime nastupati na pretstojecem dogadjaju: $link \n\n\n\tHvala vam sto koristite Evelynn!");

        return $this->email->send();
    }
  
	/**
	 * Funkcija za slanje verifikacionog koda putem emaila
	 * @return boolean
	 */
	protected function sendEmail($email)
    {
        $this->email->setFrom('evelynn.app.psi@gmail.com','Evelynn');
        $this->email->setTo($email);

        $verModel = new VerifikacijaModel();
		$rnd = rand(10000,99999);
		$rows = $verModel->where('email',$email)->findAll();
		if(count($rows)==0):
        $pod = ['email'=>$email,"kod"=>$rnd];
		$verModel->ubaci_el($pod);
		endif;
        $row = $verModel->where('email',$email)->first();

        $this->email->setSubject('Verifikacija naloga');
        $this->email->setMessage('Postovani, Vas verifikacioni kod je '.$row->kod.'.');

        return $this->email->send();
    }
    /**
	 * prikaz dogadjaja
    */
    public function dogadjaj(){
        $dogadjaj = new DogadjajModel();
        $dogadjajj = $dogadjaj->find($_GET['id']);
        $this->prikaz('dogadjaj', ['dogadjaj'=>$dogadjajj]);
    }
    /**
	 * funkcija koja prikazuje aktuelne dogadjaje
    */
    public function dogadjaji(){
        $dogadjajmodel = new DogadjajModel();
        $dogadjaji = $dogadjajmodel->findAll();
        $this -> prikaz("dogadjaji", ['dogadjaji'=>$dogadjaji]);
        
    }
    /**
	 * prikaz organizatora
    */
    
    public function organizator(){
	$id = $this->request->getVar('id');
	$k=$this->session->get('korisnik');
	if(isset($k)&&($k->ID_K==$id)){
		return $this->moj_nalog();
	}
        $organizator = new OrganizatorModel();        
        $korisnik = new KorisnikModel();
        $pretplacivanje=new PretplateOrganizatoriModel();
        $org = $organizator->find($id);
        $kor = $korisnik->find($id);
	$ocd = new OceneDogadjajaModel();
	$ocene = $ocd -> where('Organizator', $id)->findAll();
		
	if($this->session->get('tip')==='PosetilacController'){ 
		$id_k=$this->session->get('korisnik')->ID_K;
		$pretplacen=!empty($pretplacivanje->where('Organizator',$org->ID_K)->where('Posmatrac',$id_k)->findAll());
	}
	else
	{
		$pretplacen=false;
	}		
        $this->prikaz('organizator',['korisnik_prikaz'=>$kor , 'organizator'=>$org,'pretplacen'=>$pretplacen,'ocene'=>$ocene]);
    }

	/**
	 * prikaz pogleda o_nama
	 * @return void
	 */
	public function o_nama()
	{
		return $this->prikaz('o_nama',[]);
	}
}
