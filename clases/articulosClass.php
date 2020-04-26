<?php 

/**
 * 
 */
class articulo{
	
	public function agregarImg($datos){
		$c= new conectar();
		$conexion = $c->conexion();
		$fechaSubida = date('Y-m-d');
		$sql="insert into imagenes(id_categoria,nombre,ruta,fechaSubida)
		values('$datos[0]','$datos[1]','$datos[2]','$fechaSubida')";
		$result = mysqli_query($conexion,$sql);
		return mysqli_insert_id($conexion);
	}

	public function agregarArticulo($datos){
		//Si mi codigo no bota errores , los errores pueden estar en la sintaxis de la consulta sql
		$c= new conectar();
		$conexion = $c->conexion();
		$fechaSubida = date('Y-m-d');
		$sql="insert into articulos(	id_categoria,id_imagen,id_usuario,nombre,descripcion,cantidad,precio,fechaCaptura)
		values('$datos[0]','$datos[1]','$datos[2]','$datos[3]','$datos[4]','$datos[5]','$datos[6]','$fechaSubida')";
		return mysqli_query($conexion,$sql);
	}

		public function updateArticulo($datos){
		$c = new conectar();
		$conexion = $c->conexion();
		$sql="update articulos set id_categoria='$datos[1]', nombre='$datos[2]', descripcion='$datos[3]', cantidad='$datos[4]', precio='$datos[5]' where id_producto='$datos[0]'";
		return mysqli_query($conexion,$sql);
	}

	public function tablaArticulo(){
		$c = new conectar();
		$conexion = $c->conexion();
		$sql="	select art.nombre,art.descripcion,art.cantidad,art.precio,img.nombre,cat.nombreCategoria, art.id_producto from articulos art 
		inner join imagenes img 
		on art.id_imagen = img.id_imagen
		inner join categorias cat
		on art.id_categoria = cat.id_categoria";
		return mysqli_query($conexion,$sql);
	}

	public function obtenerArticulo($id_articulo){
		$c = new conectar();
		$conexion = $c->conexion();
		$sql="	select 	id_producto, id_categoria,nombre,descripcion,cantidad,precio from articulos art where id_producto='$id_articulo'";
		$result = mysqli_query($conexion,$sql);
		$row = mysqli_fetch_row($result);
		$datosArt = array( 	'id_articulo' => $row[0],
							'id_categoria' => $row[1] ,
							'nombre' => $row[2],
							'descripcion' => $row[3],
							'cantidad' => $row[4],
							'precio' =>  $row[5]);
		return $datosArt;
	}

	public function updateImg($datosImg){
		$c = new conectar();
		$conexion = $c->conexion();
		$sql="update imagenes set id_categoria='$datosImg[0]', nombre='$datosImg[1]', ruta='$datosImg[2]', fechaSubida='$datosImg[3]' where id_imagen='$datosImg[4]'";
		$result =  mysqli_query($conexion,$sql);
		return mysql_insert_id($result);
	}

	public function obtenerRutaImg($id_imagen){
		$c = new conectar();
		$conexion = $c->conexion();
		$sql="select ruta from imagenes where id_imagen='$id_imagen'";
		$result = mysqli_query($conexion,$sql);
		return mysqli_fetch_row($result)[0];
	}

	public function obtenerIdImg($id_producto){
		$c = new conectar();
		$conexion = $c->conexion();
		$sql="select id_imagen from articulos where id_producto='$id_producto'";
		$result =  mysqli_query($conexion,$sql);
		return mysqli_fetch_row($result)[0];
	}

	public function deleteArticulo($id_articulo){
		$c = new conectar();
		$conexion = $c->conexion();
		$id_imagen= self::obtenerIdImg($id_articulo);
		$ruta= self::obtenerRutaImg($id_imagen);
		$sql="delete from articulos where id_producto=$id_articulo";
		$result =  mysqli_query($conexion,$sql);
		if($result == 1){
			$sql2 = "delete from imagenes where id_imagen ='$id_imagen'";
			$result2 = mysqli_query($conexion,$sql2);
			if($result2 == 1){
				if(unlink($ruta)){
					return 1;
				}
			}
		}else{

		}
	}
}

?>