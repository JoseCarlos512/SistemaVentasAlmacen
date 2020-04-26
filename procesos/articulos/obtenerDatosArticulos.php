<?php 

include_once "../../clases/Conexion.php";
include_once "../../clases/articulosClass.php";

$id_articulo = $_POST['id_art'];

$obj = new articulo();
echo json_encode($obj->obtenerArticulo($id_articulo));




 ?>