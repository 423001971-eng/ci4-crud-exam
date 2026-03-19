<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        // Check if session exists (extra safety)
        if (!session()->get('user')['id']) {
            return redirect()->to('/login');
        }

        // IMPORTANT: Change 'welcome_message' to 'dashboard'
        return view('dashboard'); 
    }
}