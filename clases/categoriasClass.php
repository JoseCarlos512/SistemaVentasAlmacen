<?php 

/**
 * 
 */
class categorias{
	
	public function agregarCategoria($datos){
		$c= new conectar();
		$conexion = $c->conexion();
		$sql = "insert into categorias (id_usuario,nombreCategoria,fechaCaptura)
				values('$datos[0]','$datos[1]','$datos[2]')";
		$valor = mysqli_query($conexion,$sql);
		if($valor>0){
			return 1;
		}else{
			return 0;
		}

	}

	public function updateCategoria($datos){
		$c = new conectar();
		$conexion = $c->conexion();
		$sql = "update categorias set nombreCategoria ='$datos[1]' where id_categoria='$datos[0]'";
		return mysqli_query($conexion,$sql);

	}

	public function deleteCategoria($id_categoria){
		$c = new conectar();
		$conexion = $c->conexion();
		$sql = "delete from categorias where id_categoria ='$id_categoria'";
		return mysqli_query($conexion,$sql);
	}
}
 ?>
