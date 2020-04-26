<?php 
session_start();
	require_once "../../clases/Conexion.php"; //se necesita
	require_once "../../clases/Usuarios.php";

	$obj = new usuarios();

	$datos=array(
		$_POST["usuario"],
		$_POST["password"]
	);

	echo $obj->loginUser($datos);

 ?>