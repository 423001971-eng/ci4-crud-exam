<?php 

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController 
{
    public function register() { return view('auth/register'); }

    public function store() {
        $rules = [
            'name'             => 'required',
            'email'            => 'required|valid_email|is_unique[users.email]',
            'password'         => 'required|min_length[6]',
            'confirm_password' => 'matches[password]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        (new UserModel())->save([
            'name'     => $this->request->getPost('name'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT)
        ]);

        return redirect()->to('/login')->with('success', 'Registered successfully!');
    }

    public function login() { return view('auth/login'); }

    public function authenticate() {
        $model = new UserModel();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $model->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            
            // FIX: Added 'id' to the session array
            $sessionData = [
                'id'         => $user['id'], // CRITICAL: ProfileController needs this!
                'user_name'  => $user['name'],
                'user_email' => $user['email'],
                'isLoggedIn' => true
            ];
            
            session()->set($sessionData);
            
            return redirect()->to('/dashboard')->with('success', 'Welcome back!');
        }

        return redirect()->back()->with('error', 'Invalid email or password');
    }

    public function logout() { 
        session()->destroy(); 
        return redirect()->to('/login'); 
    }
}