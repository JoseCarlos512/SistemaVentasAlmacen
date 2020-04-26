<?php 
	require_once "../../clases/Conexion.php";
	require_once "../../clases/categoriasClass.php";

	$id_categoria = $_POST['idcategoria'];
	$nombre_categoria = $_POST['categoriaU'];

	$datos = array($id_categoria,
		$nombre_categoria);

	$obj = new categorias();
	echo $obj->updateCategoria($datos);

?>