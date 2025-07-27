<?php
require_once './control_sesiones.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organización sin fines de lucro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../../css/styles.css" media="screen" />
 
</head>
<body>
    <header>
        <h1>Organización sin fines de lucro</h1>
    </header>

    <div class="content">  
        <h1 class="mb-4">Area de selección</h1>  
        <div class="actions-container">
            <div class="action-card">
                <h3>Iniciar Sesión</h3>
                <img src="../../assets/imagenes/iniciar-sesion.png" alt="Login voluntarios">
                <a href="./login_voluntario.php">Iniciar Sesión</a>
            </div>

            <div class="action-card">
                <h3>Registrarse</h3>
                <img src="../../assets/imagenes/registro.png" alt="Registrarse">
                <a href="./registro_voluntario_form.php">Registrarse</a>
            </div>
        </div>
        <div class="text-center mt-4">
            <a href="../../index.php" class="btn btn-sm btn-outline-secondary">Volver al inicio</a>
        </div>
    </div>


     <footer>
        <p class="mb-1">© 2025 Isaac. Todos los derechos reservados.</p>
        <p><a href="mailto:isaac.lugo@estudiantes.iacc.cl">isaac.lugo@estudiantes.iacc.cl</a></p>
    </footer>
</body>
</html>