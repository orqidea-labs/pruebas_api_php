<?php
require 'db.php';
$data = json_decode(file_get_contents("php://input"), true);
$email = $data['email'] ?? '';
$password = $data['password'] ?? '';

$db = get_db();
$stmt = $db->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
$stmt->execute([$email, $password]);
if (!$stmt->fetch()) {
    http_response_code(401);
    echo json_encode(['error' => 'Credenciales inválidas']);
    exit;
}

http_response_code(200);
echo json_encode(['message' => 'Login exitoso']);
