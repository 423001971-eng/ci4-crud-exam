<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class CoordinatorController extends BaseController
{
    public function index()
    {
        return view('coordinator/dashboard');
    }

    public function profile()
    {
        // For basic coordination info
        return view('coordinator/profile');
    }

    public function files()
    {
        // For shared resources
        return view('coordinator/files');
    }
}
