<?php 
	require_once "../../clases/Conexion.php";
	require_once "../../clases/CategoriasClass.php";

	session_start();
	$id_usuario = $_SESSION['id_user'];
	$nombre = $_POST['categoria'];
	$fecha = date('Y-m-d');

	$datos = array(
		$id_usuario,
		$nombre,
		$fecha );
	$obj = new categorias();
	echo $obj->agregarCategoria($datos);
?>