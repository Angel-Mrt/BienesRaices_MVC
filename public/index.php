<?php
require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\PropiedadController;
use Controllers\VendedorController;
use Controllers\PaginasController;
use Controllers\LoginController;
use Controllers\NosotrosController;
use Controllers\BlogController;

$router = new Router();

//Zona Privada
$router->get('/admin', [PropiedadController::class, 'index']);
$router->get('/propiedades/crear', [PropiedadController::class, 'crear']);
$router->post('/propiedades/crear', [PropiedadController::class, 'crear']);
$router->get('/propiedades/actualizar', [PropiedadController::class, 'actualizar']);
$router->post('/propiedades/actualizar', [PropiedadController::class, 'actualizar']);
$router->post('/propiedades/eliminar', [PropiedadController::class, 'eliminar']);

$router->get('/vendedores/crear', [VendedorController::class, 'crear']);
$router->post('/vendedores/crear', [VendedorController::class, 'crear']);
$router->get('/vendedores/actualizar', [VendedorController::class, 'actualizar']);
$router->post('/vendedores/actualizar', [VendedorController::class, 'actualizar']);
$router->post('/vendedores/eliminar', [VendedorController::class, 'eliminar']);

$router->get('/nosotros/actualizar', [NosotrosController::class, 'actualizar']);
$router->post('/nosotros/actualizar', [NosotrosController::class, 'actualizar']);

$router->get('/blog/admin', [BlogController::class,'index']);
$router->get('/blog/crear', [BlogController::class,'crear']);
$router->post('/blog/crear', [BlogController::class,'crear']);
$router->get('/blog/actualizar', [BlogController::class,'actualizar']);
$router->post('/blog/actualizar', [BlogController::class,'actualizar']);
$router->post('/blog/eliminar', [BlogController::class,'eliminar']);

//Zona Publica
$router->get('/', [PaginasController::class, 'index']);
$router->get('/nosotros', [PaginasController::class, 'nosotros']);
$router->get('/propiedades', [PaginasController::class, 'propiedades']);
$router->get('/propiedad', [PaginasController::class, 'propiedad']);
$router->get('/blog', [PaginasController::class, 'blog']);
$router->get('/entrada', [PaginasController::class, 'entrada']);
$router->get('/contacto', [PaginasController::class, 'contacto']);
$router->post('/contacto', [PaginasController::class, 'contacto']);

// Login y Autenticacion
$router->get('/login', [LoginController::class, 'login']);
$router->post('/login', [LoginController::class, 'login']);
$router->get('/logaut', [LoginController::class, 'logaut']);

$router->comprobarRutas();
