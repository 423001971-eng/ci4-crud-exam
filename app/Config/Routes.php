<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// --- PUBLIC ROUTES ---
$routes->get('/', 'AuthController::login');
$routes->get('login', 'AuthController::login');
$routes->post('login/auth', 'AuthController::loginAuth');
$routes->get('register', 'AuthController::register');
$routes->post('register/store', 'AuthController::registerSave');
$routes->get('logout', 'AuthController::logout');
$routes->get('unauthorized', 'AuthController::unauthorized');

// --- EVERYONE (Auth passes, they see it) ---
$routes->group('', ['filter' => ['auth']], function ($routes) {
    $routes->get('dashboard',                  'Home::index');
});

// --- STUDENT ONLY (Profile access) ---
$routes->group('', ['filter' => ['auth', 'student']], function ($routes) {
    $routes->get('profile',                    'ProfileController::show');
    $routes->get('profile/edit',               'ProfileController::edit');
    $routes->post('profile/update',            'ProfileController::update');
    $routes->get('student/dashboard',          'Home::index'); 
});

// --- TEACHER & ADMIN (Student lists and management) ---
$routes->group('', ['filter' => ['auth', 'teacher']], function ($routes) {
    $routes->get('students',                    'RecordController::index');
    $routes->get('students/show/(:num)',        'RecordController::show/$1');
    $routes->get('students/create',             'RecordController::create');
    $routes->post('students/store',             'RecordController::store');
    $routes->get('students/edit/(:num)',        'RecordController::edit/$1');
    $routes->post('students/update/(:num)',     'RecordController::update/$1');
    $routes->get('students/delete/(:num)',      'RecordController::delete/$1');
});

// --- COORDINATOR ONLY ---
$routes->group('coordinator', ['filter' => ['auth', 'coordinator']], function ($routes) {
    $routes->get('dashboard', 'CoordinatorController::index');
    $routes->get('profile', 'CoordinatorController::profile');
    $routes->get('files', 'CoordinatorController::files');
});
// --- ADMIN ONLY ---
$routes->group('admin', ['filter' => ['auth', 'admin'], 'namespace' => 'App\Controllers\Admin'], function ($routes) {
    $routes->get('settings',             '..\RecordController::index'); 
    
    // Role Management
    $routes->get('roles',                'RoleController::index');
    $routes->get('roles/create',         'RoleController::create');
    $routes->post('roles/store',         'RoleController::store');
    $routes->get('roles/edit/(:num)',    'RoleController::edit/$1');
    $routes->post('roles/update/(:num)', 'RoleController::update/$1');
    $routes->get('roles/delete/(:num)',  'RoleController::delete/$1');

    // User Management
    $routes->get('users',                'UserAdminController::index');
    $routes->post('users/assignRole/(:num)', 'UserAdminController::assignRole/$1');
});

// ════════════════════════════════════════════════════════════
//  API v1 — token-authenticated JSON endpoints
//
//  Public:    POST /api/v1/auth/token  (issue token)
//  Protected: DELETE /api/v1/auth/token, GET /api/v1/students(/{id})
//
//  Header: Authorization: Bearer <token>
// ════════════════════════════════════════════════════════════

// Issue token — no auth filter needed here
$routes->post('api/v1/auth/token', 'Api\AuthController::issueToken');

// Protected API routes
$routes->group('api/v1', ['filter' => 'api_auth'], function ($routes) {

    // Auth
    $routes->delete('auth/token', 'Api\AuthController::revokeToken');

    // Students resource
    $routes->get('students',       'Api\StudentsController::index');
    $routes->get('students/(:num)', 'Api\StudentsController::show/$1');

});
