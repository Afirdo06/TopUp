<?php

namespace Config;

use Config\Services;

$routes = Services::routes();

$routes->get('/', 'LandingPage::index');

$routes->get('/login', 'LoginController::login');
$routes->post('/login', 'LoginController::login_process');

$routes->get('/register', 'LoginController::register');
$routes->post('/register_process', 'LoginController::register_process');

$routes->group('admin', ['filter' => 'auth'], function ($routes) {
    $routes->get('dashboard', 'AdminController::dashboard');
    $routes->get('logout', 'AdminController::logout');

    $routes->get('manage_games', 'AdminController::manageGames');
    $routes->get('games/add', 'AdminController::addGame');
    $routes->post('games/save', 'AdminController::saveGame');
    $routes->get('games/edit/(:num)', 'AdminController::editGame/$1');
    $routes->post('games/update/(:num)', 'AdminController::updateGame/$1');
    $routes->get('games/delete/(:num)', 'AdminController::deleteGame/$1');

    $routes->get('manage_packages', 'AdminController::managePackages');
    $routes->get('packages/manage_items/(:num)', 'AdminController::manageItems/$1');
    $routes->get('packages/add/(:num)', 'AdminController::addPackage/$1');
    $routes->post('packages/save', 'AdminController::savePackage');
    $routes->get('packages/edit/(:num)', 'AdminController::editPackage/$1');
    $routes->post('updatePackage/(:num)', 'AdminController::updatePackage/$1');
    $routes->post('packages/delete/(:segment)', 'AdminController::delete/$1');

    $routes->get('transactions', 'TransactionController::index');
    $routes->get('transactions/edit/(:num)', 'TransactionController::edit/$1');
    $routes->post('transactions/update/(:num)', 'TransactionController::update/$1');
    $routes->get('transactions/delete/(:num)', 'TransactionController::delete/$1');
    $routes->get('transactions/create', 'TransactionController::create');
    $routes->post('transactions/store', 'TransactionController::store');

    $routes->get('topup', 'TopupController::index');
    $routes->get('topup/(:num)', 'TopupController::show/$1');
});

$routes->group('user', ['filter' => 'auth'], function ($routes) {
    $routes->get('topup', 'UserController::topup');
    $routes->get('topup_game', 'UserController::topup');
    $routes->get('topup_game/(:num)', 'UserController::topup_game/$1');
    $routes->post('topup_process', 'UserController::topup_process');
    $routes->get('logout', 'LoginController::logout');
});
