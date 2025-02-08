<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('csrf-token', 'CsrfController::getToken');

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/dashboard', 'Home::dashboard');
$routes->get('/assurance/form', 'AssuranceController::form');
$routes->get('/assurance/list', 'AssuranceController::list');
$routes->post('/assurance/save', 'AssuranceController::simpan');
$routes->get('/assurance/history', 'AssuranceController::riwayat');
$routes->get('/assurance/premi/(:num)', 'AssuranceController::premi/$1');

$routes->delete('/assurance/delete/(:num)', 'AssuranceController::hapus/$1');
service('auth')->routes($routes);

$routes->group('', ['namespace' => 'CodeIgniter\Shield\Controllers'], function ($routes) {
    $routes->get('login', 'LoginController::loginView');
    $routes->post('login', 'LoginController::loginAction');
    $routes->get('register', 'RegisterController::registerView');
    $routes->post('register', 'RegisterController::registerAction');
    $routes->get('logout', 'LoginController::logoutAction');
});

$routes->group('admin', ['filter' => 'group:admin'], function ($routes) {
    $routes->get('dashboard', 'AdminController::index');
});
