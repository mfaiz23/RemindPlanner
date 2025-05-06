<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/login', 'AuthController::login');
$routes->post('/login/proses', 'AuthController::prosesLogin');
$routes->get('/auth/googleCallback', 'AuthController::googleCallback');
$routes->get('/logout', 'AuthController::logout');
$routes->get('/dashboard', 'DashboardController::index');


$routes->get('categories', 'CategoriesController::index');
$routes->get('categories/create', 'CategoriesController::create');
$routes->post('categories/store', 'CategoriesController::store');
$routes->get('categories/edit/(:num)', 'CategoriesController::edit/$1');
$routes->post('categories/update/(:num)', 'CategoriesController::update/$1');
$routes->get('categories/delete/(:num)', 'CategoriesController::delete/$1');
$routes->get('categories/list_categories', 'CategoriesController::index');



