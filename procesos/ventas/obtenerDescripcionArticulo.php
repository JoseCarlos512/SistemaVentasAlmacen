<?php 
include_once "../../clases/Conexion.php";
include_once "../../clases/ventasProductosClass.php";

$id_producto = $_POST["id_producto"];
$obj = new ventasProductos();
$retorno = $obj->obtenerDescripcionXProducto($id_producto);
echo json_encode($retorno);
 ?>