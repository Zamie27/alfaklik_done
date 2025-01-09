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
    // sistem CRUD barang
    $routes->get('dashboard/barang', 'Admin\Dashboard::indexBarang');
    $routes->get('dashboard/create-barang', 'Admin\Dashboard::createBarang');
    $routes->post('dashboard/store-barang', 'Admin\Dashboard::storeBarang');
    $routes->get('dashboard/edit-barang/(:num)', 'Admin\Dashboard::editBarang/$1');
    $routes->post('dashboard/update-barang/(:num)', 'Admin\Dashboard::updateBarang/$1');
    $routes->get('dashboard/delete-barang/(:num)', 'Admin\Dashboard::deleteBarang/$1');
    // sistem CRUD Akun
    $routes->get('dashboard/akun', 'Admin\Dashboard::indexAkun');
    $routes->get('dashboard/akun/createAkun', 'Admin\Dashboard::createAkun');
    $routes->post('dashboard/akun/storeAkun', 'Admin\Dashboard::storeAkun');
    $routes->get('dashboard/akun/editAkun/(:num)', 'Admin\Dashboard::editAkun/$1');
    $routes->post('dashboard/akun/updateAkun/(:num)', 'Admin\Dashboard::updateAkun/$1');
    $routes->get('dashboard/akun/deleteAkun/(:num)', 'Admin\Dashboard::deleteAkun/$1');
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
    $routes->get('barang/detail/(:num)', 'Pelanggan\Dashboard::detail_barang/$1'); // Detail barang
    $routes->get('search', 'Pelanggan\Dashboard::search'); // Cari barang
    // Sistem Ckeckout
    $routes->get('cart', 'Pelanggan\CartController::index');
    $routes->post('cart/add', 'Pelanggan\CartController::addToCart');
    $routes->post('cart/remove/(:num)', 'Pelanggan\CartController::removeFromCart/$1');
    $routes->post('cart/update', 'Pelanggan\CartController::updateQuantity');
    $routes->get('checkout', 'Pelanggan\OrderController::checkout');
    $routes->post('order/place', 'Pelanggan\OrderController::placeOrder');
    // profile pelanggan
    $routes->get('profile', 'Pelanggan\ProfileController::index');
    $routes->post('profile/update', 'Pelanggan\ProfileController::update');
    $routes->post('profile/updatePhoto', 'Pelanggan\ProfileController::updatePhoto');

    // Tambahkan route lain untuk pelanggan
});


// Routes 404
$routes->set404Override(function () {
    return view('errors/404');
});
