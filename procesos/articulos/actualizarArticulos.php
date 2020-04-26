<?php 
include_once "../../clases/Conexion.php";
include_once "../../clases/articulosClass.php";

$obj = new articulo();

$idArticulo = $_POST['id_articulo'];
$idCategoria=$_POST['id_categoriaM'];
$nombre=$_POST['nombreM'];
$descripcion=$_POST['descripcionM'];
$cantidad=$_POST['cantidadM'];
$precio=$_POST['precioM'];


$datos = array( 	$idArticulo,
					$idCategoria,
					$nombre,
					$descripcion,
					$cantidad,
					$precio );

echo $obj->updateArticulo($datos); 

/*
$nombreImg=$_FILES['imagenM']['name']; //el name imagen es el id de input
$rutaAlmacenamiento=$_FILES['imagenM']['tmp_name'];
$carpeta='../../archivos/';
$rutaFinal=$carpeta.$nombreImg;

$datosImg = array(	$idCategoria,
	$nombreImg,
	$rutaFinal	);


unlink("../../archivos/".$nombreImg);
if(move_uploaded_file($rutaAlmacenamiento, $rutaFinal)){
	$idImagen= $obj->updateImg($datosImg);
	if ($idImagen>0) {
			$datos = array( $idCategoria,
					$idImagen,
					$id_user,
					$nombre,
					$descripcion,
					$cantidad,
					$precio );
		echo $obj->agregarArticulo($datos);
	}else{
		echo 0;
	}
}
*/


?>