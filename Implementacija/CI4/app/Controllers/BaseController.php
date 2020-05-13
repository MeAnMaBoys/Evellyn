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
use App\Models\Izvodjac;
use App\Models\Organizator;
use App\Models\Korisnik;
use App\Models\Posetilac;
use App\Models\Verifikacija;
use \Config\Services\Email;

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

	protected function sendEmail($email)
    {
        $this->email->setFrom('sapicr23@gmail.com','Evelynn');
        $this->email->setTo($email);

        $verModel = new Verifikacija();
        $rnd = rand(10000,99999);
        $pod = ['email'=>$email,"kod"=>$rnd];
        $verModel->ubaci_el($pod);
        $row = $verModel->where('email',$email)->first();

        $this->email->setSubject('Verifikacija naloga');
        $this->email->setMessage('Postovani, Vas verifikacioni kod je '.$row->kod.'.');

        return $this->email->send();
    }

	public function izvodjaci()
	{
		$izvModel = new Izvodjac();
		$izvodjaci = $izvModel->findAll();
		return $this->prikaz('izvodjaci',['izvodjaci'=>$izvodjaci]);

	}

	public function izvodjac()
	{
		return $this->prikaz('izvodjac',[]);
	}
}
