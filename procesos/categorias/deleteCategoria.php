<?php 
require_once "../../clases/Conexion.php";
require_once "../../clases/categoriasClass.php";

$id_categoria = $_POST['id_categoria'];//parametro recibido de la funcion

$obj = new categorias();
echo $obj->deleteCategoria($id_categoria);



 ?>