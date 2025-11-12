🧪 Laboratorio Simplificado – QA_API_Testing con PHP
🎯 Objetivo
Simular un entorno de pruebas para validar una API básica en PHP, con endpoints de registro, login y verificación de estado, usando Postman y Newman para pruebas automatizadas.

🧱 1. Backend en PHP – Estructura básica
📁 Estructura de archivos
Código
qa_php_api/
├── index.php              # Router principal
├── db.php                 # Conexión a base de datos
├── register.php           # Registro de usuario
├── login.php              # Login de usuario
├── health.php             # Verificación de estado
└── init.sql               # Script de inicialización de DB
🧠 2. Código fuente simplificado
🔹 index.php
php
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
🔹 db.php
php
<?php
function get_db() {
    return new PDO('pgsql:host=localhost;dbname=qa_db', 'qa_user', 'qa_pass');
}
🔹 register.php
php
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
🔹 login.php
php
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
🔹 health.php
php
<?php
http_response_code(200);
echo json_encode(['status' => 'ok']);
🧪 3. Pruebas en Postman
Los endpoints son los mismos:

Endpoint	Método	Descripción
/register	POST	Registro de usuario
/login	POST	Autenticación
/health	GET	Verificación de estado
Se pueden usar las mismas pruebas que en el ejemplo Flask, adaptando el baseUrl a http://localhost/qa_php_api.

⚙️ 4. Automatización con Newman
Exportar colección desde Postman.

Ejecutar con:

bash
newman run postman_collection.json \
  --reporters cli,html \
  --reporter-html-export reports/report.html
✅ 5. Conclusión
Este ejemplo en PHP permite:

Comprender la lógica de pruebas sin depender de frameworks complejos.

Validar respuestas HTTP y lógica de negocio básica.

Automatizar pruebas con herramientas estándar como Postman y Newman.