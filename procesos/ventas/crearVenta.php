<?php 
include_once '../../clases/Conexion.php';
include_once '../../clases/ventasProductosClass.php';

session_start();

$obj = new ventasProductos();


if (!isset($_SESSION['tablasVentasTemp'])||$_SESSION['tablasVentasTemp']==null||
	count($_SESSION['tablasVentasTemp'])==0) {
	# code...
	echo "error";
}else{
	echo $obj->registroProductosVenta();
	unset($_SESSION['tablasVentasTemp']);
}




 ?>