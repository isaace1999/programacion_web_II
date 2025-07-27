<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Voluntarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h1>Registro de Voluntarios</h1>

    <form method="POST" action="registro_voluntario.php">
        <div class="mb-3">
            <label>Nombre completo</label>
            <input type="text" name="nombre_completo" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="correo_electronico" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Teléfono</label>
            <input type="text" name="telefono" class="form-control">
        </div>
        <div class="mb-3">
            <label>Dirección</label>
            <textarea name="direccion" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label>Contraseña</label>
            <input type="password" name="contrasena" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Disponibilidad</label>
            <select name="disponibilidad" class="form-select">
                <option value="Mañana">Mañana</option>
                <option value="Tarde">Tarde</option>
                <option value="Completa">Completa</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Rol</label>
            <input type="text" name="rol" class="form-control" placeholder="Ej: Coordinador, Asistente">
        </div>
        <div class="mb-3">
            <label>Campaña Asignada</label>
            <select name="id_proyecto" class="form-select">
                <?php
                require 'conexion.php';
                $res = $conn->query("SELECT id_proyecto, nombre FROM PROYECTO");
                while ($row = $res->fetch_assoc()) {
                    echo "<option value='{$row['id_proyecto']}'>{$row['nombre']}</option>";
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Registrarse</button>
    </form>
    <a href="../../index.php" class="btn btn-secondary mt-3">Volver al inicio</a>
</body>
</html>
