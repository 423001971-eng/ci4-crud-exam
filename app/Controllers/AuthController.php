<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class AuthController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    // Show registration form
    public function register()
    {
        return view('register');
    }

    // Handle registration submission
    public function save()
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'name'     => 'required|min_length[3]',
            'email'    => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
            'pass_confirm' => 'required|matches[password]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Hash password
        $password = password_hash($this->request->getPost('password'), PASSWORD_BCRYPT);

        $this->userModel->save([
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'password' => $password
        ]);

        return redirect()->to('/login')->with('success', 'Registration successful! Please login.');
    }

    // Show login form
    public function login()
    {
        return view('login');
    }

    // Handle login
    public function auth()
    {
        $user = $this->userModel
            ->where('email', $this->request->getPost('email'))
            ->first();

        if ($user && password_verify($this->request->getPost('password'), $user['password'])) {
            session()->set([
                'user_id'   => $user['id'],
                'user_name' => $user['name'],
                'isLoggedIn'=> true
            ]);
            return redirect()->to('/dashboard');
        }

        return redirect()->back()->withInput()->with('error', 'Invalid login credentials');
    }

    // Logout
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}