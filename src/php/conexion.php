<?php
require_once __DIR__ . '/../../vendor/autoload.php'; // ajusta la ruta si es necesario

// Cargar el .env (usa safeLoad() para evitar errores si no existe)
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../..');
$dotenv->safeLoad();

// Leer variables de entorno desde $_ENV
$servername = $_ENV['DB_HOST'] ?? 'localhost';
$username   = $_ENV['DB_USER'] ?? '';
$password   = $_ENV['DB_PASS'] ?? '';
$database   = $_ENV['DB_NAME'] ?? '';

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
