<?php 
    $ruta = Ruta::ctrRutaServidor();
    $url = Ruta::ctrRuta();
    $servidor = $ruta;
    $productoControlador = new ControladorProductos();

?>

<div class="container-fluid well well-sm barraProductos">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-xs-12">
                <div class="btn-group">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        Ordenar Productos <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="<?=$url?><?=$rutas[0]?>/1/reciente/<?=$rutas[3]?>">Mas reciente</a></li>
                        <li><a href="<?=$url?><?=$rutas[0]?>/1/antiguo/<?=$rutas[3]?>">Lo mas antiguo</a></li>
                    </ul>
                </div>

            </div>
            <div class="col-sm-6 col-xs-12 organizarProductos">
                <div class="btn-group pull-right">
                    <button type="button" class="btn btn-default btnGrid" id="btnGrid0">
                        <i class="fa fa-th" aria-hidden="true"></i>
                        <span class="col-xs-0 pull-right">GRID</span>
                    </button>
                    <button type="button" class="btn btn-default btnList" id="btnList0">
                        <i class="fa fa-list" aria-hidden="true"></i>
                        <span class="col-xs-0 pull-right">LIST</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container-fluid productos">
    <div class="container">
        <div class="row">
            <ul class="breadcrumb fondoBreadcrumb text-uppercase">
                <li><a href="<?=$url?>">INICIO</a></li>
                <li class="active pagActiva"><?=$rutas[0]?></li>
            </ul>

<?php
    // Llamado de paginacion
    if(isset($rutas[1]))
    {
        $base = (intval($rutas[1]) - 1)*12;
        $tope = 12;

    }else {
        $rutas[1] = 1;
        $base = 0;
        $tope = 12;
    }

    if(!isset($_SESSION['ordenar']))
    {
        $_SESSION['ordenar'] = "DESC";
    }
    if(isset($rutas[2]))
    {

        if($rutas[2]=="reciente")
        {
            $_SESSION['ordenar'] = "DESC";
        }
        if($rutas[2]=="antiguo")
        {
            $_SESSION['ordenar'] = "ASC";
        }
    }

    $modo = $_SESSION['ordenar'];
    $productos = null;
    $listaProductos = null;
    $ordenar = "id";
   
    //Llamado de productos por busqueda
    if(isset($rutas[3]))
    {
        $busqueda = $rutas[3];
        $productos = $controladorProducto->ctrBuscarProductos($busqueda,$base,$tope,$ordenar, $modo);
        $listaProductos = $controladorProducto->ctrListarProductosBusqueda($busqueda);
    }

    

    
    if(empty($productos)) : ?>

        <div class="col-xs-12 error404 text-center">
            <h1><small>Oops!</small></h1>
            <h2>Aun no hay productos en esta seccion</h2>
        </div>
    <?php else: ?>
        
        <ul class="grid0">
        <?php foreach($productos as $key => $value) : ?>
                    <!-- producto 1 -->
                    <li class="col-md-3 col-sm-6 col-xs-12">

                        <figure>
                            <a href="<?=$url?><?=$value['ruta']?>" class="pixelProducto">
                                <img src="<?=$ruta?><?=$value['portada']?>" class="img-responsive" alt=""></a>
                        </figure>

                        <h4>
                            <small>
                                <a href="<?=$value['ruta']?>" class="pixelProducto">
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
                                    else{
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

                                <a href="<?=$url?><?=$value['ruta']?>" class="pixelProducto">
                                    <button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" title="Ver Producto">
                                        <i class="fa fa-eye" arian-hidden="true"></i>
                                    </button>
                                </a>
                            </div>
                        </div>

                    </li>


                <?php endforeach ?>
        </ul>

        <ul class="list0"  style="display:none">
                <?php foreach($productos as $key => $value) : ?>
                    <!-- Producto 1 -->
                    <li class="col-xs-12">
                        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
                            <figure>
                            
                                <a href="<?=$url?><?=$value['ruta']?>" class="pixelProducto">
                                    <img src="<?=$ruta?><?=$value['portada']?>" class="img-responsive" alt=""></a>
                            </figure>
                        </div>
                        <div class="col-lg-10 col-md-7 col-sm-8 col-xs-12">
                            <h1>
                                <small>
                                <a href="<?=$url?><?=$value['ruta']?>" class="pixelProducto">
                                        <?=$value['titulo']?></a> <br>

                                        <?php if($value['nuevo'] != 0): ?>
                                            
                                            <span class="label label-warning fontSize">Nuevo</span>

                                        <?php endif ?>

                                        <?php if($value['Oferta'] != 0): ?>
                                            
                                            <span class="label label-warning fontSize"><?=$value['descuentoOferta']?>% Off</span>

                                        <?php endif ?>
                                </small>  
                            </h1>
        
                                <p class="text-muted"> 
                                            <?=$value['titular']?>
                                </p>
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
                                <div class="btn-group pull-left enlaces">
                                    <button type="button" class="btn btn-default btn-xs deseos" idProducto="470" data-toggle="tooltip"
                                    title="Agregar a mi lista de deseos">
                                        <i class="fa fa-heart" aria-hidden="true"></i>
                                    </button>

                                    <?php if($value['tipo']=='virtual' && $value['precio'] != 0) : ?>

                                        <?php if($value['Oferta'] !=0 )
                                        {
                                            
                                            $precio = $value['precioOferta'];
                                        }
                                        else{
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

                                    <a href="<?=$url?><?=$value['ruta']?>" class="pixelProducto">
                                        <button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" title="Ver Producto">
                                            <i class="fa fa-eye" aria-aria-hidden="true"></i>
                                        </button>
                                    </a>
                                </div>
                        </div>

                        <div class="col-xs-12">
                            <hr>
                        </div>

                    </li>

                <?php endforeach ?>
            </ul>

    <?php endif
?>
<div class="clearfix"></div>

<center>

			<!--=====================================
			PAGINACIÓN
			======================================-->
			
			<?php

				if(count($listaProductos) != 0){

					$pagProductos = ceil(count($listaProductos)/12);

					if($pagProductos > 4){

						/*=============================================
						LOS BOTONES DE LAS PRIMERAS 4 PÁGINAS Y LA ÚLTIMA PÁG
						=============================================*/

						if($rutas[1] == 1){

							echo '<ul class="pagination">';
							
							for($i = 1; $i <= 4; $i ++){

								echo '<li id="item'.$i.'"><a href="'.$url.$rutas[0].'/'.$i.'/'.$rutas[2].'/'.$rutas[3].'">'.$i.'</a></li>';

							}

							echo ' <li class="disabled"><a>...</a></li>
								   <li id="item'.$pagProductos.'"><a href="'.$url.$rutas[0].'/'.$pagProductos.'/'.$rutas[2].'/'.$rutas[3].'">'.$pagProductos.'</a></li>
								   <li><a href="'.$url.$rutas[0].'/2/'.$rutas[2].'/'.$rutas[3].'"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>

							</ul>';

						}

						/*=============================================
						LOS BOTONES DE LA MITAD DE PÁGINAS HACIA ABAJO
						=============================================*/

						else if($rutas[1] != $pagProductos && 
							    $rutas[1] != 1 &&
							    $rutas[1] <  ($pagProductos/2) &&
							    $rutas[1] < ($pagProductos-3)
							    ){

								$numPagActual = $rutas[1];

								echo '<ul class="pagination">
									  <li><a href="'.$url.$rutas[0].'/'.($numPagActual-1).'/'.$rutas[2].'/'.$rutas[3].'"><i class="fa fa-angle-left" aria-hidden="true"></i></a></li> ';
							
								for($i = $numPagActual; $i <= ($numPagActual+3); $i ++){

									echo '<li id="item'.$i.'"><a href="'.$url.$rutas[0].'/'.$i.'/'.$rutas[2].'/'.$rutas[3].'">'.$i.'</a></li>';

								}

								echo ' <li class="disabled"><a>...</a></li>
									   <li id="item'.$pagProductos.'"><a href="'.$url.$rutas[0].'/'.$pagProductos.'/'.$rutas[2].'/'.$rutas[3].'">'.$pagProductos.'</a></li>
									   <li><a href="'.$url.$rutas[0].'/'.($numPagActual+1).'/'.$rutas[2].'/'.$rutas[3].'"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>

								</ul>';

						}

						/*=============================================
						LOS BOTONES DE LA MITAD DE PÁGINAS HACIA ARRIBA
						=============================================*/

						else if($rutas[1] != $pagProductos && 
							    $rutas[1] != 1 &&
							    $rutas[1] >=  ($pagProductos/2) &&
							    $rutas[1] < ($pagProductos-3)
							    ){

								$numPagActual = $rutas[1];
							
								echo '<ul class="pagination">
								   <li><a href="'.$url.$rutas[0].'/'.($numPagActual-1).'/'.$rutas[2].'/'.$rutas[3].'"><i class="fa fa-angle-left" aria-hidden="true"></i></a></li> 
								   <li id="item1"><a href="'.$url.$rutas[0].'/1/'.$rutas[2].'/'.$rutas[3].'">1</a></li>
								   <li class="disabled"><a>...</a></li>
								';
							
								for($i = $numPagActual; $i <= ($numPagActual+3); $i ++){

									echo '<li id="item'.$i.'"><a href="'.$url.$rutas[0].'/'.$i.'/'.$rutas[2].'/'.$rutas[3].'">'.$i.'</a></li>';

								}


								echo '  <li><a href="'.$url.$rutas[0].'/'.($numPagActual+1).'/'.$rutas[2].'/'.$rutas[3].'"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
									</ul>';
						}

						/*=============================================
						LOS BOTONES DE LAS ÚLTIMAS 4 PÁGINAS Y LA PRIMERA PÁG
						=============================================*/

						else{

							$numPagActual = $rutas[1];

							echo '<ul class="pagination">
								   <li><a href="'.$url.$rutas[0].'/'.($numPagActual-1).'/'.$rutas[2].'/'.$rutas[3].'"><i class="fa fa-angle-left" aria-hidden="true"></i></a></li> 
								   <li id="item1"><a href="'.$url.$rutas[0].'/1/'.$rutas[2].'/'.$rutas[3].'">1</a></li>
								   <li class="disabled"><a>...</a></li>
								';
							
							for($i = ($pagProductos-3); $i <= $pagProductos; $i ++){

								echo '<li id="item'.$i.'"><a href="'.$url.$rutas[0].'/'.$i.'/'.$rutas[2].'/'.$rutas[3].'">'.$i.'</a></li>';

							}

							echo ' </ul>';

						}

					}else{

						echo '<ul class="pagination">';
						
						for($i = 1; $i <= $pagProductos; $i ++){

							echo '<li id="item'.$i.'"><a href="'.$url.$rutas[0].'/'.$i.'/'.$rutas[2].'/'.$rutas[3].'">'.$i.'</a></li>';

						}

						echo '</ul>';

					}

				}

			?>

			</center>

        </div>
    </div>
</div>