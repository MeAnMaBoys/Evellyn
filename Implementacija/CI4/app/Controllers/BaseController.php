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
		$id=$_GET['id'];
		$korisnik=$kor_model->find("$id");
		$izvodjac=$izv_model->find("$id");
		$data['korisnik_prikaz']=$korisnik;
		$data['izvodjac_prikaz']=$izvodjac;
		return $this->prikaz('izvodjac',$data);
  }
  
	protected function sendEmail($email)
    {
        $this->email->setFrom('sapicr23@gmail.com','Evelynn');
        $this->email->setTo($email);

        $verModel = new VerifikacijaModel();
        $rnd = rand(10000,99999);
        $pod = ['email'=>$email,"kod"=>$rnd];
        $verModel->ubaci_el($pod);
        $row = $verModel->where('email',$email)->first();

        $this->email->setSubject('Verifikacija naloga');
        $this->email->setMessage('Postovani, Vas verifikacioni kod je '.$row->kod.'.');

        return $this->email->send();
    }

}
