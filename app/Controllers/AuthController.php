<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class AuthController extends BaseController 
{
    // 1. Show the Registration Form
    public function register() 
    { 
        return view('auth/register'); 
    }

    // 2. Save the Registered User
    public function registerSave() {
        $rules = [
            'name'             => 'required',
            'email'            => 'required|valid_email|is_unique[users.email]',
            'password'         => 'required|min_length[6]',
            'confirm_password' => 'matches[password]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $model = new UserModel();
        
        $model->save([
            'name'          => $this->request->getPost('name'),
            'email'         => $this->request->getPost('email'),
            'password'      => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            'role_id'       => 3, // Default to student
            'profile_image' => 'default-avatar.png' 
        ]);

        return redirect()->to('/login')->with('success', 'Registered successfully! Please login.');
    }

    // 3. Show the Login Form
    public function login() 
    { 
        return view('auth/login'); 
    }

    // 4. Handle Login Logic
    public function loginAuth() {
        $db = \Config\Database::connect();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // 1. First, just find the user to give specific errors
        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Email address not found.');
        }

        if (!password_verify($password, $user['password'])) {
            return redirect()->back()->with('error', 'Incorrect password.');
        }

        // 2. getting the role information
        $builder = $db->table('users');
        $builder->select('users.*, roles.name as role_name');
        $builder->join('roles', 'roles.id = users.role_id', 'left'); // Left join to catch missing roles
        $builder->where('users.id', $user['id']);
        $found = $builder->get()->getRowArray();

        if (empty($found['role_name'])) {
            return redirect()->back()->with('error', 'No role assigned to this account. Please contact an administrator.');
        }

        // Normalize role for comparison
        $role = strtolower($found['role_name']);

        // Check if role is authorized
        $authorizedRoles = ['admin', 'teacher', 'student', 'coordinator'];
        if (!in_array($role, $authorizedRoles)) {
            return redirect()->back()->with('error', 'Unauthorized role: ' . $role);
        }

        // Set session data ONLY if authorized
        session()->set([
            'user' => [
                'id'            => $found['id'],
                'name'          => $found['name'],
                'email'         => $found['email'],
                'role'          => $found['role_name'],
                'profile_image' => $found['profile_image'] ?? 'default-avatar.png', 
            ],
            'isLoggedIn' => true
        ]);
        
        // Role-based redirection logic
        return match ($role) {
            'admin', 'teacher' => redirect()->to('/dashboard'),
            'coordinator'      => redirect()->to('/coordinator/dashboard'),
            'student'          => redirect()->to('/student/dashboard'),
        };
    }

    public function unauthorized()
    {
        return view('errors/unauthorized');
    }

    // 5. Handle Logout
    public function logout() { 
        session()->destroy(); 
        return redirect()->to('/login'); 
    }
}