<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        // Initialize session service
        $session = \Config\Services::session();

        // Set a test session value
        $session->set('test', 'Hello World');

        // Get the session value
        $test = $session->get('test'); // Should return "Hello World"

        // Pass it to the view OR just echo for testing
        echo $test;

        // Optionally, return a view
        // return view('welcome_message');
    }
}