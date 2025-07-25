<?php
// CONFIGURACIONES ANTES de iniciar la sesión
ini_set('session.gc_maxlifetime', 3600);
session_set_cookie_params(3600);

// AHORA sí iniciar la sesión
session_start();

// Renovar cookie en cada carga
setcookie(session_name(), session_id(), time() + 3600, "/");

// Control de inactividad
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 3600)) {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
}

$_SESSION['last_activity'] = time();
?>
