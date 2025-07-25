<?php
require_once 'eventos.php';            // Contiene la clase Evento adaptada a PROYECTO
require_once 'control_sesiones.php';
require_once 'conexion.php';

$criterio = $_GET['buscar'] ?? '';
$resultados = $criterio ? Evento::filtrar($conn, $criterio) : Evento::obtenerTodos($conn);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Proyectos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

    <h1>Proyectos Registrados</h1>

    <form method="GET" class="input-group mb-4">
        <input type="text" name="buscar" class="form-control" placeholder="Buscar por nombre o descripción" value="<?php echo htmlspecialchars($criterio); ?>">
        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>

    <?php if (count($resultados) > 0): ?>
        <?php foreach ($resultados as $evento): ?>
            <div class="card mb-3">
                <div class="card-body">
                    <?= $evento->mostrar() ?>
                    <form method="POST" action="eliminar_evento.php" class="mt-3">
                        <input type="hidden" name="id" value="<?= $evento->id ?>">
                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="alert alert-warning">No se encontraron proyectos.</div>
    <?php endif; ?>

    <a href="../../index.php" class="btn btn-secondary mt-4">Volver al inicio</a>

</body>
</html>
