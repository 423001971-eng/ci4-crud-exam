<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// --- PUBLIC ROUTES ---
// 1. Change the landing page to redirect to login if not authenticated
$routes->get('/', 'AuthController::login'); 

// Auth Routes
$routes->get('register', 'AuthController::register');
$routes->post('register/store', 'AuthController::store');
$routes->get('login', 'AuthController::login');
$routes->post('login/auth', 'AuthController::authenticate');
$routes->get('logout', 'AuthController::logout');

// --- PROTECTED ROUTES (Requires Login) ---
$routes->group('', ['filter' => 'auth'], function($routes) {
    
    // 2. This is now your actual Dashboard
    $routes->get('dashboard', 'Home::index');

    // Profile Routes
    $routes->get('profile',         'ProfileController::show');
    $routes->get('profile/edit',    'ProfileController::edit');
    $routes->post('profile/update', 'ProfileController::update');

    // Product Routes
    $routes->group('products', function($routes) {
        $routes->get('/',               'ProductController::index');
        $routes->get('show/(:num)',     'ProductController::show/$1'); 
        $routes->get('create',          'ProductController::create');
        $routes->post('store',          'ProductController::store');
        $routes->get('edit/(:num)',     'ProductController::edit/$1');
        $routes->post('update/(:num)',  'ProductController::update/$1');
        $routes->get('delete/(:num)',   'ProductController::delete/$1');
    });
});