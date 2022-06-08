<?php

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\LoginController;
use Controllers\PaginasController;
use Controllers\VendedorController;
use Controllers\PropiedadController;

$router = new Router();

//Propiedades
$router->get('/admin',[PropiedadController::class, 'index']);
$router->get('/propiedades/crear',[PropiedadController::class, 'crear']);
$router->get('/propiedades/actualizar',[PropiedadController::class, 'actualizar']);
$router->post('/propiedades/crear',[PropiedadController::class, 'crear']);
$router->post('/propiedades/actualizar',[PropiedadController::class, 'actualizar']);
$router->post('/propiedades/eliminar',[PropiedadController::class, 'eliminar']);

//Vendedores
$router->get('/vendedores/crear',[VendedorController::class, 'crear']);
$router->get('/vendedores/actualizar',[VendedorController::class, 'actualizar']);
$router->post('/vendedores/crear',[VendedorController::class, 'crear']);
$router->post('/vendedores/actualizar',[VendedorController::class, 'actualizar']);
$router->post('/vendedores/eliminar',[VendedorController::class, 'eliminar']);

//Public
$router->get('/', [PaginasController::class, 'index']);
$router->get('/nosotros', [PaginasController::class, 'nosotros']);
$router->get('/portafolio', [PaginasController::class, 'portafolio']);
$router->get('/propiedad', [PaginasController::class, 'propiedad']);
$router->get('/blog', [PaginasController::class, 'blog']);
$router->get('/entrada', [PaginasController::class, 'entrada']);
$router->post('/', [PaginasController::class, 'index']);

//Login
$router->get('/login', [LoginController::class, 'login']);
// $router->get('/logout', [LoginController::class, 'logout']);
$router->post('/login', [LoginController::class, 'login']);

$router->comprobarRutas();