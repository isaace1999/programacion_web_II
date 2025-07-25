<?php
require_once 'control_sesiones.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Proyecto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

    <h1>Registrar Proyecto</h1>

    <form action="registrar_evento.php" method="POST" class="mb-4">
        <div class="mb-3">
            <label class="form-label">Nombre del Proyecto</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea name="descripcion" class="form-control" required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Presupuesto (USD)</label>
            <input type="number" step="0.01" name="presupuesto" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Fecha de inicio</label>
            <input type="date" name="fecha_inicio" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Fecha de fin</label>
            <input type="date" name="fecha_fin" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Registrar Proyecto</button>
    </form>

    <a href="../../index.php" class="btn btn-secondary">Volver al inicio</a>

</body>
</html>
