<?php
require_once './src/php/control_sesiones.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organización sin fines de lucro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./css/styles.css" media="screen" />
 
</head>
<body>
    <header>
        <h1>Organización sin fines de lucro</h1>
    </header>

    <div class="content">  
        <h1 class="mb-4">Bienvenido</h1>  
        <div class="actions-container">
            <div class="action-card">
                <h3>Donar</h3>
                <img src="./assets/imagenes/donar.png" alt="Donar">
                <a href="./src/php/donaciones.php">Ir a donar</a>
            </div>

            <div class="action-card">
                <h3>Registrar evento</h3>
                <img src="./assets/imagenes/formulario.png" alt="Registrar evento">
                <a href="./src/php/registrar_evento_form.php">Registrar</a>
            </div>

            <div class="action-card">
                <h3>Ver próximos eventos</h3>
                <img src="./assets/imagenes/eventos.png" alt="Ver eventos">
                <a href="./src/php/ver_eventos.php">Ver eventos</a>
            </div>
        </div>
    </div>

     <footer>
        <p class="mb-1">© 2025 Isaac. Todos los derechos reservados.</p>
        <p><a href="mailto:isaac.lugo@estudiantes.iacc.cl">isaac.lugo@estudiantes.iacc.cl</a></p>
    </footer>
</body>
</html>
