<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class TeacherFilter implements FilterInterface
{
    protected array $allowedRoles = ['teacher', 'admin', 'coordinator'];

    public function before(RequestInterface $request, $arguments = null)
    {
        $role = strtolower(session('user')['role'] ?? '');
        if (! in_array($role, $this->allowedRoles, true)) {
            return redirect()->to('/unauthorized');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }
}
