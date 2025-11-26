<?php

use CodeIgniter\Router\RouteCollection;

$routes->setAutoRoute(false);
//$routes->get('/', 'Home::index');
$routes->group('api', function($routes){
    // Autenticación
    $routes->post('login', 'AuthController::login');

    // CRUD de usuarios (protegido con JWT)
    $routes->get('usuarios', 'UsuarioController::index');
    $routes->get('usuarios/(:num)', 'UsuarioController::show/$1');
    $routes->post('usuarios', 'UsuarioController::create');
    $routes->put('usuarios/(:num)', 'UsuarioController::update/$1');
    $routes->delete('usuarios/(:num)', 'UsuarioController::delete/$1');
    // -------------------------------
    // CRUD CLASE
    // -------------------------------
    $routes->get('clase', 'ClaseController::index');
    $routes->get('clase/(:num)', 'ClaseController::show/$1');
    $routes->post('clase', 'ClaseController::create');
    $routes->put('clase/(:num)', 'ClaseController::update/$1');
    $routes->delete('clase/(:num)', 'ClaseController::delete/$1');
    // -------------------------------
    // CRUD ESTUDIANTE
    // -------------------------------
    $routes->get('estudiante', 'EstudianteController::index');
    $routes->get('estudiante/(:num)', 'EstudianteController::show/$1');
    $routes->post('estudiante', 'EstudianteController::create');
    $routes->put('estudiante/(:num)', 'EstudianteController::update/$1');
    $routes->delete('estudiante/(:num)', 'EstudianteController::delete/$1');
    // -------------------------------
    // CRUD ASISTENCIA
    // -------------------------------
    $routes->get('asistencia', 'AsistenciaController::index');
    $routes->get('asistencia/(:num)', 'AsistenciaController::show/$1');
    $routes->post('asistencia', 'AsistenciaController::create');
    $routes->put('asistencia/(:num)', 'AsistenciaController::update/$1');
    $routes->delete('asistencia/(:num)', 'AsistenciaController::delete/$1');
    // Registrar asistencia por QR
    $routes->post('asistencia/qr', 'AsistenciaController::registrarQR');
});

$routes->options('(:any)', function() {
    $response = service('response');
    $response->setHeader('Access-Control-Allow-Origin', '*');
    $response->setHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, DELETE');
    $response->setHeader('Access-Control-Allow-Headers', 'X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization, X-HTTP-Method-Override');
    $response->setStatusCode(200);
    return $response;
});