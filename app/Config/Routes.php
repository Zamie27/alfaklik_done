<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//  Routes Setup
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Auth');
$routes->setDefaultMethod('login');
$routes->setTranslateURIDashes(false);
$routes->set404Override(function () {
    return view('errors/404');
});
$routes->setAutoRoute(false); // Turn off auto-routing for better security


//  Routes Public
$routes->get('/', 'Auth::login');
$routes->get('login', 'Auth::login');
$routes->post('auth/processLogin', 'Auth::processLogin');
$routes->get('register', 'Auth::register');
$routes->post('auth/processRegister', 'Auth::processRegister');
$routes->get('logout', 'Auth::logout');


// Route untuk Admin
$routes->group('admin', ['filter' => 'auth:admin'], function ($routes) {
    $routes->get('dashboard', 'Admin\Dashboard::index');
    // Tambahkan route lain untuk admin
});

// Route untuk Krew
$routes->group('krew', ['filter' => 'auth:krew'], function ($routes) {
    $routes->get('dashboard', 'Krew\Dashboard::index');
    // Tambahkan route lain untuk krew
});

// Route untuk Pelanggan
$routes->group('pelanggan', ['filter' => 'auth:pelanggan'], function ($routes) {
    $routes->get('dashboard', 'Pelanggan\Dashboard::index');
    // Tambahkan route lain untuk pelanggan
});


// Routes 404
$routes->set404Override(function () {
    return view('errors/404');
});
