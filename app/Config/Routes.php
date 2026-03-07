<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->setAutoRoute(false);

$routes->get('/', 'Home::index');
$routes->get('about', 'Home::about');
$routes->get('projects', 'Home::projects');
$routes->get('project/(:num)', 'Home::projectDetail/$1');
$routes->get('blog', 'Home::blog');
$routes->get('blog/(:segment)', 'Home::blogDetail/$1');
$routes->get('contact', 'Home::contact');
$routes->get('lang/switch/(:any)', 'LanguageController::switch/$1');

$routes->match(['get', 'post'], 'admin/login', 'Admin::login');
$routes->get('admin/logout', 'Admin::logout');

$routes->group('admin', ['filter' => 'authGuard'], static function ($routes) {

    $routes->get('/', 'Admin::dashboard');
    $routes->get('dashboard', 'Admin::dashboard');

    $routes->post('translate', 'Admin::translate');

    $routes->get('categories', 'Category::index');
    $routes->post('categories/store', 'Category::store');
    $routes->post('categories/update', 'Category::update');
    $routes->get('categories/delete/(:num)', 'Category::delete/$1');

    $routes->get('blogs', 'Blog::index');
    $routes->match(['get', 'post'], 'blog/create', 'Blog::create');
    $routes->match(['get', 'post'], 'blog/edit/(:num)', 'Blog::edit/$1');
    $routes->get('blog/delete/(:num)', 'Blog::delete/$1');
    $routes->post('blog/toggle-featured/(:num)', 'Blog::toggleFeatured/$1');

    $routes->get('projects', 'Project::index');
    $routes->match(['get', 'post'], 'project/create', 'Project::create');
    $routes->match(['get', 'post'], 'projects/create', 'Project::create');
    $routes->match(['get', 'post'], 'project/edit/(:num)', 'Project::edit/$1');
    $routes->match(['get', 'post'], 'projects/edit/(:num)', 'Project::edit/$1');
    $routes->get('project/delete/(:num)', 'Project::delete/$1');
    $routes->get('projects/delete/(:num)', 'Project::delete/$1');
    $routes->post('project/toggle-featured/(:num)', 'Project::toggleFeatured/$1');

    $routes->get('gallery', 'Project::galleryIndex');
    $routes->get('gallery/(:num)', 'Project::gallery/$1');
    $routes->post('gallery/upload/(:num)', 'Project::uploadGallery/$1');
    $routes->get('gallery/delete/(:num)', 'Project::deleteGallery/$1');

});