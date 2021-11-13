<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
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
$routes->setTranslateURIDashes(true);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
     Metode GET = membuat daftar data sumber daya.
     Metode POST = menyimpan data.
     Metode PUT OR PATCH = memperbarui data yang ada di server.
     Metode DELETE = menghapus data resource di server.
* --------------------------------------------------------------------
* Placeholders
     'any'      => '.*',
     'segment'  => '[^/]+',
     'alphanum' => '[a-zA-Z0-9]+',
     'num'      => '[0-9]+',
     'alpha'    => '[a-zA-Z]+',
     'hash'     => '[^/]+',
* https://github.com/codeigniter4/CodeIgniter4/blob/develop/system/Router/RouteCollection.php
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// $routes->addPlaceholder('uuid', '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}');
// $routes->get('/', 'Home::index');
// $routes->get('client/(:num)', 'Home::index/$1');
$routes->get('home/(:num)', 'Home::index/$1'); // client dashboard
$routes->get('users/profil/(:num)', 'Users::profil/$1'); // all profile
$routes->get('progress', 'Progress::index');
$routes->get('service/add', 'Service::add');
$routes->get('service/detail/(:num)', 'Service::detail/$1');

// $routes->get('/', 'Home::index', ['filter' => 'role:admin,advisor']);
// $routes->get('/', 'Home::asuransi', ['as' => '/'], ['filter' => 'role:asuransi,surveyor']);
// $routes->get('home', 'Home::client', ['as' => '/'], ['filter' => 'role:client']);
$routes->get('users', 'Users::index', ['filter' => 'role:admin,advisor']);

$routes->group('users', ['filter' => 'role:admin,advisor'], function ($routes) {
    // $routes->addRedirect('index', 'users');
    //     $routes->addRedirect('detail', 'users');
    // $routes->get('users', 'Users::index');
    //     $routes->get('detail/(:num)', 'Users::detail/$1');
    //     $routes->delete('delete/(:num)', 'Users::delete/$1');
    $routes->get('add', 'Users::add');
    //     $routes->post('addsave', 'Users::addsave');
    //     $routes->get('login', 'Users::login');
});

$routes->group('users', ['filter' => 'role:admin,advisor,asuransi,surveyor,client'], function ($routes) {
    //     $routes->addRedirect('index', 'users');
    //     $routes->addRedirect('detail', 'users');
    //     $routes->get('users', 'Users::index');
    //     $routes->get('detail/(:num)', 'Users::detail/$1');
    //     $routes->delete('delete/(:num)', 'Users::delete/$1');
    //     $routes->get('add', 'Users::add');
    //     $routes->post('addsave', 'Users::addsave');
    // $routes->put('profil/gantipassword/(:num)', 'Users::gantipassword/$1');
});

$routes->group('mobil-jenis', ['filter' => 'role:admin,advisor'], function ($routes) {
    $routes->get('index', 'Mobil_Jenis::index', ['as' => 'mobil-jenis']);
    $routes->addRedirect('index', 'mobil-jenis/');
    $routes->post('add', 'Mobil_Jenis::add');
    $routes->put('edit/(:num)', 'Mobil_Jenis::edit');
    $routes->delete('remove/(:num)', 'Mobil_Jenis::remove');
});

$routes->group('mobil-merk', ['filter' => 'role:admin,advisor'], function ($routes) {
    $routes->get('index', 'Mobil_Merk::index', ['as' => 'mobil-merk']);
    $routes->addRedirect('index', 'mobil-Merk/');
    $routes->post('add', 'Mobil_Merk::add');
    $routes->put('edit/(:num)', 'Mobil_Merk::edit');
    $routes->delete('remove/(:num)', 'Mobil_Merk::remove');
});

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
