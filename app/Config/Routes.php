<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Public Routes
$routes->get('/', 'Home::index');
$routes->get('/available-slots', 'Home::getAvailableSlots');

// Reservation Routes (Public)
$routes->post('/reservation/create', 'ReservationController::create');

// Queue Routes (Public)
$routes->post('/queue/take', 'QueueController::takeQueue');
$routes->get('/queue/status', 'QueueController::getQueueStatus');

// Admin Routes
$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], function ($routes) {
    // Auth Routes
    $routes->get('login', 'AuthController::login');
    $routes->post('login', 'AuthController::login');
    $routes->get('logout', 'AuthController::logout');

    // Dashboard
    $routes->get('/', 'DashboardController::index');
    $routes->get('dashboard', 'DashboardController::index');

    // Doctors Management
    $routes->group('doctors', function ($routes) {
        $routes->get('/', 'DoctorController::index');
        $routes->get('create', 'DoctorController::create');
        $routes->post('create', 'DoctorController::create');
        $routes->get('edit/(:num)', 'DoctorController::edit/$1');
        $routes->post('edit/(:num)', 'DoctorController::edit/$1');
        $routes->get('delete/(:num)', 'DoctorController::delete/$1');
        $routes->post('toggle-status/(:num)', 'DoctorController::toggleStatus/$1');
    });

    // Working Hours Management
    $routes->group('working-hours', function ($routes) {
        $routes->get('/', 'WorkingHourController::index');
        $routes->get('create', 'WorkingHourController::create');
        $routes->post('create', 'WorkingHourController::create');
        $routes->get('edit/(:num)', 'WorkingHourController::edit/$1');
        // $routes->post('edit/(:num)', 'WorkingHourController::edit/$1');
        $routes->put('edit/(:num)', 'WorkingHourController::edit/$1');
        $routes->get('delete/(:num)', 'WorkingHourController::delete/$1');
    });

    // Reservations Management
    $routes->group('reservations', function ($routes) {
        $routes->get('/', 'ReservationController::index');
        $routes->get('show/(:num)', 'ReservationController::show/$1');
        $routes->post('update-status/(:num)', 'ReservationController::updateStatus/$1');
    });

    // Queues Management
    $routes->group('queues', function ($routes) {
        $routes->get('/', 'QueueController::index');
        $routes->post('update-status/(:num)', 'QueueController::updateStatus/$1');
        $routes->post('call-next', 'QueueController::callNext');
    });

    // User Management
    $routes->group('users', function ($routes) {
        $routes->get('/', 'UserController::index');
        $routes->get('create', 'UserController::create');
        $routes->post('create', 'UserController::create');
        $routes->get('edit/(:num)', 'UserController::edit/$1');
        $routes->post('edit/(:num)', 'UserController::edit/$1');
        $routes->post('delete/(:num)', 'UserController::delete/$1');
    });

    // Patient Management (Baru)
    $routes->group('patients', function ($routes) {
        $routes->get('/', 'PatientController::index');
        $routes->get('create', 'PatientController::create');
        $routes->post('create', 'PatientController::create');
        $routes->get('edit/(:num)', 'PatientController::edit/$1');
        $routes->post('edit/(:num)', 'PatientController::edit/$1');
        $routes->post('delete/(:num)', 'PatientController::delete/$1');
    });

    // Drugs Management (Baru)
    $routes->group('drugs', function ($routes) {
        $routes->get('/', 'DrugController::index');
        $routes->get('create', 'DrugController::create');
        $routes->post('create', 'DrugController::create');
        $routes->get('edit/(:num)', 'DrugController::edit/$1');
        $routes->post('edit/(:num)', 'DrugController::edit/$1');
        $routes->post('delete/(:num)', 'DrugController::delete/$1');
    });

    // Prescription Management (Baru)
    $routes->group('prescriptions', function ($routes) {
        $routes->get('/', 'PrescriptionController::index');
        $routes->get('create', 'PrescriptionController::create');
        $routes->post('create', 'PrescriptionController::create');
        $routes->get('view/(:num)', 'PrescriptionController::view/$1');
        $routes->get('edit/(:num)', 'PrescriptionController::edit/$1');
        $routes->post('edit/(:num)', 'PrescriptionController::edit/$1');
        $routes->post('delete/(:num)', 'PrescriptionController::delete/$1');
    });
});
