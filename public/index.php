<?php

require __DIR__ . '/../vendor/autoload.php';
use App\Controladores\CuentaControlador;
use App\Controladores\LoginControlador;
use App\Controladores\RetiroControlador;
use App\Controladores\TransferenciaControlador;
use App\Nucleo\Router;

session_start();

$router = new Router();
$login = new LoginControlador();
$cuenta = new CuentaControlador();
$retiro = new RetiroControlador();
$transferencia = new TransferenciaControlador();

$router->get('/', [$login, 'mostrar']);
$router->post('/login', [$login, 'entrar']);
$router->get('/logout', [$login, 'salir']);
$router->get('/cuenta', [$cuenta, 'panel']);
$router->get('/retiro', [$retiro, 'formulario']);
$router->post('/retiro', [$retiro, 'guardar']);
$router->get('/retiros', [$retiro, 'historial']);
$router->get('/transferencia', [$transferencia, 'formulario']);
$router->post('/transferencia', [$transferencia, 'guardar']);
$router->get('/transferencias', [$transferencia, 'historial']);

$ruta = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?: '/';
$base = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');
if ($base !== '' && $base !== '/' && str_starts_with($ruta, $base)) {
    $ruta = substr($ruta, strlen($base)) ?: '/';
}

$router->ejecutar($_SERVER['REQUEST_METHOD'], $ruta);
