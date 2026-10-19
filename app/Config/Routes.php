<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

$routes->get('/', 'Home::index');
$routes->get('/main', 'Main::index');
$routes->get('/'register, 'Main::index');
$routes->get('/'login, 'Login::index');
