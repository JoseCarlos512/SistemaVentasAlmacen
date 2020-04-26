<?php 

require_once "../../clases/Conexion.php";
require_once "../../clases/Usuarios.php";

$obj = new usuarios();
$nombres = $_POST['nombreM'];
$apellidos = $_POST['apellidoM'];
$usuario = $_POST['usuarioM'];
$password =sha1( $_POST['passwordM']);
$id_usuario = $_POST['id_usuarioM'];

$datos = array( $nombres,
				 $apellidos,
				 $usuario,
				 $password,
				$id_usuario);

echo $obj->updateUsuarios($datos);

 ?>