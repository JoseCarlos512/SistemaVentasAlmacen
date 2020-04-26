<?php 
include_once "../../clases/Conexion.php";
include_once "../../clases/articulosClass.php";

session_start();
$id_user = $_SESSION['id_user'];
$obj = new articulo();

$idCategoria=$_POST['id_categoria'];
$nombre=$_POST['nombre'];
$descripcion=$_POST['descripcion'];
$cantidad=$_POST['cantidad'];
$precio=$_POST['precio'];


$nombreImg=$_FILES['imagen']['name']; //el name imagen es el id de input
$rutaAlmacenamiento=$_FILES['imagen']['tmp_name'];
$carpeta='../../archivos/';
$rutaFinal=$carpeta.$nombreImg;

$datosImg = array(	$idCategoria,
	$nombreImg,
	$rutaFinal	);

if(move_uploaded_file($rutaAlmacenamiento, $rutaFinal)){
	$idImagen= $obj->agregarImg($datosImg);
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

?>