<?php
require_once 'eventos.php';
require_once 'control_sesiones.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['indice'])) {
    $index = $_POST['indice'];

    if (isset($_SESSION['carrito_donaciones'][$index])) {
        // Eliminar la donación y reindexar el array
        unset($_SESSION['carrito_donaciones'][$index]);
        $_SESSION['carrito_donaciones'] = array_values($_SESSION['carrito_donaciones']); // Reindexar
    }
}

// Volver al carrito
header('Location: donaciones.php');
exit();
?>
