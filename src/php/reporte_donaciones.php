<?php
require_once 'conexion.php';
require_once 'control_sesiones.php';

// 1. Consulta simple: mostrar todas las donaciones registradas
$sql_donaciones = "
    SELECT d.id_donacion, d.monto, d.fecha, p.nombre AS proyecto, don.nombre AS donante
    FROM DONACION d
    JOIN PROYECTO p ON d.id_proyecto = p.id_proyecto
    JOIN DONANTE don ON d.id_donante = don.id_donante
    ORDER BY d.fecha DESC
";
$result_donaciones = $conn->query($sql_donaciones);

// 2. Consulta avanzada: proyectos con más de 2 donaciones y total recaudado
$sql_reporte = "
    SELECT 
        p.nombre AS proyecto,
        COUNT(d.id_donacion) AS cantidad_donaciones,
        SUM(d.monto) AS total_recaudado
    FROM DONACION d
    JOIN PROYECTO p ON d.id_proyecto = p.id_proyecto
    GROUP BY p.id_proyecto
    HAVING COUNT(d.id_donacion) > 2
    ORDER BY total_recaudado DESC
";
$result_reporte = $conn->query($sql_reporte);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Donaciones</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h1>📋 Reporte de Donaciones</h1>

    <h3 class="mt-4">1. Todas las donaciones registradas</h3>
    <?php if ($result_donaciones->num_rows > 0): ?>
        <table class="table table-bordered table-striped mt-3">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Donante</th>
                    <th>Proyecto</th>
                    <th>Monto</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result_donaciones->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id_donacion'] ?></td>
                        <td><?= htmlspecialchars($row['donante']) ?></td>
                        <td><?= htmlspecialchars($row['proyecto']) ?></td>
                        <td>$<?= number_format($row['monto'], 2) ?></td>
                        <td><?= $row['fecha'] ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-warning">No hay donaciones registradas.</div>
    <?php endif; ?>

    <h3 class="mt-5">2. Proyectos con más de 2 donaciones</h3>
    <?php if ($result_reporte->num_rows > 0): ?>
        <table class="table table-bordered table-hover mt-3">
            <thead class="table-success">
                <tr>
                    <th>Proyecto</th>
                    <th>Donaciones registradas</th>
                    <th>Total recaudado</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result_reporte->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['proyecto']) ?></td>
                        <td><?= $row['cantidad_donaciones'] ?></td>
                        <td>$<?= number_format($row['total_recaudado'], 2) ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-info">Ningún proyecto tiene más de 2 donaciones aún.</div>
    <?php endif; ?>

    <a href="../../index.php" class="btn btn-secondary mt-4">Volver al inicio</a>
</body>
</html>
