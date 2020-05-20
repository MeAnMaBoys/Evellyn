<?php
namespace App\Controllers;

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
	protected $helpers = ['form','url'];

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
		$this->session = \Config\Services::session();
		$this->email = \Config\Services::email();
	}

	protected function prikaz($page,$data)
	{
		throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
	}

	public function index()
	{
		$this->prikaz('index',[]);
	}

	public function izvodjaci(){
		$izvModel = new IzvodjacModel();
		$izvodjaci = $izvModel->findAll();
		return $this->prikaz('izvodjaci',['izvodjaci'=>$izvodjaci]);
	}
	public function izvodjac(){
		$izv_model = new IzvodjacModel();
		$kor_model=new KorisnikModel();
                $ocene_izv = new OceneIzvodjacaModel();
		$id=$_GET['id'];
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
    
    public function dogadjaj(){
        $dogadjaj = new DogadjajModel();
        $dogadjajj = $dogadjaj->find($_GET['id']);
        $this->prikaz('dogadjaj', ['dogadjaj'=>$dogadjajj]);
    }
    public function dogadjaji(){
        $dogadjajmodel = new DogadjajModel();
        $dogadjaji = $dogadjajmodel->findAll();
        $this -> prikaz("dogadjaji", ['dogadjaji'=>$dogadjaji]);
        
	}
    
    public function organizator(){
        $id = $this->request->getVar('id');
        $organizator = new OrganizatorModel();        
        $korisnik = new KorisnikModel();
        $pretplacivanje=new PretplateOrganizatoriModel();
        $org = $organizator->find($id);
        $kor = $korisnik->find($id);
	$ocd = new OceneDogadjajaModel();
        $ocene = $ocd -> where('Organizator', $id)->findAll();
        $id_k=$this->session->get('korisnik')->ID_K;
	$pretplacen=!empty($pretplacivanje->where('Organizator',$org->ID_K)->where('Posmatrac',$id_k)->findAll());
		
        $this->prikaz('organizator',['korisnik_prikaz'=>$kor , 'organizator'=>$org,'pretplacen'=>$pretplacen,'ocene'=>$ocene]);
    }

}
