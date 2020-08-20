<?php


class ControladorUsuarios{
    public function ctrRegistroUsuario()
    {
        if(isset($_POST["regUsuario"]))
        {
            if(preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["regUsuario"]) &&
			   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["regEmail"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["regPassword"])){
            {

            }
            else{
                echo '<script> alert("Error")</script>';
        }
    }
}