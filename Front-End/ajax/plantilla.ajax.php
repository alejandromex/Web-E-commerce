<?php 
    require "../controladores/plantilla.controlador.php";
    require "../modelos/plantilla.modelo.php";

    class AjaxPlantilla{
        static public function ajaxEstiloPlantilla()
        {
            $controlador = new ControladorPlantilla();
            $respuesta = $controlador->ctrEstiloPlantilla();
            echo json_encode($respuesta);
        }
    }

    AjaxPlantilla::ajaxEstiloPlantilla();
    


?>