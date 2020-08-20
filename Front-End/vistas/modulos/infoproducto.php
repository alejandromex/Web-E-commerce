<?php 
    $url = Ruta::ctrRuta();
    $servidor = Ruta::ctrRutaServidor();
    $productoControlador = new ControladorProductos();
    ?>


<!-- Breadcrumb infoproductos -->
<div class="container-fluid well well-sm">
    <div class="container">
        <div class="row">
        <ul class="breadcrumb fondoBreadcrumb text-uppercase">
            <li><a href="<?=$url?>">INICIO</a></li>
            <li class="active pagActiva"><?=$rutas[0]?></li>
        </ul>
        </div>
    </div>
</div>

<div class="container-fluid infoproducto">
    <div class="container">
        <div class="row">

        <?php 
            $item = "ruta";
            $valor = $rutas[0];
            $infoproducto = $productoControlador->ctrMostrarInfoProducto($item,$valor);
            $multimedia = json_decode($infoproducto['multimedia'],true);
            if($infoproducto['tipo'] == "fisico") : ?>
         
            <!-- Visto de producto de imagen-->
            <div class="col-md-5 col-sm-6 col-xs-12 visorImg">
                <figure class="visor">
                <?php if(!empty($multimedia)) : ?>
                    <?php foreach($multimedia as $key => $value) : ?>
                        <img id="lupa<?=$key+1?>" class="img-thumbnail" src="<?=$servidor?><?=$value['foto']?>" alt="tennis verde 11">
                    <?php endforeach ?>
                    </figure>

                    <div class="flexslider carousel">
                          <ul class="slides">
                        <?php foreach($multimedia as $key => $value) :?>
                            <li>
                                <img  value="<?=$key+1?>" class="img-thumbnail" src="<?=$servidor?><?=$value['foto']?>" alt="tennis verde 11">
                            </li>
                        <?php endforeach ?>
                          </ul>
                    </div>
                <?php endif ?>
            </div>

            <?php else: ?>

                <!-- Visor de video -->
                
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <iframe class="videoPresentacion" src="<?=$infoproducto['multimedia']?>" width="100%" frameborder="0" allowfullscreen></iframe>
                
                </div>

            <?php endif ?>

            <!-- Producto -->
            <?php if($infoproducto['tipo'] == "fisico") : ?>
                <div class="col-md-7 col-sm-6 col-xs-12 ">
            <?php else : ?>
                <div class="col-md-6 col-sm-6 col-xs-12 ">
            <?php endif ?>
                <div class="col-xs-6">
                    <h6>
                        <a href="javascript:history.back()" class="text-muted"><i class="fa fa-reply"></i>Continuar Comprando</a>
                    </h6>
                </div>
                <div class="col-xs-6">
                    <h6>
                        <a class="dropwdown-toggle pull-right text-muted" href="#" data-toggle="dropdown">
                            <i class="fa fa-plus">Compartir</i>
                        </a>

                        <ul class="dropdown-menu pull-right compartirRedes">
                            <li>
                                <p class="btnFacebook">
                                    <i class="fa fa-facebook"> Facebook</i>
                                </p>
                            </li>
                            <li>
                                <p class="btnGoogle">
                                    <i class="fa fa-google"> Google</i>
                                </p>
                            </li>
                        </ul>
                    </h6>
                </div>
                <div class="clearfix"></div>
                
                <!-- Espacio para el producto -->
                
                <!-- Titulo del preoducto -->
                <h1 class="text-muted text-uppercase"><?=$infoproducto['titulo']?>
                    <?php //var_dump($infoproducto); ?>
                    <?php if($infoproducto["Oferta"] == 0) : ?>
                        

                    <?php else : ?>
                        <br>
                        <small>
                            <span class="label label-warning"><?=$infoproducto['descuentoOferta']?>% off</span>

                        </small>

                    <?php endif ?>

                    <?php if($infoproducto["nuevo"] == 0) : ?>
                        

                    <?php else : ?>
                        <?php if($infoproducto['Oferta'] == 0) : ?>
                            <br>
                        <?php endif ?>
                        <small>
                            <span class="label label-warning">Nuevo</span>

                        </small>

                    <?php endif ?>
                
                </h1>

                 <!-- Precio del producto -->
                 <?php if($infoproducto['precio'] == 0) : ?>
                    <h2 class="text-muted">GRATIS</h2>

                    <?php else: ?>
                        <?php if($infoproducto['Oferta'] == 0): ?>
                            <h2 class="text-muted">$<?=$infoproducto['precio']?></h2>
                        <?php else : ?>
                            <h2 class="text-muted">
                                <span><strong class="oferta">USD $<?=$infoproducto['precio']?></strong></span>
                                <span>$<?=$infoproducto['precioOferta']?></span>
                            </h2>

                        <?php endif ?>

                 <?php endif ?> 

                 <!-- Descripcion -->

                 <p><?=$infoproducto['descripcion']?></p>
                 <!-- caracteristicas del producto -->
                 <hr>
                
				<div class="form-group row">
					
                    <?php
    
                        if($infoproducto["detalles"] != null){
    
                            $detalles = json_decode($infoproducto["detalles"], true);
    
                            if($infoproducto["tipo"] == "fisico"){
    
                                if($detalles["Talla"]!=null){
    
                                    echo '<div class="col-md-3 col-xs-12">
    
                                        <select class="form-control seleccionarDetalle" id="seleccionarTalla">
                                            
                                            <option value="">Talla</option>';
    
                                            for($i = 0; $i < count($detalles["Talla"]); $i++){
    
                                                echo '<option value="'.$detalles["Talla"][$i].'">'.$detalles["Talla"][$i].'</option>';
    
                                            }
    
                                        echo '</select>
    
                                    </div>';
    
                                }
    
                                if($detalles["Color"]!=null){
    
                                    echo '<div class="col-md-3 col-xs-12">
    
                                        <select class="form-control seleccionarDetalle" id="seleccionarColor">
                                            
                                            <option value="">Color</option>';
    
                                            for($i = 0; $i < count($detalles["Color"]); $i++){
    
                                                echo '<option value="'.$detalles["Color"][$i].'">'.$detalles["Color"][$i].'</option>';
    
                                            }
    
                                        echo '</select>
    
                                    </div>';
    
                                }
    
                                if($detalles["Marca"]!=null){
    
                                    echo '<div class="col-md-3 col-xs-12">
    
                                        <select class="form-control seleccionarDetalle" id="seleccionarMarca">
                                            
                                            <option value="">Marca</option>';
    
                                            for($i = 0; $i < count($detalles["Marca"]); $i++){
    
                                                echo '<option value="'.$detalles["Marca"][$i].'">'.$detalles["Marca"][$i].'</option>';
    
                                            }
    
                                        echo '</select>
    
                                    </div>';
    
                                }
    
                            }else{
    
                                echo '<div class="col-xs-12">
    
                                    <li>
                                        <i style="margin-right:10px" class="fa fa-play-circle"></i> '.$detalles["Clases"].'
                                    </li>
                                    <li>
                                        <i style="margin-right:10px" class="fa fa-clock-o"></i> '.$detalles["Tiempo"].'
                                    </li>
                                    <li>
                                        <i style="margin-right:10px" class="fa fa-check-circle"></i> '.$detalles["Nivel"].'
                                    </li>
                                    <li>
                                        <i style="margin-right:10px" class="fa fa-info-circle"></i> '.$detalles["Acceso"].'
                                    </li>
                                    <li>
                                        <i style="margin-right:10px" class="fa fa-desktop"></i> '.$detalles["Dispositivo"].'
                                    </li>
                                    <li>
                                        <i style="margin-right:10px" class="fa fa-trophy"></i> '.$detalles["Certificado"].'
                                    </li>
    
                                </div>';
    
                            }
    
                        }
    
                        /*=============================================
                        ENTREGA
                        =============================================*/
    
                        if($infoproducto["entrega"] == 0){
    
                            if($infoproducto["precio"] == 0){
    
                                echo '<h4 class="col-md-12 col-sm-0 col-xs-0">
    
                                    <hr>
    
                                    <span class="label label-default" style="font-weight:100">
    
                                        <i class="fa fa-clock-o" style="margin-right:5px"></i>
                                        Entrega inmediata | 
                                        <i class="fa fa-shopping-cart" style="margin:0px 5px"></i>
                                        '.$infoproducto["ventasGratis"].' inscritos |
                                        <i class="fa fa-eye" style="margin:0px 5px"></i>
                                        Visto por <span class="vistas" tipo="'.$infoproducto["precio"].'">'.$infoproducto["vistasGratis"].'</span> personas
    
                                    </span>
    
                                </h4>
    
                                <h4 class="col-lg-0 col-md-0 col-xs-12">
    
                                    <hr>
    
                                    <small>
    
                                        <i class="fa fa-clock-o" style="margin-right:5px"></i>
                                        Entrega inmediata <br>
                                        <i class="fa fa-shopping-cart" style="margin:0px 5px"></i>
                                        '.$infoproducto["ventasGratis"].' inscritos <br>
                                        <i class="fa fa-eye" style="margin:0px 5px"></i>
                                        Visto por <span class="vistas" tipo="'.$infoproducto["precio"].'">'.$infoproducto["vistasGratis"].'</span> personas
    
                                    </small>
    
                                </h4>';
    
                            }else{
    
                                echo '<h4 class="col-md-12 col-sm-0 col-xs-0">
    
                                    <hr>
    
                                    <span class="label label-default" style="font-weight:100">
    
                                        <i class="fa fa-clock-o" style="margin-right:5px"></i>
                                        Entrega inmediata |
                                        <i class="fa fa-shopping-cart" style="margin:0px 5px"></i>
                                        '.$infoproducto["ventas"].' ventas |
                                        <i class="fa fa-eye" style="margin:0px 5px"></i>
                                        Visto por <span class="vistas" tipo="'.$infoproducto["precio"].'">'.$infoproducto["vistas"].' </span> personas
    
                                    </span>
    
                                </h4>
    
                                <h4 class="col-lg-0 col-md-0 col-xs-12">
    
                                    <hr>
    
                                    <small>
    
                                        <i class="fa fa-clock-o" style="margin-right:5px"></i>
                                        Entrega inmediata <br> 
                                        <i class="fa fa-shopping-cart" style="margin:0px 5px"></i>
                                        '.$infoproducto["ventas"].' ventas <br>
                                        <i class="fa fa-eye" style="margin:0px 5px"></i>
                                        Visto por <span class="vistas" tipo="'.$infoproducto["precio"].'">'.$infoproducto["vistas"].'</span> personas
    
                                    </small>
    
                                </h4>';
    
                            }
    
                        }else{
    
                            if($infoproducto["precio"] == 0){
    
                                echo '<h4 class="col-md-12 col-sm-0 col-xs-0">
    
                                    <hr>
    
                                    <span class="label label-default" style="font-weight:100">
                                    
                                        <i class="fa fa-clock-o" style="margin-right:5px"></i>
                                        '.$infoproducto["entrega"].' días hábiles para la entrega  |
                                        <i class="fa fa-shopping-cart" style="margin:0px 5px"></i>
                                        '.$infoproducto["ventasGratis"].' solicitudes  |
                                        <i class="fa fa-eye" style="margin:0px 5px"></i>
                                        Visto por <span class="vistas" tipo="'.$infoproducto["precio"].'">'.$infoproducto["vistasGratis"].'</span> personas  
    
                                    </span>
    
                                </h4>
    
                                <h4 class="col-lg-0 col-md-0 col-xs-12">
    
                                    <hr>
    
                                    <small>
                                    
                                        <i class="fa fa-clock-o" style="margin-right:5px"></i>
                                        '.$infoproducto["entrega"].' días hábiles para la entrega  <br>
                                        <i class="fa fa-shopping-cart" style="margin:0px 5px"></i>
                                        '.$infoproducto["ventasGratis"].' solicitudes  <br>
                                        <i class="fa fa-eye" style="margin:0px 5px"></i>
                                        Visto por <span class="vistas" tipo="'.$infoproducto["precio"].'">'.$infoproducto["vistasGratis"].' </span> personas 
    
                                    </small>
    
                                </h4>';
    
                            }else{
    
                                echo '<h4 class="col-md-12 col-sm-0 col-xs-0">
    
                                    <hr>
    
                                    <span class="label label-default" style="font-weight:100">
    
                                        <i class="fa fa-clock-o" style="margin-right:5px"></i>
                                        '.$infoproducto["entrega"].' días hábiles para la entrega |
                                        <i class="fa fa-shopping-cart" style="margin:0px 5px"></i>
                                        '.$infoproducto["ventas"].' ventas |
                                        <i class="fa fa-eye" style="margin:0px 5px"></i>
                                        Visto por <span class="vistas" tipo="'.$infoproducto["precio"].'">'.$infoproducto["vistas"].' </span> personas
    
                                    </span>
    
                                </h4>
    
                                <h4 class="col-lg-0 col-md-0 col-xs-12">
    
                                    <hr>
    
                                    <small>
    
                                        <i class="fa fa-clock-o" style="margin-right:5px"></i>
                                        '.$infoproducto["entrega"].' días hábiles para la entrega <br>
                                        <i class="fa fa-shopping-cart" style="margin:0px 5px"></i>
                                        '.$infoproducto["ventas"].' ventas <br>
                                        <i class="fa fa-eye" style="margin:0px 5px"></i>
                                        Visto por <span class="vistas" tipo="'.$infoproducto["precio"].'">'.$infoproducto["vistas"].'</span> personas
    
                                    </small>
    
                                </h4>';
    
                            }
    
                        }				
    
                    ?>			

                 </div>

                 <div class="row botonesCompra">
                        <?php if($infoproducto['tipo'] == "virtual") : ?>
                            <?php if($infoproducto['precio'] == 0) : ?>
                                <div class="col-md-6 col-xs-12">
                                    <button class="btn btn-default btn-lg btn-block backColor"><small>Acceder Ahora</small></button>
                                </div>
                            <?php else : ?>
                                <div class="col-md-6 col-xs-12">
                                    <button class="btn btn-default btn-lg btn-block btn-warning"><small>Comprar Ahora</small></button>
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <button class="btn btn-default btn-lg btn-block backColor"><small>Agregar al carrito de compra</small> <i class="fa fa-shopping-cart col-md-0"></i></button>
                                </div>
                            <?php endif ?>

                        <?php else : ?>        
  
                        
                            <?php if($infoproducto['precio'] == 0) : ?>

                                <?php if($infoproducto['tipo'] == "virtual") : ?>
                                    <div class="col-md-6 col-xs-12">
                                        <button class="btn btn-default btn-lg btn-block backColor">Acceder Ahora</button>
                                    </div>
                                <?php else : ?>
                                    <div class="col-md-6 col-xs-12">
                                        <button class="btn btn-default btn-lg btn-block backColor">Solicitar Ahora</button>
                                    </div>
                                <?php endif ?>
                                
                            
                            <?php else: ?>
                                <div class="col-md-6 col-xs-12">
                                    <button class="btn btn-default btn-lg btn-block backColor">Agregar al carrito de compra <i class="fa fa-shopping-cart"></i></button>
                                </div>
                            <?php endif ?>
                        <?php endif ?>
                </div>

                <!-- Zona de la lupa -->
                <figure class="lupa">
                    <img src="#" alt="">

                </figure>

            </div>
            <!-- Comentarios -->

            

        </div>
        <div class="row">
                <ul class="nav nav-tabs">
                    <li class="active"><a>COMENTARIOS 4</a></li>
                    <li><a href="#">Ver mas</a></li>
                    <li class="pull-right"><a class="text-muted">Promedio de calificacion: 3.5 |
                     <i class="fa fa-star text-success"></i>
                     <i class="fa fa-star text-success"></i>
                     <i class="fa fa-star text-success"></i>
                     <i class="fa fa-star-half-o text-success"></i>
                     <i class="fa fa-star-o text-success"></i>
                     </a></li>
                </ul>
                <br>
            </div>

            <div class="row">
                <div class="panel-group col-md-3 col-sm-6 col-xs-12">
                    <div class="panel panel-default">
                        <div class="text-uppercase panel-heading">
                            Alejandro Ceballos 
                            <span class="text-right">
                                <img class="img-circle" src="<?=$url?>/vistas/img/usuarios/40/944.jpg" alt="" width="20%">
                            </span>
                        </div>
                        <div class="panel-body">
                            <small>
                                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Enim sapiente nostrum, consequuntur magni consectetur temporibus maiores atque earum laborum et doloremque eveniet, similique unde, eaque incidunt molestias ipsa sint cum?
                            </small>
                        </div>
                        <div class="panel-footer">
                            <i class="fa fa-star text-success"></i>
                            <i class="fa fa-star text-success"></i>
                            <i class="fa fa-star text-success"></i>
                            <i class="fa fa-star-half-o text-success"></i>
                            <i class="fa fa-star-o text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>

<?php

    $item = "id";
    $valor = $infoproducto["id_subcategoria"];
    $rutaArticulosDestacados = $productoControlador->ctrMostrarSubCategorias($id = null, $item, $valor);
    
    $ordenar = "";
    $item = "id_subcategoria";
    $valor = $infoproducto['id_subcategoria'];
    $base = 0;
    $tope = 4;
    $modo = "Rand()";
    $relacionado = $productoControlador->ctrMostrarProductos($ordenar,$item,$valor,$base,$tope,$modo);

    if(!empty($relacionado)) :
?>  


<!-- Articulos relacionados -->
<div class="container-fluid productos">
        <div class="container">
            <div class="row">
                <!-- Barra de titulo -->
                <div class="col-xs-12 tituloDestacado">
                    <!-- ------------------------------------------ -->
                    <div class="col-sm-6 col-xs-12">
                        <h1><small>Productos Relacionados</small></h1>
                    </div>

                    <div class="col-sm-6 col-xs-12">
                        <a href="<?=$url?><?=$rutaArticulosDestacados[0]["ruta"]?>">
                            <button class="btn btn-default backColor pull-right">
                                VER MAS <span><i class="fa fa-chevron-right"></i></span>
                            </button>
                        </a>
                    </div>

                </div><!-- ------------------------------------------ -->
            
            </div>
            <div class="clearfix">
                <hr>
            </div>
            <!-- Productos en cuadricula -->
        <ul class="grid0">
        <?php foreach($relacionado as $key => $value) : ?>
            <li class="col-md-3 col-sm-6 col-xs-12">

                <figure>
                    <a href="<?=$url?><?=$value['ruta']?>" class="pixelProducto">
                        <img src="<?=$servidor?><?=$value['portada']?>" class="img-responsive" alt=""></a>
                </figure>

                <h4>
                    <small>
                        <a href="<?=$url?><?=$value['ruta']?>" class="pixelProducto">
                            <?=$value['titulo']?></a> <br>
                            <?php if($value['nuevo'] != 0): ?>
                                        
                                <span class="label label-warning fontSize">Nuevo</span>

                            <?php endif ?>

                            <?php if($value['Oferta'] != 0): ?>
                                
                                <span class="label label-warning fontSize"><?=$value['descuentoOferta']?>% Off</span>

                            <?php endif ?>

                            <?php if($value['Oferta'] == 0 && $value['nuevo'] == 0) : ?>
                                <br>
                            <?php endif ?>
                        
                    </small>
                </h4>

                <div class="col-xs-6 precio">
                <?php if($value['precio'] == 0) : ?>

                    <h2><small>GRATIS</small></h2>

                <?php else :?>
                    <?php if($value['Oferta'] !=0 ):?>
                            <h2>
                                <small>
                                    <strong class="oferta">USD $<?=$value['precio']?></strong>
                                </small>
                                <small>$<?=$value['precioOferta']?></small>
                            </h2>
                    <?php else: ?>
                        <h2><small>$<?=$value['precio']?></small></h2>
                    <?php endif ?>

                <?php endif ?>
                </div>

                <div class="col-xs-6 enlaces">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-default btn-xs deseos" idProducto="<?=$value['id']?>" data-toggle="tooltip" 
                        title="Agregar a mi lista de deseos">
                            <i class="fa fa-heart" aria-hidden="true"></i>
                        </button>

                        <?php if($value['tipo']=='virtual') : ?>

                            <?php if($value['Oferta'] !=0 )
                            {
                                        
                                $precio = $value['precioOferta'];
                            }

                            else
                            {
                                $precio = $value['precio'];
                            }
                            ?>
                                    

                            <button class="btn btn-default btn-xs agregarCarrito" type="button" idProducto="<?=$value['id']?>"
                                imagen="<?=$servidor?><?=$value['portada']?>" titulo="<?=$value['titulo']?>"
                                 precio="<?=$precio?>" tipo="<?=$value['tipo']?>"
                                peso="<?=$value['peso']?>" data-toggle="tooltip" title="Agregar al carrito de compras">
                                    <i class="fa fa-shopping-cart" arian-hidden="true"></i>
                            </button>

                        <?php endif ?>

                        <a href="<?=$value['ruta']?>" class="pixelProducto">
                            <button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" title="Ver Producto">
                                <i class="fa fa-eye" arian-hidden="true"></i>
                            </button>
                        </a>
                    </div>
                </div>

            </li>
            <?php endforeach ?>
        </ul>
    </div>
</div>

<?php  endif ?>