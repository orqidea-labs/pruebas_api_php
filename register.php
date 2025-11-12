<?php
require 'db.php';
$data = json_decode(file_get_contents("php://input"), true);
$email = $data['email'] ?? '';
$password = $data['password'] ?? '';

if (!$email || !$password) {
    http_response_code(400);
    echo json_encode(['error' => 'Campos requeridos']);
    exit;
}

$db = get_db();
$stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute([$email]);
if ($stmt->fetch()) {
    http_response_code(400);
    echo json_encode(['error' => 'Usuario ya registrado']);
    exit;
}

$stmt = $db->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
$stmt->execute([$email, $password]);
http_response_code(201);
echo json_encode(['message' => 'Usuario registrado correctamente']);
