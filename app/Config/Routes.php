<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//Web

$routes->get('markets', 'MarketController::index');
$routes->get('/markets/create', 'MarketController::create');
$routes->post('/markets/store', 'MarketController::store');
$routes->get('/markets/edit/(:num)', 'MarketController::edit/$1');
$routes->post('/markets/update', 'MarketController::update');
$routes->delete('/markets/delete/(:num)', 'MarketController::delete/$1');

$routes->get('markets_floor', 'FloorPlanController::index');
$routes->get('/markets_floor/create', 'FloorPlanController::create');
$routes->post('/markets_floor/store', 'FloorPlanController::store');
$routes->get('/markets_floor/edit/(:num)', 'FloorPlanController::edit/$1');
$routes->post('/markets_floor/update', 'FloorPlanController::update');
$routes->delete('/markets_floor/delete/(:num)', 'FloorPlanController::delete/$1');

$routes->get('products', 'ProductController::index');
$routes->get('/products/create', 'ProductController::create');
$routes->post('/products/store', 'ProductController::store');
$routes->get('/products/edit/(:num)', 'ProductController::edit/$1');
$routes->post('/products/update', 'ProductController::update');
$routes->delete('/products/delete/(:num)', 'ProductController::delete/$1');

$routes->get('products_floor', 'FloorProductController::index');
$routes->get('/products_floor/create', 'FloorProductController::create');
$routes->post('/products_floor/store', 'FloorProductController::store');
$routes->get('/products_floor/edit/(:num)', 'FloorProductController::edit/$1');
$routes->post('/products_floor/update', 'FloorProductController::update');
$routes->delete('/products_floor/delete/(:num)', 'FloorProductController::delete/$1');

$routes->get('products_varian', 'VarianController::index');
$routes->get('/products_varian/create', 'VarianController::create');
$routes->post('/products_varian/store', 'VarianController::store');
$routes->get('/products_varian/edit/(:num)', 'VarianController::edit/$1');
$routes->post('/products_varian/update', 'VarianController::update');
$routes->delete('/products_varian/delete/(:num)', 'VarianController::delete/$1');
// -----------------------------------------------------------------------------------
// API
$routes->get('api/ProductbyCat/(:any)', 'Api_Product::showbyCategory/$1');
$routes->get('api/ProductbyFloor/(:any)', 'Api_Product::showbyFloor/$1');
$routes->get('api/Product', 'Api_Product::index');
$routes->get('api/Product/(:any)', 'Api_Product::show/$1');
$routes->get('api/Market', 'Api_Market::index');
$routes->get('api/Market/(:any)', 'Api_Market::show/$1');



// -----------------------------------------------------------------------------------


$routes->get('/', 'Home::index');
$routes->get('/market', 'Market::index');
$routes->post('/market/store', 'Market::store');
$routes->post('/market/update', 'Market::update');
$routes->delete('/market/delete/(:num)', 'Market::delete/$1');

$routes->get('/market/floor', 'FloorPlan::index');
$routes->post('/market/floor/store', 'FloorPlan::store');
$routes->post('/market/floor/update', 'FloorPlan::update');
$routes->delete('/market/floor/delete/(:num)', 'FloorPlan::delete/$1');

$routes->get('/product', 'Product::index');
$routes->post('/product/store', 'Product::store');
$routes->post('/product/update', 'Product::update');
$routes->delete('/product/delete/(:num)', 'Product::delete/$1');

$routes->get('/product/floor', 'FloorProduct::index');
$routes->post('/product/floor/store', 'FloorProduct::store');
$routes->post('/product/floor/update', 'FloorProduct::update');
$routes->delete('/product/floor/delete/(:num)', 'FloorProduct::delete/$1');

//RestApi
$routes->resource('ProductApi');
$routes->resource('FloorPlanApi');
$routes->resource('MarketApi');
$routes->get('/marketFloor/(:any)', 'MarketApi::marketFloor/$1');