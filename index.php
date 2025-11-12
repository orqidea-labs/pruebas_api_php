<?php
header('Content-Type: application/json');

$request = $_SERVER['REQUEST_URI'];
$base = '/pruebas_api_php';
$route = str_replace($base, '', parse_url($request, PHP_URL_PATH));

switch ($route) {
    case '/register':
        require 'register.php';
        break;
    case '/login':
        require 'login.php';
        break;
    case '/health':
        require 'health.php';
        break;
    default:
        http_response_code(404);
        echo json_encode(['error' => 'Ruta no encontrada']);
}
