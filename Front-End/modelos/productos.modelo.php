<?php


require_once "conexion.php";

class ModeloProductos{
    static public function mdlMostrarCategorias($tabla, $item, $valor)
    {
        $conn = new Conexion();
   
        if($item !=null)
        {
            $stmt = $conn->conectar()->prepare("SELECT * FROM $tabla WHERE $item = '$valor'");
            $stmt->execute();
            return $stmt->fetch();
        }
        else{
            $stmt = $conn->conectar()->prepare("SELECT * FROM $tabla");
            $stmt->execute();
            return $stmt->fetchAll();
        }
        
        $stmt->close();
        $stmt = null;
  
    }

    static public function mdlMostrarSubCategorias($tabla,$id,$item,$valor)
    {
        $conn = new Conexion();
        if($item !=null)
        {
            $stmt = $conn->conectar()->prepare("SELECT * FROM $tabla WHERE $item = '$valor'");
        }
        else{
            $stmt = $conn->conectar()->prepare("SELECT * FROM $tabla where id_categoria = $id");
        }
        // $stmt-> bindParam(":id_categoria",$id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt->close();
        $stmt = null;
    }

    static public function mdlMostrarProductos($tabla, $ordenar,$item,$valor,$base,$tope,$modo)
    {
        $conn = new Conexion();

        if($item !=null)
        {
            $stmt = $conn->conectar()->prepare("SELECT * FROM $tabla where $item = '$valor' ORDER BY $ordenar $modo limit $base, $tope");
            $stmt->execute();
            return $stmt->fetchAll();
        }
        else{
            $stmt = $conn->conectar()->prepare("SELECT * FROM $tabla ORDER BY $ordenar $modo limit $base, $tope");
            $stmt->execute();
            return $stmt->fetchAll();
        }

 
        $stmt->close();
        $stmt = null;
    }

    static public function mdlMostrarInfoProductos($tabla,$item,$valor)
    {
        $conn = new Conexion();
        if($item !=null)
        {
            $stmt = $conn->conectar()->prepare("SELECT * FROM $tabla WHERE $item = '$valor'");
        }
        else{
            $stmt = $conn->conectar()->prepare("SELECT * FROM $tabla where id_categoria = $id");
        }
        // $stmt-> bindParam(":id_categoria",$id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
        $stmt->close();
        $stmt = null;
    }

    static public function mdlListarProductos($tabla,$ordenar, $item,$valor){
        $conn = new Conexion();
        if($item !=null)
        {
            $stmt = $conn->conectar()->prepare("SELECT * FROM $tabla WHERE $item = '$valor' order by $ordenar DESC");
            $stmt->execute();
            return $stmt->fetchAll();
        }
        else{
            $stmt = $conn->conectar()->prepare("SELECT * FROM $tabla order by $ordenar desc");
            $stmt->execute();
            return $stmt->fetchAll();
        }
        $stmt->close();
        $stmt = null;
    }

    static public function mdlMostrarBanner($tabla,$ruta2)
    {
        $conn = new Conexion();
        $stmt = $conn->conectar()->prepare("SELECT * from $tabla where ruta = '$ruta2'");
        $stmt->execute();
        return $stmt->fetch();
        $stmt->close();
        $stmt = null;

    }

    static public function mdlMostrarProductosBusqueda($tabla,$busqueda,$base,$tope,$ordenar,$modo){
        $conn = new Conexion();
        $stmt = $conn->conectar()->prepare("SELECT * from $tabla where ruta like '%$busqueda%'
         OR titulo like '%$busqueda%'
         OR titular like '%$busqueda%'
         OR descripcion like '%$busqueda%'  order by $ordenar $modo limit $base, $tope ");
         $stmt->execute();
         return $stmt->fetchAll();
         $stmt->close();
         $stmt = null;
    }

    static public function mdlListarProductosBusqueda($tabla,$busqueda){
        $conn = new Conexion();
        $stmt = $conn->conectar()->prepare("SELECT * from $tabla where ruta like '%$busqueda%'
         OR titulo like '%$busqueda%'
         OR titular like '%$busqueda%'
         OR descripcion like '%$busqueda%'");
         $stmt->execute();
         return $stmt->fetchAll();
         $stmt->close();
         $stmt = null;
    }

    static public function mdlActualizarVistaProducto($tabla,$datos, $item){
        $conn = new Conexion();
        $stmt = $conn->conectar()->prepare("UPDATE $tabla SET $item = :$item WHERE ruta = :ruta");
		$stmt -> bindParam(":ruta", $datos["ruta"], PDO::PARAM_STR);
		$stmt -> bindParam(":".$item, $datos["valor"], PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;
    }
}