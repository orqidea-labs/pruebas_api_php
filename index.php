<?php
$request = $_SERVER['REQUEST_URI'];
switch ($request) {
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
