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

    public function show()
    {
        //Get the ID from the session 
        $userId = session()->get('user')['id'] ?? null; 

        //Security Check: If no ID, the user isn't logged in
        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Please login to access your profile.');
        }

        //Fetch the specific user from the database
        $user = $this->userModel->find($userId);

        //Extra Safety: If user was deleted from DB but session still exists
        if (!$user) {
            session()->destroy();
            return redirect()->to('/login');
        }

        //Load the View and pass the $user data
        return view('profile/show', ['user' => $user]);
    }

    // Show Edit Form
    public function edit()
    {
        $userId = session()->get('user')['id'] ?? null;
        if (!$userId) return redirect()->to('/login');

        $user = $this->userModel->find($userId);
        return view('profile/edit', ['user' => $user]);
    }

    // The Process Form Submission
    public function update()
    {
        $userId = session()->get('user')['id'] ?? null;
        if (!$userId) return redirect()->to('/login');

        $user = $this->userModel->find($userId);

        // Validation Rules
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

        //Handle Image Upload Execution
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $uploadPath = FCPATH . 'uploads/profiles/';
            
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            //Delete old image if it exists
            if (!empty($user['profile_image']) && file_exists($uploadPath . $user['profile_image'])) {
                @unlink($uploadPath . $user['profile_image']);
            }

            $newName = $file->getRandomName();
            $file->move($uploadPath, $newName);
            $updateData['profile_image'] = $newName;
        }

        // Update Database
        $this->userModel->update($userId, $updateData);

        //Update Session name and profile image so the Dashboard greeting changes immediately
        $userSession = session()->get('user');
        $userSession['name'] = $updateData['name'];
        if (isset($updateData['profile_image'])) {
            $userSession['profile_image'] = $updateData['profile_image'];
        }
        session()->set('user', $userSession);

        return redirect()->to('/profile')->with('success', 'Profile updated successfully!');
    }
}