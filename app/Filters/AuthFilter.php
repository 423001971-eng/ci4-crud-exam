<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface 
{
    /**
     * Do whatever processing this filter needs to do before the controller runs.
     */
    public function before(RequestInterface $request, $arguments = null) 
    {
        // Check both the login flag AND the user ID we added earlier
        if (!session()->get('isLoggedIn') || !session()->get('id')) {
            
            // Optional: Add a flash message so the user knows why they were redirected
            return redirect()->to('/login')->with('error', 'Please log in to access this page.');
        }
    }

    /**
     * This is not typically used for Auth, so we leave it empty.
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) 
    {
        // Do nothing here
    }
}