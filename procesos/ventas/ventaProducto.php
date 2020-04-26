<?php 

include_once "../../clases/Conexion.php";
include_once "../../clases/ventasProductosClass.php";

$obj = new ventasProductos();


$id_cliente = $_POST['id_cliente'];
$id_producto = $_POST['id_producto'];
$precio = $_POST['precio'];

$registrosVenta = array($cliente,
						$producto,
						$precio );

echo $obj->registroProductosVenta($registrosVenta);
 ?>