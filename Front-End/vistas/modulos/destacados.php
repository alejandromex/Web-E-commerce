<!-- Banner -->
<!-- Ruta Servidor -->
<?php 
$productoControlador = new ControladorProductos();

    $ruta = Ruta::ctrRutaServidor();

    $ruta2 = "sin-categoria";
    $banner = $productoControlador->ctrMostrarBanner($ruta2);
    $titulo1 = json_decode($banner['titulo1'],true);
    $titulo2 = json_decode($banner['titulo2'],true);
    $titulo3 = json_decode($banner['titulo3'],true);

?>

<?php if($banner != null) : ?>
<figure class="banner">
    <img src="<?=$ruta?><?=$banner['imagen']?>" alt="" class="img-responsive" width="100%"> 
    <div class="textoBanner <?=$banner['estilo']?>">
        <h1 style="color:<?=$titulo1['color']?>"> <?=$titulo1['texto']?> </h1>
        <h2 style="color:<?=$titulo2['color']?>"> <strong> <?=$titulo2['texto']?> </strong> </h2>
        <h3 style="color:<?=$titulo3['color']?>"> <?=$titulo3['texto']?> </h3>
    </div>
</figure>
<?php endif ?>

<?php

$titulosModulos = ["ARTICULOS GRATUITOS", "LO MAS VENDIDO", "LO MAS VISTO"];
$rutasModulos = ["articulos-gratis","lo-mas-vendido","lo-mas-visto"];
$modo = "DESC";
$base = 0;
$tope = 4;
if($titulosModulos[0]== "ARTICULOS GRATUITOS"){
    $ordenar = "id";
    $item = "precio";
    $valor = 0;
    $gratis = $productoControlador->ctrMostrarProductos($ordenar,$item,$valor ,$base,$tope,$modo);
}
if($titulosModulos[1]== "LO MAS VENDIDO"){
    $item = null;
    $valor = null;
    $ordenar = "ventas";
    $ventas = $productoControlador->ctrMostrarProductos($ordenar,$item,$valor ,$base,$tope,$modo);
}
if($titulosModulos[2]== "LO MAS VISTO"){
    $item = null;
    $valor = null;
    $ordenar = "vistas";
    $vistas = $productoControlador->ctrMostrarProductos($ordenar,$item,$valor ,$base,$tope,$modo);
}

$modulos = array($gratis,$ventas,$vistas);


for ($i=0; $i < count($titulosModulos); $i++) : ?> 
    
    <div class="container-fluid well well-sm barraProductos">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 organizarProductos">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-default btnGrid" id="btnGrid<?=$i?>">
                            <i class="fa fa-th" aria-hidden="true"></i>
                            <span class="col-xs-0 pull-right">GRID</span>
                        </button>
                        <button type="button" class="btn btn-default btnList" id="btnList<?=$i?>">
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
                <!-- Barra de titulo -->
                <div class="col-xs-12 tituloDestacado">
                    <!-- ------------------------------------------ -->
                    <div class="col-sm-6 col-xs-12">
                        <h1><small><?=$titulosModulos[$i]?></small></h1>
                    </div>

                    <div class="col-sm-6 col-xs-12">
                        <a href="<?=$rutasModulos[$i]?>">
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
            <ul class="grid<?=$i?>">
                <?php foreach($modulos[$i] as $key => $value) : ?>
                    <!-- producto 1 -->
                    <li class="col-md-3 col-sm-6 col-xs-12">

                        <figure>
                            <a href="<?=$value['ruta']?>" class="pixelProducto">
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

            <!-- Vista de productos en lista -->
            <ul class="list<?=$i?>"  style="display:none">
                <?php foreach($modulos[$i] as $key => $value) : ?>
                    <!-- Producto 1 -->
                    <li class="col-xs-12">
                        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
                            <figure>
                                <a href="<?=$value['ruta']?>" class="pixelProducto">
                                    <img src="<?=$ruta?><?=$value['portada']?>" class="img-responsive" alt=""></a>
                            </figure>
                        </div>
                        <div class="col-lg-10 col-md-7 col-sm-8 col-xs-12">
                            <h1>
                                <small>
                                <a href="<?=$value['ruta']?>" class="pixelProducto">
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

                                    <a href="<?=$value['ruta']?>" class="pixelProducto">
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
        </div>
    </div>


<?php endfor ?>

