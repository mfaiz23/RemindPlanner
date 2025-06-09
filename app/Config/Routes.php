<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Route to serve uploaded profile images
$routes->get('writable/uploads/profile/(:any)', function($filename) {
    $filepath = WRITEPATH . 'uploads/profile/' . $filename;
    if (file_exists($filepath)) {
        $mime = mime_content_type($filepath);
        header('Content-Type: ' . $mime);
        readfile($filepath);
        exit;
    } else {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }
});

$routes->get('/login', 'AuthController::login');
$routes->post('/login/proses', 'AuthController::prosesLogin');
$routes->get('/auth/googleCallback', 'AuthController::googleCallback');
$routes->get('/logout', 'AuthController::logout');

$routes->get('/register', 'RegisterController::index');
$routes->post('/register/store', 'RegisterController::store');

// Forgot Password Routes
$routes->get('/forgot_password', 'ForgotPasswordController::index');
$routes->post('/forgot_password', 'ForgotPasswordController::sendOtp');
$routes->get('/forgot_password/verify_otp', 'ForgotPasswordController::showVerifyOtpForm');
$routes->post('/forgot_password/verify_otp', 'ForgotPasswordController::submitVerifyOtp');
$routes->post('/forgot_password/update_password', 'ForgotPasswordController::update_password');
$routes->get('/reset_password', 'ForgotPasswordController::reset_password');
$routes->get('/forgot_password/resend_otp', 'ForgotPasswordController::resendOtp');

// Static Pages Routes
$routes->get('/terms', 'StaticPagesController::terms');
$routes->get('/privacy', 'StaticPagesController::privacy');

// Admin routes
$routes->group('', ['filter' => 'rolecheck:admin'], function($routes) {
    $routes->get('admin/dashboard', 'DashboardController::admin');
    $routes->get('admin/users', 'UserListController::index');
    $routes->post('admin/users/delete/(:num)', 'UserListController::delete/$1');
    $routes->get('admin/users/delete/(:num)', 'UserListController::confirmDelete/$1');
     $routes->get('admin/tasks', 'TaskListController::index');
    // Add more admin routes as needed
});

// User routes
$routes->group('', ['filter' => 'rolecheck:user'], function($routes) {
    $routes->get('user/dashboard', 'DashboardController::index');
    $routes->get('user/profile/edit', 'UserController::editProfile');
    $routes->post('user/profile/update', 'UserController::updateProfile');
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
    $routes->post('tasks/update-status', 'TasksController::updateStatus');
    $routes->get('user/tasks/list_task', 'TasksController::index'); 
    $routes->get('user/calendar/calendartest', 'CalendarController::index');
    $routes->get('user/calendar/events', 'CalendarController::events');
});