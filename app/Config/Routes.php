<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// --- PUBLIC ROUTES ---
$routes->get('/', 'Home::index');

// Auth Routes
$routes->get('/register', 'AuthController::register');
$routes->post('/register/store', 'AuthController::store');
$routes->get('/login', 'AuthController::login');
$routes->post('/login/auth', 'AuthController::authenticate');
$routes->get('/logout', 'AuthController::logout');
$routes->group('products', ['filter' => 'auth'], function($routes) {

    $routes->get('/', 'ProductController::index');
    $routes->get('show/(:num)', 'ProductController::show/$1'); // Added Detail View Route
    $routes->get('create', 'ProductController::create');
    $routes->post('store', 'ProductController::store');
    $routes->get('edit/(:num)', 'ProductController::edit/$1');
    $routes->post('update/(:num)', 'ProductController::update/$1');
    $routes->get('delete/(:num)', 'ProductController::delete/$1');

    $routes->group('products', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'ProductController::index');
    
    // THIS IS THE MISSING LINE:
    // (:num) is a placeholder for the ID (like 1, 2, 3)
    $routes->get('show/(:num)', 'ProductController::show/$1'); 
    
    $routes->get('create', 'ProductController::create');
    $routes->post('store', 'ProductController::store');
    $routes->get('edit/(:num)', 'ProductController::edit/$1');
    $routes->post('update/(:num)', 'ProductController::update/$1');
    $routes->get('delete/(:num)', 'ProductController::delete/$1');
});
});