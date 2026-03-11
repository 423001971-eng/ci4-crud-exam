<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class ProfileController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    // 4.1 — Display Profile
    public function show()
    {
        // 1. Get the ID from the session (Matches what we set in AuthController)
        $userId = session()->get('id') ?? session()->get('user_id'); 

        // 2. Security Check: If no ID, the user isn't logged in
        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Please login to access your profile.');
        }

        // 3. Fetch the specific user from the database
        $user = $this->userModel->find($userId);

        // 4. Extra Safety: If user was deleted from DB but session still exists
        if (!$user) {
            session()->destroy();
            return redirect()->to('/login');
        }

        // 5. Load the View and pass the $user data
        return view('profile/show', ['user' => $user]);
    }

    // 4.2 — Show Edit Form
    public function edit()
    {
        $userId = session()->get('id') ?? session()->get('user_id');
        if (!$userId) return redirect()->to('/login');

        $user = $this->userModel->find($userId);
        return view('profile/edit', ['user' => $user]);
    }

    // 4.3 — Process Form Submission
    public function update()
    {
        $userId = session()->get('id') ?? session()->get('user_id');
        if (!$userId) return redirect()->to('/login');

        $user = $this->userModel->find($userId);

        // 1. Validation Rules
        $rules = [
            'name'       => 'required|min_length[3]',
            'email'      => "required|valid_email|is_unique[users.email,id,{$userId}]",
            'student_id' => 'required',
            'course'     => 'required',
            'year_level' => 'required|numeric',
            'phone'      => 'required',
            'address'    => 'required',
        ];

        // Handle Image Upload Validation
        $file = $this->request->getFile('profile_image');
        if ($file && $file->isValid()) {
            $rules['profile_image'] = 'is_image[profile_image]|mime_in[profile_image,image/jpg,image/jpeg,image/png]|max_size[profile_image,2048]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $updateData = [
            'name'       => $this->request->getPost('name'),
            'email'      => $this->request->getPost('email'),
            'student_id' => $this->request->getPost('student_id'),
            'course'     => $this->request->getPost('course'),
            'year_level' => $this->request->getPost('year_level'),
            'section'    => $this->request->getPost('section'),
            'phone'      => $this->request->getPost('phone'),
            'address'    => $this->request->getPost('address'),
        ];

        // 2. Handle Image Upload Execution
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $uploadPath = FCPATH . 'uploads/profiles/';
            
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            // Delete old image if it exists
            if (!empty($user['profile_image']) && file_exists($uploadPath . $user['profile_image'])) {
                @unlink($uploadPath . $user['profile_image']);
            }

            $newName = $file->getRandomName();
            $file->move($uploadPath, $newName);
            $updateData['profile_image'] = $newName;
        }

        // 3. Update Database
        $this->userModel->update($userId, $updateData);

        // 4. Update Session name so the Dashboard greeting changes immediately
        session()->set('user_name', $updateData['name']);

        return redirect()->to('/profile')->with('success', 'Profile updated successfully!');
    }
}