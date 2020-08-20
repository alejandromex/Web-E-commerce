<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
    session_start();
    $controlador = new ControladorPlantilla();
    $icono = $controlador->ctrEstiloPlantilla();
    //Url para mantener la ruta fija del proyecto
    $ruta = Ruta::ctrRuta();
    $servidor = Ruta::ctrRutaServidor();
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="Tienda Virtual">
    <meta name="description" content="Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque, odio odit! Dolor, consequuntur totam.">
    <meta name="keywords" content="King-Commerce, tienda, herramientas">
    <link rel="icon" href="<?=$servidor?><?=$icono['icono']?>">
    <link rel="stylesheet" href="<?=$ruta?>vistas/css/plugins/bootstrap.min.css">
    <link rel="stylesheet" href="<?=$ruta?>vistas/css/plugins/font-awesome.min.css">
    <link rel="stylesheet" href="<?=$ruta?>vistas/css/plugins/flexslider.css">

    <!-- Hojas Personalidas de css -->
    <link rel="stylesheet" href="<?=$ruta?>vistas/css/plantilla.css">
    <link rel="stylesheet" href="<?=$ruta?>vistas/css/slide.css">
    <link rel="stylesheet" href="<?=$ruta?>vistas/css/productos.css">
    <link rel="stylesheet" href="<?=$ruta?>vistas/css/cabezote.css">
    <link rel="stylesheet" href="<?=$ruta?>vistas/css/infoproductos.css">
    <!-- ------------------------- -->

    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu|Ubuntu+Condensed" rel="stylesheet">
    <script src="<?=$ruta?>vistas/js/plugins/jquery.min.js"></script>
    <script src="<?=$ruta?>vistas/js/plugins/bootstrap.min.js"></script>

    <title>King Commerce</title>
</head>
<body>
    
<?php //Header
include "modulos/cabezote.php";

//CONTENIDO DINAMICO***********************************************************************************

//RUTAS PARA LAS CATEGORIAS (Amigables)
$rutas = array();
$ruta = null;
$infoProducto = null;
if(isset($_GET["ruta"]))
{
    $rutas = explode("/",$_GET['ruta']);
    

    $controladorProducto = new ControladorProductos();
    $item = "ruta";
    $valor = $rutas[0];
    $rutasCategorias = $controladorProducto->ctrMostrarCategorias($item,$valor);
    if($rutas[0] == $rutasCategorias["ruta"])
    {
        $ruta = $rutas[0];
    }

 
    $rutasSubCategorias = $controladorProducto->ctrMostrarSubCategorias($id=null,$item,$valor);
    foreach ($rutasSubCategorias as $key => $value) {
		if($rutas[0] == $value["ruta"]){
			$ruta = $rutas[0];
        }

	}


    //Urls amigables de productos
    $rutaProductos = ControladorProductos::ctrMostrarInfoProducto($item,$valor);
    if($rutas[0] == $rutaProductos["ruta"]){

		$infoProducto = $rutas[0];

	}
    if($ruta != null || $rutas[0] == "articulos-gratis" || $rutas[0] == "lo-mas-vendido" || $rutas[0] == "lo-mas-visto"){

		include "modulos/productos.php";

	}else if($infoProducto != null){

		include "modulos/infoproducto.php";

    }
    else if($rutas[0] == "buscador"){

		include "modulos/buscador.php";

	}
    else{

		include "modulos/error404.php";

	}

}else{

	include "modulos/slide.php";

	include "modulos/destacados.php";

}
?>

<input type="hidden" name="" value="<?=$url?>" id="rutaOculta">

<script src="<?=$url?>vistas/js/cabezote.js"></script>
<script src="<?=$url?>vistas/js/plantilla.js"></script>
<script src="<?=$url?>vistas/js/slide.js"></script>
<script src="<?=$url?>vistas/js/buscador.js"></script>
<script src="<?=$url?>vistas/js/infoproducto.js"></script>
<script src="<?=$url?>vistas/js/usuarios.js"></script>
<script src="<?=$url?>vistas/js/plugins/jquery.flexslider.js"></script>
<script src="<?=$url?>vistas/js/plugins/jquery.easing.js"></script>
<script src="<?=$url?>vistas/js/plugins/jquery.scrollUp.js"></script>

</body>
</html>