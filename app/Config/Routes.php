<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/home', 'Home::home', ['as' => 'home']);

$routes->get('/user', 'User::index', ['as' => 'users']);
$routes->get('/user/(.*)/edit', 'User::edit/$1', ['as' => 'edit-user']);
$routes->post('/user/(.*)', 'User::update/$1', ['as' => 'update-user']);
$routes->get('/user/(.*)/delete', 'User::delete/$1', ['as' => 'delete-user']);

// modal create-update user
$routes->get('/admin', 'Admin::index', ['as' => 'admins']);
$routes->post('/admin', 'Admin::create', ['as' => 'create-admin']);
$routes->post('/admin/(.*)', 'Admin::update/$1', ['as' => 'update-admin']);
$routes->get('/admin/(.*)/delete', 'Admin::delete/$1', ['as' => 'delete-admin']);

$routes->get('/karyawan', 'Employee::index', ['as' => 'employees']);
// ajax validate
$routes->get('/karyawan/new', 'Employee::new', ['as' => 'new-employee']);
$routes->post('/karyawan', 'Employee::create', ['as' => 'create-employee']);
$routes->get('/karyawan/(.*)/edit', 'Employee::edit/$1', ['as' => 'edit-employee']);
$routes->post('/karyawan/(.*)', 'Employee::update/$1', ['as' => 'update-employee']);
$routes->get('/karyawan/(.*)/delete', 'Employee::delete/$1', ['as' => 'delete-employee']);

// upload image
$routes->get('/photo', 'Photo::index', ['as' => 'photos']);
$routes->get('/photo/new', 'Photo::new', ['as' => 'new-photo']);
$routes->post('/photo', 'Photo::create', ['as' => 'upload-photo']);
$routes->get('/photo/(.*)/download', 'Photo::download/$1', ['as' => 'download-photo']);
$routes->get('/photo/(.*)/delete', 'Photo::delete/$1', ['as' => 'delete-photo']);

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
