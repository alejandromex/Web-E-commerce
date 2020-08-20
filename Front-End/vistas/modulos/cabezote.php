<!--TOP-->

<?php $servidor = Ruta::ctrRutaServidor(); $url = Ruta::ctrRuta(); ?>

<header id="header">
<div class="container-fluid barraSuperior" id="top">
    <div class="container">
        <div class="row">
            <!--Social-->
            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12 social">
                <ul>

                <?php 
                    
                    $social = ControladorPlantilla::ctrEstiloPlantilla();
                    $jsonRedesSociales = (json_decode($social['redesSociales'],true));
                    foreach($jsonRedesSociales as $key => $value) : ?>
                    
                    <li>
                        <a href="<?=$value['url']?>" target="_blank">
                            <i class="fa <?=$value['red']?> redSocial <?=$value['estilo']?>" aria-hidden="true"></i>
                        </a>
                    </li>
                    
                <?php endforeach ?>

                </ul>

            </div>

            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 registro">
                <ul>
                    <li><a href="#modalIngreso" data-toggle="modal">Ingresar</a></li>
                    <li>|</li>
                    <li><a href="#modalRegistro" data-toggle="modal" >Crear una cuenta</a></li>
                </ul>
            </div>

        </div>
    </div>
</div>


<div class="container-fluid">
    <div class="container">
        <div class="row" id="cabezote">
            <div class="col-lg-3 col-md-3 col-sm-2 col-xs-12" id="logotipo">
                <a href="<?=$url?>">
                    <img src="<?=$servidor?><?=$social['logo']?>" class="img-responsive" alt="">
                </a>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-8 col-xs-12">


                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 backColor" id="btnCategorias">
                    <p>CATEGORIAS <span class="pull-right"><i class="fa fa-bars" aria-hidden="true"></i></span></p>
                </div>

                <!-- BUSCADOR -->
                <div class="input-group col-lg-8 col-md-8 col-sm-8 col-xs-12" id="buscador">
                    <input type="search" name="buscar" class="form-control" placeholder="Buscar..." id="">
                    <span class="input-group-btn">
                        <a href="<?=$url?>buscador/1/recientes">
                            <button class="btn btn-default backColor" type="submit"><i class="fa fa-search"></i></button>
                        </a>
                    </span>
                
                </div>

            </div>

            <div class="col-lg-3 col-md-3 col-sm-2 col-xs-12" id="carrito">
                <a href="#">
                    <button class="btn btn-defaualt pull-left backColor">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                    </button>
                </a>
                <p>TU CESTA <span class="cantidadCesta"></span><br>USD $ <span class="sumaCesta"></span></p>
            </div>
    
        </div>

        <!--Categorias-->
        <div class="col-xs-12 backColor" id="categorias">
        <?php 
            $controlador =new ControladorProductos();
            $categorias = $controlador->ctrMostrarCategorias($item = null,$valor = null);
            foreach($categorias as $key => $value) : ?>

            <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
				
				<h4>
					<a href="<?=$url?><?=$value['ruta']?>" class="pixelCategorias"><?=$value['categoria']?></a>
				</h4>
				
				<hr>

				<ul>
                <?php $subcategorias = $controlador->ctrMostrarSubCategorias($value['id'],$item=null,$valor=null);
                    foreach($subcategorias as $key => $value) : ?>
                    
					<li><a href="<?=$url?><?=$value['ruta']?>" class="pixelSubCategorias"><?=$value['subcategoria']?></a></li>
                <?php endforeach ?>
				</ul>

			</div>	


            <?php endforeach?>
			
			

		</div>

	</div>

</header>
<!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#modalRegistro">Open Modal</button> -->

<!-- Ventana modal para el registro -->
<div class="modal fade modalFormulario" id="modalRegistro" role="dialog">
    <div class="modal-content modal-dialog">


        <div class="modal-body modalTitulo">
            <h3 class="backColor">Registrarse</h3>

                <button type="button" class="close" data-dismiss="modal">&times;</button>

                <!-- Registro de facebook -->
                    <div class="facebook col-sm-6 col-xs-12" id="btnFacebookRegistro">
                        <p>
                            <i class="fa fa-facebook"></i>
                            Registro con Facebook
                        </p>
                    </div>

                <!-- Registro de google -->
                <div class="google col-sm-6 col-xs-12" id="btnGoogleRegistro">
                    <p>
                        <i class="fa fa-google"></i>
                        Registro con Google
                    </p>
                </div>

                <!-- Registro con correo -->
                <form method="POST" action="formulario.php" onsubmit="return registroUsuario()">
                    <hr>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-user"></i>
                            </span>
                            <input required type="text" name="regUsuario" placeholder="Nombre Completo" class="form-control text-uppercase" id="regUsuario">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-envelope"></i>
                            </span>
                            <input required type="email" name="regEmail" placeholder="Correo Electronico" class="form-control " id="regEmail">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-lock"></i>
                            </span>
                            <input type="password" name="regPassword" placeholder="Contraseña" class="form-control" id="regPassword">
                        </div>
                    </div>

                    <div class="checkBox">
                        <input type="checkbox" name="" id="regPoliticas">
                        <small>
                            Al registrarse, usted acepta nuestras condiciones de uso y politicas de privacidad
                        </small>
                            <br>
                            <a href="https://www.iubenda.com/privacy-policy/65410784" class="iubenda-white iubenda-embed" title="Privacy Policy ">Leer mas</a><script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src="https://cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>

                    </div>
                    <?php
                        $registro = new ControladorUsuarios();
                        $registro->ctrRegistroUsuario();

                    ?>
                    
                    <input type="submit" value="Registrar" class="btn btn-default backColor btn-block">
                </form>
        </div>

        <div class="modal-footer">
            ¿Ya tienes una cuenta registrada? | <strong><a href="#modalIngreso" data-dismiss="modal" data-toggle="modal">Ingresar</a></strong>
        </div>
    </div>
    
</div>

