<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/dashboard', 'Home::dashboard');
$routes->get('/assurance/form', 'CoverageController::form');
$routes->get('/assurance/list', 'CoverageController::list');
$routes->post('/assurance/save', 'CoverageController::simpan');
$routes->get('/assurance/history', 'CoverageController::riwayat');
$routes->get('/assurance/premi/(:num)', 'CoverageController::premi/$1');
$routes->delete('/assurance/delete/(:num)', 'CoverageController::hapus/$1');