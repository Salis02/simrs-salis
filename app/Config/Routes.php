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
$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], function($routes) {
    // Auth Routes
    $routes->get('login', 'AuthController::login');
    $routes->post('login', 'AuthController::login');
    $routes->get('logout', 'AuthController::logout');
    
    // Dashboard
    $routes->get('/', 'DashboardController::index');
    $routes->get('dashboard', 'DashboardController::index');
    
    // Doctors Management
    $routes->group('doctors', function($routes) {
        $routes->get('/', 'DoctorController::index');
        $routes->get('create', 'DoctorController::create');
        $routes->post('create', 'DoctorController::create');
        $routes->get('edit/(:num)', 'DoctorController::edit/$1');
        $routes->post('edit/(:num)', 'DoctorController::edit/$1');
        $routes->get('delete/(:num)', 'DoctorController::delete/$1');
        $routes->post('toggle-status/(:num)', 'DoctorController::toggleStatus/$1');
    });
    
    // Working Hours Management
    $routes->group('working-hours', function($routes) {
        $routes->get('/', 'WorkingHourController::index');
        $routes->get('create', 'WorkingHourController::create');
        $routes->post('create', 'WorkingHourController::create');
        $routes->get('edit/(:num)', 'WorkingHourController::edit/$1');
        $routes->post('edit/(:num)', 'WorkingHourController::edit/$1');
        $routes->get('delete/(:num)', 'WorkingHourController::delete/$1');
    });
    
    // Reservations Management
    $routes->group('reservations', function($routes) {
        $routes->get('/', 'ReservationController::index');
        $routes->get('show/(:num)', 'ReservationController::show/$1');
        $routes->post('update-status/(:num)', 'ReservationController::updateStatus/$1');
    });
    
    // Queues Management
    $routes->group('queues', function($routes) {
        $routes->get('/', 'QueueController::index');
        $routes->post('update-status/(:num)', 'QueueController::updateStatus/$1');
        $routes->post('call-next', 'QueueController::callNext');
    });
});