<?php
require_once 'conexion.php';

class Evento {
    public $id;
    public $nombre;
    public $descripcion;
    public $presupuesto;
    public $fecha_inicio;
    public $fecha_fin;

    public function __construct($nombre, $descripcion, $presupuesto, $fecha_inicio, $fecha_fin, $id = null) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->presupuesto = $presupuesto;
        $this->fecha_inicio = $fecha_inicio;
        $this->fecha_fin = $fecha_fin;
    }

    public function mostrar() {
        return "
            <strong>{$this->nombre}</strong><br>
            Descripción: {$this->descripcion}<br>
            Presupuesto: $ {$this->presupuesto}<br>
            Desde: {$this->fecha_inicio} hasta {$this->fecha_fin}
        ";
    }

    public static function obtenerTodos($conn) {
        $eventos = [];
        $sql = "SELECT * FROM PROYECTO";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            $eventos[] = new Evento(
                $row['nombre'],
                $row['descripcion'],
                $row['presupuesto'],
                $row['fecha_inicio'],
                $row['fecha_fin'],
                $row['id_proyecto']
            );
        }
        return $eventos;
    }

    public static function filtrar($conn, $criterio) {
        $eventos = [];
        $stmt = $conn->prepare("SELECT * FROM PROYECTO WHERE nombre LIKE ? OR descripcion LIKE ?");
        $like = "%$criterio%";
        $stmt->bind_param("ss", $like, $like);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $eventos[] = new Evento(
                $row['nombre'],
                $row['descripcion'],
                $row['presupuesto'],
                $row['fecha_inicio'],
                $row['fecha_fin'],
                $row['id_proyecto']
            );
        }
        return $eventos;
    }
}
?>
