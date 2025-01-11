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
    // sistem CRUD banner
    $routes->get('dashboard/banner', 'Admin\Dashboard::indexBanner');
    $routes->get('dashboard/banner/create', 'Admin\Dashboard::createBanner');
    $routes->post('dashboard/banner/store', 'Admin\Dashboard::storeBanner');
    $routes->get('dashboard/banner/edit/(:num)', 'Admin\Dashboard::editBanner/$1');
    $routes->post('dashboard/banner/update/(:num)', 'Admin\Dashboard::updateBanner/$1');
    $routes->get('dashboard/banner/delete/(:num)', 'Admin\Dashboard::deleteBanner/$1');
    // profile pelanggan
    $routes->get('dashboard/profile', 'Admin\Dashboard::indexProfile');
    $routes->post('dashboard/profile/update', 'Admin\Dashboard::updateProfile');
    $routes->post('dashboard/profile/updatePhoto', 'Admin\Dashboard::updatePhotoProfile');
    // Laporan Penjualan
    $routes->get('laporan-penjualan', 'Admin\Dashboard::laporanPenjualan');
    $routes->get('detail-order/(:num)', 'Admin\Dashboard::detailOrder/$1');
    // Tambahkan route lain untuk admin
});

// Route untuk Krew
$routes->group('krew', ['filter' => 'auth:krew'], function ($routes) {
    $routes->get('dashboard', 'Krew\Dashboard::index');
    $routes->get('orders', 'Krew\Dashboard::orders');
    $routes->get('orders/detail/(:num)', 'Krew\Dashboard::detail/$1');
    $routes->get('orders/process/(:num)', 'Krew\Dashboard::process/$1');
    $routes->get('orders/ship/(:num)', 'Krew\Dashboard::ship/$1');
    $routes->get('orders/complete/(:num)', 'Krew\Dashboard::complete/$1');
    $routes->get('orders/cancel/(:num)', 'Krew\Dashboard::cancel/$1');
    // profile pelanggan
    $routes->get('dashboard/profile', 'Krew\Dashboard::indexProfile');
    $routes->post('dashboard/profile/update', 'Krew\Dashboard::updateProfile');
    $routes->post('dashboard/profile/updatePhoto', 'Krew\Dashboard::updatePhotoProfile');
    // Tambahkan route lain untuk krew
});

// Route untuk Pelanggan
$routes->group('pelanggan', ['filter' => 'auth:pelanggan'], function ($routes) {
    $routes->get('dashboard', 'Pelanggan\Dashboard::index');
    $routes->get('barang/detail/(:num)', 'Pelanggan\Dashboard::detail_barang/$1');
    $routes->get('search', 'Pelanggan\Dashboard::search');

    // Keranjang
    $routes->get('cart', 'Pelanggan\CartController::index');
    $routes->post('cart/add', 'Pelanggan\CartController::addToCart');
    $routes->post('cart/remove/(:num)', 'Pelanggan\CartController::removeFromCart/$1');
    $routes->post('cart/update', 'Pelanggan\CartController::updateQuantity');

    // Checkout
    $routes->get('checkout', 'Pelanggan\CheckoutController::index');
    $routes->post('checkout', 'Pelanggan\CheckoutController::checkout');
    $routes->post('checkoutp', 'Pelanggan\CheckoutController::toPayment');
    $routes->post('checkout/to-payment', 'Pelanggan\CheckoutController::toPayment'); // Proses pilih pembayaran

    // Orders
    $routes->get('orders', 'Pelanggan\OrderController::index');
    $routes->get('orders/detail/(:num)', 'Pelanggan\OrderController::detail/$1');
    $routes->post('order/place', 'Pelanggan\OrderController::placeOrder');
    $routes->get('order/success', 'Pelanggan\OrderController::success');

    // Payment
    $routes->get('payment', 'Pelanggan\PaymentController::index'); // Halaman pembayaran
    $routes->post('payment/confirm', 'Pelanggan\PaymentController::confirmPayment'); // Proses konfirmasi pembayaran

    // Profile Pelanggan
    $routes->get('profile', 'Pelanggan\ProfileController::index');
    $routes->post('profile/update', 'Pelanggan\ProfileController::update');
    $routes->post('profile/updatePhoto', 'Pelanggan\ProfileController::updatePhoto');

    // Tambahkan route lain untuk pelanggan
});


// Routes 404
$routes->set404Override(function () {
    return view('errors/404');
});
