<?php
require_once 'control_sesiones.php';
require_once 'conexion.php';

// Capturar datos desde formulario
$nombre = $_POST['nombre']; // Equivale a "nombre del proyecto"
$descripcion = $_POST['descripcion'];   // Puedes ajustar según el formulario
$presupuesto = $_POST['presupuesto'];   // Valor fijo o capturado si lo agregas en el form
$fecha_inicio = $_POST['fecha_inicio'];
$fecha_fin = $_POST['fecha_fin'];

// Insertar en la tabla PROYECTO
$sql = "INSERT INTO PROYECTO (nombre, descripcion, presupuesto, fecha_inicio, fecha_fin) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssdss", $nombre, $descripcion, $presupuesto, $fecha_inicio, $fecha_fin);

if ($stmt->execute()) {
    header("Location: ver_eventos.php");
    exit();
} else {
    echo "Error al registrar proyecto: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
