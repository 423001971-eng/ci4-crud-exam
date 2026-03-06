<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'AuthController::login');
$routes->get('/dashboard', 'ProductController::index', ['filter' => 'auth']);

// Authentication
$routes->get('/register', 'AuthController::register');
$routes->post('/register', 'AuthController::save');
$routes->get('/login', 'AuthController::login');
$routes->post('/login', 'AuthController::auth');
$routes->get('/logout', 'AuthController::logout');

// Products CRUD (protected by auth filter)
$routes->group('products', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'ProductController::index');
    $routes->get('create', 'ProductController::create');
    $routes->post('store', 'ProductController::store');
    $routes->get('edit/(:num)', 'ProductController::edit/$1');
    $routes->post('update/(:num)', 'ProductController::update/$1');
    $routes->get('delete/(:num)', 'ProductController::delete/$1');
});
