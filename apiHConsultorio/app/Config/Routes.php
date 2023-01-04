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
//http://localhost:8080/api
$routes->group('api', ['namespace' => 'App\Controllers\API'], function($routes) {
   // http://localhost:8080/pacientes
$routes->get('pacientes','Pacientes::index');
$routes->post('pacientes/create','Pacientes::create');
$routes->get('pacientes/edit(:num)','Pacientes::edit/$1');
$routes->put('pacientes/update/(:num)','Pacientes::update/$1');
$routes->delete('pacientes/delete/(:num)','Pacientes::delete/$1');
//visitas
$routes->get('visitas','visitas::index');
$routes->post('visitas/create','Visitas::create');
$routes->get('visitas/edit(:num)','Visitas::edit/$1');
$routes->put('visitas/update/(:num)','Visitas::update/$1');
$routes->delete('visitas/delete/(:num)','Visitas::delete/$1');
$routes->get('visitas/paciente/(:num)','Visitas::getVisitasrelaByPacientes/$1');

//medicamentos
$routes->get('medicamentos','Medicamentos::index');
$routes->post('medicamentos/create','Medicamentos::create');
$routes->get('medicamentos/edit(:num)','Medicamentos::edit/$1');
$routes->put('medicamentos/update/(:num)','Medicamentos::update/$1');
$routes->delete('medicamentos/delete/(:num)','Medicamentos::delete/$1');
//recetas
$routes->get('recetas','Recetas::index');
$routes->post('recetas/create','Recetas::create');
$routes->get('recetas/edit(:num)','Recetas::edit/$1');
$routes->put('recetas/update/(:num)','Recetas::update/$1');
$routes->delete('recetas/delete/(:num)','Recetas::delete/$1');
$routes->get('recetas/paciente/(:num)','Recetas::getRecetasrelaByPacientes/$1');

//Examen
$routes->get('examenes','Examenes::index');
$routes->post('examenes/create','Examenes::create');
$routes->get('examenes/edit(:num)','Examenes::edit/$1');
$routes->put('examenes/update/(:num)','Examenes::update/$1');
$routes->delete('examenes/delete/(:num)','Examenes::delete/$1');
$routes->get('examenes/paciente/(:num)','Examenes::getExamenesrelaByPacientes/$1');
});


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