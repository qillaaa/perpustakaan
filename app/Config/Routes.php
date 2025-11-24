<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// ================= PUBLIC ROUTES =================
$routes->get('/', 'Home::index');

// ================= AUTH ROUTES (Shield) =================
service('auth')->routes($routes);

// Redirect after login & logout
$routes->get('authredirect/afterLogin', 'AuthRedirect::afterLogin');
$routes->get('logout', 'AuthRedirect::logout');

// ================= ADMIN ROUTES =================
$routes->group('admin', [
    'namespace' => 'App\Controllers\Admin',
    'filter'    => 'group:admin'
], function ($routes) {
    $routes->get('dashboard', 'DashboardController::index');

    // Buku
    $routes->get('books', 'BookController::index');
    $routes->get('books/create', 'BookController::create');
    $routes->post('books/store', 'BookController::store');
    $routes->get('books/edit/(:num)', 'BookController::edit/$1');
    $routes->post('books/update/(:num)', 'BookController::update/$1');
    $routes->get('books/delete/(:num)', 'BookController::delete/$1');

    // Kategori
    $routes->get('categories', 'CategoryController::index');
    $routes->get('categories/create', 'CategoryController::create');
    $routes->post('categories/store', 'CategoryController::store');
    $routes->get('categories/edit/(:num)', 'CategoryController::edit/$1');
    $routes->post('categories/update/(:num)', 'CategoryController::update/$1');
    $routes->get('categories/delete/(:num)', 'CategoryController::delete/$1');

    // Peminjaman
    $routes->get('peminjaman', 'PeminjamanController::index');
    $routes->get('peminjaman/kembalikan/(:num)', 'PeminjamanController::kembalikan/$1');

    // User Management
    $routes->get('users', 'UserController::index');

    // Ulasan Admin
    $routes->get('ulasan', 'UlasanAdminController::index');

    // ================= Profile Admin =================
    $routes->get('profile', 'AdminProfileController::index');
    $routes->post('profile/update', 'AdminProfileController::update');
});

// ================= USER ROUTES =================
$routes->group('user', [
    'namespace' => 'App\Controllers\User',
    'filter'    => 'group:user'
], function ($routes) {

    // Dashboard
    $routes->get('dashboard', 'DashboardController::index');

    // Buku umum
    $routes->get('books', 'BooksController::index');
    $routes->get('books/view/(:num)', 'BooksController::view/$1');
    $routes->get('books/borrow/(:num)', 'BooksController::borrow/$1');
    $routes->get('books/favorite/(:num)', 'BooksController::favorite/$1');

    // Favorites
    $routes->get('favorites', 'FavoriteController::index');
    $routes->get('favorites/add/(:num)', 'FavoriteController::add/$1');
    $routes->get('favorites/remove/(:num)', 'FavoriteController::remove/$1');

    // My Books (buku yang dipinjam user)
    $routes->get('mybooks', 'MyBooksController::index');
    $routes->post('mybooks/konfirmasi/(:num)', 'MyBooksController::konfirmasi/$1');

    // File buku
    $routes->get('file/book/(:any)', 'BooksController::serveBook/$1');

    // Cart
    $routes->get('cart', 'CartController::index');
    $routes->get('cart/add/(:num)', 'CartController::add/$1');
    $routes->get('cart/remove/(:num)', 'CartController::remove/$1');
    $routes->get('cart/clear', 'CartController::clear');
    $routes->post('cart/checkout', 'CartController::checkout');

    // Review / Ulasan
    $routes->get('reviews', 'ReviewController::index');
    $routes->get('reviews/add/(:num)', 'ReviewController::add/$1');
    $routes->post('reviews/save', 'ReviewController::save');
    $routes->post('reviews/update/(:num)', 'ReviewController::update/$1');
    $routes->get('reviews/delete/(:num)', 'ReviewController::delete/$1');

    // History
    $routes->get('history', 'HistoryController::index');

    // Profile
    $routes->get('profile', 'ProfileController::index');
    $routes->post('profile/update', 'ProfileController::update');
});
