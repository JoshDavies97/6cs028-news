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
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

$routes->match(['get', 'post'], 'news/create', 'News::create');

$routes->match(['get', 'post'], 'localnews/create', 'localnews::create');

// shortens the url e.g. news/xyz => news/view/xyz
$routes->get('news/(:segment)', 'News::view/$1');

// shortens the url e.g. worldNews/xyz => worldNews/view/xyz
//$routes->get('worldNews/(:segment)', 'worldNews::view/$1');

// gets rid of index e.g. news => news/index
// gets rid of news/view/ in overview.php
$routes->get('news', 'News::index');

// gets rid of index e.g. worldNews => worldNews/index
$routes->get('worldnews', 'worldnews::index');

// gets rid of index e.g. ukNews => ukNews/index
$routes->get('uknews', 'uknews::index');

// gets rid of index e.g. news => localNews/index
$routes->get('localnews', 'localnews::index');



// home => pages/home
//$routes->get('(:any)', 'Pages::view/$1');

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
