<?php
require_once './control_sesiones.php';

// Verificar si el voluntario ha iniciado sesión
if (!isset($_SESSION['voluntario'])) {
    header("Location: login_voluntario.php?error=Debe iniciar sesión");
    exit();
}

$voluntario = $_SESSION['voluntario'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel del Voluntario</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <span class="navbar-brand">Panel de Voluntario</span>
            <div class="d-flex">
                <a href="logout_voluntario.php" class="btn btn-outline-light btn-sm">Cerrar sesión</a>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <h2 class="mb-4">¡Bienvenido, <?= htmlspecialchars($voluntario['nombre_completo']) ?>!</h2>

        <div class="card shadow-sm">
            <div class="card-header bg-white fw-bold">Información del voluntario</div>
            <div class="card-body">
                <p><strong>Correo electrónico:</strong> <?= htmlspecialchars($voluntario['correo_electronico']) ?></p>
                <p><strong>Teléfono:</strong> <?= htmlspecialchars($voluntario['telefono']) ?></p>
                <p><strong>Dirección:</strong> <?= htmlspecialchars($voluntario['direccion']) ?></p>
                <p><strong>Campaña asignada:</strong> <?= htmlspecialchars($voluntario['campaña_nombre'] ?? 'Sin asignar') ?></p>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="../../index.php" class="btn btn-outline-secondary">Volver al inicio</a>
        </div>
    </div>

</body>
</html>
