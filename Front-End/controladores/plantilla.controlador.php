<?php


class ControladorPlantilla{

    //Metodo de llamado de plantilla
    public function plantilla(){
        include "vistas/plantilla.php";
    }

    //Metodo para estilos dinamicos de la plantilla
    public function ctrEstiloPlantilla()
    {
        $tabla = "plantilla";
        $respuesta = ModeloPlantilla::mdlEstiloPlantilla($tabla);
        return $respuesta;
    }
}


?>