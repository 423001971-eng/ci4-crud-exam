<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthGuard implements FilterInterface
{
    /**
     * This method runs BEFORE the controller. 
     * It checks if the user is logged in.
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        // If the session 'isLoggedIn' is not true, kick them to the login page
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }
    }

    /**
     * This method runs AFTER the controller.
     * We usually leave this empty for basic auth.
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing here
    }
}