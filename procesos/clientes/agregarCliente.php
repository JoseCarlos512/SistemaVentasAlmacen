<?php 
require_once "../../clases/clientesClass.php";
require_once "../../clases/Conexion.php";
session_start();
$idUsuarioActual = $_SESSION['id_user'];

$datos = array(
	$idUsuarioActual,
	$_POST['nombre'],
	$_POST['apellido'],
	$_POST['direccion'],
	$_POST['email'],
	$_POST['telefono'],
	$_POST['rfc']
 );
	
$obj = new clientes();
echo $obj->agregarCliente($datos);


?>