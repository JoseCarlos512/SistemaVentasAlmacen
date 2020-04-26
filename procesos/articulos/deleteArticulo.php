<?php 
include_once "../../clases/Conexion.php";
include_once "../../clases/articulosClass.php";

$obj = new articulo();

$idArticulo=$_POST['id_articulo'];

 echo $obj->deleteArticulo($idArticulo);
 ?>