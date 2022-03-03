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

// routes for news
// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

// gets rid of index e.g. news => news/index
// gets rid of news/view/ in overview.php
$routes->get('news', 'News::index');

// shortens the url e.g. news/xyz => news/view/xyz
$routes->get('news/(:segment)', 'News::view/$1');

$routes->match(['get', 'post'], 'news/create', 'News::create');


// routes for local
$routes->match(['get', 'post'], 'local/create', 'Local::create');

// gets rid of index e.g. news => local/index
$routes->get('local', 'Local::index');

// shortens the url e.g. news/xyz => Local/view/xyz
$routes->get('local/(:segment)', 'Local::view/$1');


// routes for uk
$routes->match(['get', 'post'], 'uk/create', 'Uk::create');

// gets rid of index e.g. uk => uk/index
$routes->get('uk', 'Uk::index');

// shortens the url e.g. uk/xyz => Uk/view/xyz
$routes->get('uk/(:segment)', 'Uk::view/$1');


// routes for world
$routes->match(['get', 'post'], 'world/create', 'World::create');

// gets rid of index e.g. worldNews => world/index
$routes->get('world', 'World::index');

// shortens the url e.g. uk/xyz => World/view/xyz
$routes->get('world/(:segment)', 'World::view/$1');



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
