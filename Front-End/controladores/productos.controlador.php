<?php


class ControladorProductos{

    //Mostramos todas las categorias
    public function ctrMostrarCategorias($item, $valor)
    {
        $tabla = "categorias";
        $respuesta = ModeloProductos::mdlMostrarCategorias($tabla,$item,$valor);
        return $respuesta;
    }

    //Mostramos todas las subCategorias
    public function ctrMostrarSubCategorias($id,$item,$valor)
    {
        $tabla = "subcategorias";
        $respuesta = ModeloProductos::mdlMostrarSubCategorias($tabla,$id,$item,$valor);
        return $respuesta;
    }

    public function ctrMostrarProductos($ordenar,$item,$valor,$base,$tope,$modo)
    {
        $tabla = "productos";
        $respuesta = ModeloProductos::mdlMostrarProductos($tabla,$ordenar,$item,$valor,$base,$tope,$modo); 
        return $respuesta;
    }

    static public function ctrMostrarInfoProducto($item,$valor)
    {
        $tabla = "productos";
        $respuesta = ModeloProductos::mdlMostrarInfoProductos($tabla,$item,$valor);
        return $respuesta;
    }

    public function ctrListarProductos($ordenar,$item,$valor)
    {
        $tabla = "productos";
        $respuesta = ModeloProductos::mdlListarProductos($tabla,$ordenar,$item,$valor);
        return $respuesta;
    }

    public function ctrMostrarBanner($ruta2)
    {
        $tabla = "banner";
        $respuesta = ModeloProductos::mdlMostrarBanner($tabla,$ruta2);
        return $respuesta;
    }

    public function ctrBuscarProductos($busqueda,$base,$tope,$ordenar, $modo){
        $tabla = "productos";
        $respuesta = ModeloProductos::mdlMostrarProductosBusqueda($tabla,$busqueda,$base,$tope,$ordenar,$modo);
        return $respuesta;
    }

    public function ctrListarProductosBusqueda($busqueda)
    {
        $tabla = "productos";
        $respuesta = ModeloProductos::mdlListarProductosBusqueda($tabla,$busqueda);
        return $respuesta;
    }

    public function ActualizarVistaProducto($datos, $item){
        $tabla = "productos";
        $respuesta = ModeloProductos::mdlActualizarVistaProducto($tabla,$datos, $item);
        return $respuesta;
    }
}

