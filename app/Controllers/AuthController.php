<?php namespace App\Controllers;
use App\Models\UserModel;

class AuthController extends BaseController {
    public function register() { return view('auth/register'); }

    public function store() {
        $rules = [
            'name' => 'required',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
            'confirm_password' => 'matches[password]'
        ];
        if (!$this->validate($rules)) return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());

        (new UserModel())->save([
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT)
        ]);
        return redirect()->to('/login')->with('success', 'Registered successfully!');
    }

    public function login() { return view('auth/login'); }

    public function authenticate() {
        $user = (new UserModel())->where('email', $this->request->getPost('email'))->first();
        if ($user && password_verify($this->request->getPost('password'), $user['password'])) {
            session()->set(['isLoggedIn' => true, 'user_name' => $user['name']]);
            return redirect()->to('/products');
        }
        return redirect()->back()->with('error', 'Invalid credentials');
    }

    public function logout() { session()->destroy(); return redirect()->to('/login'); }
}