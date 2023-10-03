<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//Authentikasi
$routes->match(['POST', 'GET'],'login', 'Auth::index');
$routes->get('logout', 'Auth::logout');

//Home
$routes->get('/', 'Home::index');
$routes->get('about', 'Home::about');
$routes->get('daftar-penyakit', 'Home::daftarPenyakit');
$routes->get('daftar-penyakit/detail/(:any)', 'BasisPengetahuan::singleData/$1');
$routes->match(['POST', 'GET'], 'diagnosa-penyakit', 'Home::diagnosaPenyakit');

//Admin
$routes->group('admin', ['filter' => 'auth'], function($routes) {
    $routes->get('beranda', 'Admin::index');
    
    //Hama dan penyakit
    $routes->group('hama-dan-penyakit', function($routes) {
        $routes->match(['POST', 'GET'], '/', 'HamaDanPenyakit::index');
        $routes->match(['POST', 'GET'], 'update/(:num)', 'HamaDanPenyakit::update/$1');
        $routes->get('delete/(:num)', 'HamaDanPenyakit::delete/$1');
    });

    //Jenis tanaman
    $routes->group('jenis-tanaman', function($routes) {
        $routes->match(['POST', 'GET'], '/', 'JenisTanaman::index');
        $routes->match(['POST', 'GET'], 'update/(:num)', 'JenisTanaman::update/$1');
        $routes->get('delete/(:num)', 'JenisTanaman::delete/$1');
    });

    //Gejala WIP
    $routes->group('gejala', function($routes) {
        $routes->match(['POST', 'GET'], '/', 'Gejala::index');
        $routes->match(['POST', 'GET'], 'update/(:num)', 'Gejala::update/$1');
        $routes->get('delete/(:num)', 'Gejala::delete/$1');
    });

    //Basis Pengetahuan
    $routes->group('basis-pengetahuan', function($routes) {
        $routes->match(['POST', 'GET'], '/', 'BasisPengetahuan::index');
        $routes->match(['POST', 'GET'], 'update/(:num)', 'BasisPengetahuan::update/$1');
        $routes->get('delete/(:num)', 'BasisPengetahuan::delete/$1');
    });
});