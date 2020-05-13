<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class GostFilter implements FilterInterface
{
    public function before(RequestInterface $request)
    {
        $session=session();

        if($session->has('korisnik')){
            return redirect()->to(site_url($session->get('tip')));
        }

    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response)
    {
        // Do something here
    }
}