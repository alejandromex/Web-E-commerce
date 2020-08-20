<?php
require_once "conexion.php";

class ModeloPlantilla{
    static public function mdlEstiloPlantilla($tabla)
    {
        $conn = new Conexion();
        $stmt = $conn->conectar()->prepare("SELECT * FROM $tabla");
        $stmt->execute();
        return $stmt->fetch();
        $stmt->close();
    }
}

?>