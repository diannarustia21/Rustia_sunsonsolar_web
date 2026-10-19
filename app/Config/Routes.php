<?php
use CodeIgniter\Router\RouteCollection;
/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->post('/register', 'Register::create');
$routes->post('/login', 'Login::authenticate');
$routes->get('/logout', 'Login::logout');

$routes->get('/customer', 'Customer::dashboard');
$routes->post('/customer/bookings', 'Customer::createBooking');
$routes->post('/customer/bookings/cancel/(:num)', 'Customer::cancelBooking/$1');
$routes->post('/customer/profile', 'Customer::updateProfile');
$routes->post('/customer/password', 'Customer::changePassword');
$routes->post('/customer/tickets', 'Customer::createTicket');

$routes->get('/admin', 'Admin::dashboard');
$routes->post('/admin/users/create', 'Admin::createEmployee');
$routes->post('/admin/users/status/(:num)', 'Admin::changeStatus/$1');
$routes->post('/admin/bookings/(:num)', 'Admin::updateBooking/$1');
$routes->post('/admin/notifications', 'Admin::sendNotification');
$routes->post('/admin/services', 'Admin::saveService');
$routes->post('/admin/announcements', 'Admin::postAnnouncement');

$routes->get('/technician', 'Technician::dashboard');
$routes->post('/technician/check-in/(:num)', 'Technician::checkIn/$1');
$routes->post('/technician/reports/(:num)', 'Technician::submitReport/$1');
