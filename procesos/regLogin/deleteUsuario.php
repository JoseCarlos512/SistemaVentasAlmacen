<?php 

require_once "../../clases/Conexion.php";
require_once "../../clases/Usuarios.php";

$obj = new usuarios();
$id_usuario = $_POST['id_usuario'];

echo $obj->deleteUsuario($id_usuario);

 ?>