<?php

require_once "conexion.php";

class ModeloSlide{
    static public function mdlMostrarSlide($tabla)
    {
        $conn = new Conexion();
        $stmt = $conn->conectar()->prepare("SELECT * from $tabla");
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt->close();
        $stmt = null;
    }
}