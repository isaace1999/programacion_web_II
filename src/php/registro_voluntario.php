<?php
require_once 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre_completo'];
    $correo = $_POST['correo_electronico'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_BCRYPT);
    $disponibilidad = $_POST['disponibilidad'];
    $rol = $_POST['rol'];
    $id_proyecto = $_POST['id_proyecto'];

    $stmt = $conn->prepare("INSERT INTO VOLUNTARIO 
        (nombre_completo, correo_electronico, telefono, direccion, contrasena, disponibilidad, rol, id_proyecto) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssi", $nombre, $correo, $telefono, $direccion, $contrasena, $disponibilidad, $rol, $id_proyecto);
    $stmt->execute();

    header("Location: login_voluntario.php?registrado=1");
    exit;
}
?>
