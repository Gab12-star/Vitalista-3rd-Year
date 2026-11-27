<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->get('/', 'AuthController::login');
$routes->match(['GET', 'POST'], 'login', 'AuthController::login');
$routes->get('logout', 'AuthController::logout');
$routes->match(['GET', 'POST'], 'setup', 'AuthController::setup');
$routes->get('dashboard', 'DashboardController::index');
$routes->get('products', 'ProductsController::index');
$routes->get('products/new', 'ProductsController::new');
$routes->post('products/create', 'ProductsController::create');
$routes->get('customers', 'CustomersController::index');
$routes->get('customers/new', 'CustomersController::new');
$routes->post('customers/create', 'CustomersController::create');
$routes->get('customers/edit/(:num)', 'CustomersController::edit/$1');
$routes->post('customers/update/(:num)', 'CustomersController::update/$1');
$routes->post('customers/delete/(:num)', 'CustomersController::delete/$1');
$routes->get('staff', 'StaffController::index');
$routes->get('staff/new', 'StaffController::new');
$routes->post('staff/create', 'StaffController::create');
$routes->get('staff/edit/(:num)', 'StaffController::edit/$1');
$routes->post('staff/update/(:num)', 'StaffController::update/$1');
$routes->post('staff/delete/(:num)', 'StaffController::delete/$1');
$routes->get('sales/new', 'SalesController::new');
$routes->post('sales/record', 'SalesController::record');
$routes->get('sales/history', 'SalesController::history');
$routes->get('admin/dashboard', 'AdminController::index');