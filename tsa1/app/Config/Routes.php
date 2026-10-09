<?php

namespace Config;

use CodeIgniter\Config\Services;

$routes = Services::routes();

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

$routes->get('/', 'Pages::index');
$routes->get('/tasks', 'Pages::tasks');
$routes->get('/profile', 'Pages::profile');
$routes->get('/about', 'Pages::about');