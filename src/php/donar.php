<?php
require_once 'control_sesiones.php';
require_once 'conexion.php';
require_once 'eventos.php';

$mensaje = "";
$carrito = $_SESSION['carrito_donaciones'] ?? [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['procesar_pago'])) {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];

    // Registrar donante
    $stmtDonante = $conn->prepare("INSERT INTO DONANTE (nombre, email, direccion, telefono) VALUES (?, ?, ?, ?)");
    $stmtDonante->bind_param("ssss", $nombre, $email, $direccion, $telefono);
    $stmtDonante->execute();
    $id_donante = $stmtDonante->insert_id;
    $stmtDonante->close();

    // Obtener proyectos disponibles para relacionar con campañas
    $proyectos = Evento::obtenerTodos($conn);
    $mapa_proyectos = [];
    foreach ($proyectos as $p) {
        $mapa_proyectos[$p->nombre] = $p->id; // nombre => id_proyecto
    }

    // Registrar cada donación del carrito
    $fecha = date("Y-m-d");
    $stmtDonacion = $conn->prepare("INSERT INTO DONACION (monto, fecha, id_proyecto, id_donante) VALUES (?, ?, ?, ?)");
    foreach ($carrito as $donacion) {
        $monto = $donacion['monto'];
        $campaña = $donacion['campaña'];
        $id_proyecto = $mapa_proyectos[$campaña] ?? null;

        if ($id_proyecto) {
            $stmtDonacion->bind_param("dsii", $monto, $fecha, $id_proyecto, $id_donante);
            $stmtDonacion->execute();
        }
    }
    $stmtDonacion->close();

    // Limpiar carrito
    unset($_SESSION['carrito_donaciones']);
    unset($_SESSION['total_donacion']);

    $mensaje = "<div class='alert alert-success mt-4'>¡Gracias $nombre por tu donación! Se han procesado " . count($carrito) . " donaciones correctamente.</div>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Donar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

    <h1>Pago de Donación</h1>

    <?php if (!empty($mensaje)): ?>
        <?= $mensaje ?>
        <a href="../../index.php" class="btn btn-secondary mt-4">Volver al inicio</a>
    <?php elseif (!empty($carrito)): ?>
        <h4>Donaciones por procesar: <?= count($carrito) ?></h4>
        <ul class="list-group mb-3">
            <?php foreach ($carrito as $d): ?>
                <li class="list-group-item">
                    Campaña: <?= htmlspecialchars($d['campaña']) ?> - Monto: $<?= $d['monto'] ?>
                </li>
            <?php endforeach; ?>
        </ul>

        <form method="POST">
            <input type="hidden" name="procesar_pago" value="1">

            <h5>Información del Donante</h5>

            <div class="mb-3">
                <label class="form-label">Nombre completo</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Dirección</label>
                <input type="text" name="direccion" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Teléfono</label>
                <input type="text" name="telefono" class="form-control" required>
            </div>

            <h5>Datos de la Tarjeta (simulados)</h5>

            <div class="mb-3">
                <label class="form-label">Número de Tarjeta</label>
                <input type="text" name="numero_tarjeta" class="form-control" placeholder="XXXX XXXX XXXX XXXX" required pattern="\d{16}" maxlength="16">
            </div>

            <div class="mb-3">
                <label class="form-label">Fecha de Vencimiento</label>
                <input type="month" name="fecha_vencimiento" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">CVV</label>
                <input type="text" name="cvv" class="form-control" placeholder="123" required pattern="\d{3}" maxlength="3">
            </div>

            <button type="submit" class="btn btn-success">Confirmar Donación</button>
        </form>

        <a href="donaciones.php" class="btn btn-secondary mt-3">Volver al carrito</a>
    <?php else: ?>
        <div class="alert alert-warning">No hay donaciones en el carrito.</div>
        <a href="donaciones.php" class="btn btn-secondary mt-3">Volver al carrito</a>
    <?php endif; ?>

</body>
</html>
