<?php
session_start();
require_once 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = trim($_POST['correo']);
    $contrasena = $_POST['contrasena'];

    // Validar campos
    if (empty($correo) || empty($contrasena)) {
        header('Location: login_voluntario.php?error=Por favor, complete todos los campos');
        exit();
    }

    // Consultar voluntario con proyecto
    $stmt = $conn->prepare(
        "SELECT v.*, p.nombre AS nombre_proyecto 
         FROM VOLUNTARIO v 
         LEFT JOIN PROYECTO p ON v.id_proyecto = p.id_proyecto 
         WHERE v.correo_electronico = ?"
    );
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $voluntario = $resultado->fetch_assoc();

        // Verificar contraseña
        if (password_verify($contrasena, $voluntario['contrasena'])) {
            $_SESSION['voluntario'] = $voluntario;
            header('Location: panel_voluntario.php');
            exit();
        } else {
            header('Location: login_voluntario.php?error=Contraseña incorrecta');
            exit();
        }
    } else {
        header('Location: login_voluntario.php?error=Correo no registrado');
        exit();
    }
}

header('Location: login_voluntario.php');
exit();
