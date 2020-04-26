<?php 
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Usuarios.php";

	$obj = new usuarios();
	$pass = sha1($_POST['password']);

	$datos=array(
		$_POST['nombre'],
		$_POST['apellido'],
		$_POST['usuario'],
		$pass
	);

	echo $obj->registrarUsuario($datos); //imprimimos lo que traemos para usar para la validacion

 ?>