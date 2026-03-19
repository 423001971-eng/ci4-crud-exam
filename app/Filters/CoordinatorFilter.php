<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class CoordinatorFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $role = strtolower(session('user')['role'] ?? '');
        if ($role !== 'coordinator') {
            return redirect()->to('/unauthorized');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }
}
