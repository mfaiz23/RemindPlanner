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






$routes->get('/register', 'RegisterController::index');
$routes->post('/register/store', 'RegisterController::store');

// Akses user
$routes->group('', ['filter' => 'rolecheck:user'], function($routes) {
    $routes->get('user/dashboard', 'DashboardController::index');
    $routes->get('user/categories', 'CategoriesController::index');
$routes->get('categories/create', 'CategoriesController::create');
$routes->post('categories/store', 'CategoriesController::store');
$routes->get('categories/edit/(:num)', 'CategoriesController::edit/$1');
$routes->post('categories/update/(:num)', 'CategoriesController::update/$1');
$routes->get('categories/delete/(:num)', 'CategoriesController::delete/$1');
$routes->get('categories/list_categories', 'CategoriesController::index');
$routes->get('user/tasks', 'TasksController::index');
$routes->get('user/tasks/create', 'TasksController::create');
$routes->post('tasks/store', 'TasksController::store');
$routes->get('tasks/edit/(:num)', 'TasksController::edit/$1');
$routes->post('tasks/update/(:num)', 'TasksController::update/$1');
$routes->get('tasks/delete/(:num)', 'TasksController::delete/$1');
$routes->get('user/tasks/list_task', 'TasksController::index');
});




