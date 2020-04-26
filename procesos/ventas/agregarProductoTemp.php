<?php 
session_start();
require_once "../../clases/Conexion.php";
$c = new conectar();
$conexion = $c->conexion();

$id_cliente = $_POST['id_cliente'];
$id_producto = $_POST['id_producto'];
$descripcion = $_POST['descripcion'];
$cantidad = $_POST['cantidad'];
$precio = $_POST['precio'];

$sql = "select 	nombre from articulos where id_producto ='$id_producto'";
$result = mysqli_query($conexion,$sql);
$nombre_producto = mysqli_fetch_row($result)[0];

$sql2 = "select nombre,apellido from clientes where id_cliente = '$id_cliente'";
$result2 = mysqli_query($conexion,$sql2);
$cli = mysqli_fetch_row($result2);

$nombre_cliente = $cli[1]." ".$cli[0];

$datosLineaArticulo = 	    $id_producto."||".$nombre_producto."||"
							.$descripcion."||".$precio."||".
							$nombre_cldiente."||".$id_cliente;

$_SESSION['tablasVentasTemp'][]= $datosLineaArticulo;

?>