<?php 

require_once "../../clases/Conexion.php";
require_once "../../clases/clientesClass.php";
session_start();
$idUsuarioActual = $_SESSION['id_user'];

$Datos = array(
			$idUsuarioActual,
			$_POST['nombreM'],
			$_POST['apellidoM'],
			$_POST['direccionM'],
			$_POST['emailM'],
			$_POST['telefonoM'],
			$_POST['rfcM'],
			$_POST['clienteM']
			 );

$obj = new clientes();
echo $obj->updateCliente($Datos);


 ?>