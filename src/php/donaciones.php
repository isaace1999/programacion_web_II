<?php
require_once 'eventos.php';
require_once 'control_sesiones.php';
require_once 'conexion.php';

// Obtener todos los proyectos desde la base de datos
$eventos = Evento::obtenerTodos($conn);

$campañas_disponibles = [];
foreach ($eventos as $evento) {
    $campañas_disponibles[] = $evento->nombre; // Usamos el nombre del proyecto como nombre de campaña
}

// Inicializar carrito si no existe
if (!isset($_SESSION['carrito_donaciones'])) {
    $_SESSION['carrito_donaciones'] = [];
}

// Agregar al carrito
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['accion']) && $_POST['accion'] == 'agregar') {
    $campaña = $_POST['campaña'];
    $monto = floatval($_POST['monto']);

    if ($monto > 0 && in_array($campaña, $campañas_disponibles)) {
        $_SESSION['carrito_donaciones'][] = ['campaña' => $campaña, 'monto' => $monto];
    }
}

// Calcular total
$total_donaciones = array_sum(array_column($_SESSION['carrito_donaciones'], 'monto'));
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito de Donaciones</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

    <h1>Carrito de Donaciones</h1>

    <form method="POST" class="mb-4">
        <input type="hidden" name="accion" value="agregar">

        <div class="mb-3">
            <label class="form-label">Seleccionar Campaña</label>
            <select name="campaña" class="form-select" required>
                <option value="" disabled selected>Seleccione una campaña</option>
                <?php foreach ($campañas_disponibles as $campaña): ?>
                    <option value="<?= htmlspecialchars($campaña) ?>"><?= htmlspecialchars($campaña) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Monto de Donación</label>
            <input type="number" name="monto" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Agregar al Carrito</button>
    </form>

    <h3>Donaciones en el carrito:</h3>
    
    <?php if (!empty($_SESSION['carrito_donaciones'])): ?>
    <ul class="list-group mb-3">
        <?php foreach ($_SESSION['carrito_donaciones'] as $index => $donacion): ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Campaña: <?= htmlspecialchars($donacion['campaña']) ?> - Monto: $<?= $donacion['monto'] ?>

                <form method="POST" action="eliminar_donacion.php" class="ms-3">
                    <input type="hidden" name="indice" value="<?= $index ?>">
                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>

    <h4>Total acumulado: $<?= $total_donaciones ?></h4>

    <form method="POST" action="donar.php">
        <input type="hidden" name="total_donacion" value="<?= $total_donaciones ?>">
        <button type="submit" class="btn btn-success mt-3">Donar ahora</button>
    </form>

    <!-- ✅ Botón de acceso al reporte -->
    <a href="reporte_donaciones.php" class="btn btn-outline-info mt-3 ms-2">📊 Reporte de donación</a>

<?php else: ?>
    <div class="alert alert-info mt-3">El carrito está vacío.</div>
<?php endif; ?>

    <a href="../../index.php" class="btn btn-secondary mt-4">Volver al inicio</a>

</body>
</html>
