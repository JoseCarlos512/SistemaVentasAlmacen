<?php 

/**
 * 
 */
class ventasProductos{
	
	public function rsCliente(){
		$c = new conectar();
		$conexion = $c->conexion();
		$sql="select id_cliente,nombre,apellido from clientes";
		return mysqli_query($conexion,$sql);
	}

	public function rsNombreProducto(){
		$c = new conectar();
		$conexion = $c->conexion();
		$sql = "select id_producto,nombre from articulos";
		return mysqli_query($conexion,$sql);
	}

	public function obtenerDescripcionXProducto($id_producto){
		$c = new conectar();
		$conexion = $c->conexion();
		$sql = "select DISTINCT art.nombre, art.descripcion,
		 		art.cantidad, img.ruta,art.precio 
		 		from articulos as art inner join imagenes as img
				on art.id_imagen = img.id_imagen 
				and art.id_producto = $id_producto";
		$result =  mysqli_query($conexion,$sql);
		$row = mysqli_fetch_row($result);
		$d = explode('/', $row[3]);
		$img = $d[1].'/'.$d[2].'/'.$d[3];
		$ObjDescripcionProducto = array('nombre' => $row[0] ,
										'descripcion' => $row[1] ,
										'cantidad' => $row[2],
										'ruta' => $img,
										'precio' => $row[4]);
		return $ObjDescripcionProducto;
		}

	/*Realizar despues la insercion de la tabla ventas */
	public function registroProductosVenta(){
		$c = new conectar();
		$conexion = $c->conexion();
		//Variables que entraran a la insercion de la venta
		$fecha = date('Y-m-d');
		$id_venta = self::crearIdVenta();
		$id_usuario = $_SESSION['id_user'];

		foreach ($_SESSION['tablasVentasTemp'] as $key => $value) {
			# code...
			$venta = explode("||",$value );
			$sql = "insert into ventas 
			(id_venta,id_cliente,id_producto,id_usuario,precio,fechaCompra)
			values
			('$id_venta','$venta[5]','$venta[0]','$id_usuario','$venta[3]','$fecha')";

			$resultado = mysqli_query($conexion,$sql);
		}
		
		
		return "ok";
	}

	public function crearIdVenta(){
		$c = new conectar();
		$conexion = $c->conexion();
		$sql = "select id_venta from  ventas group by id_venta desc ";
		$resultado = mysqli_query($conexion,$sql);
		$id = mysqli_fetch_row($resultado)[0];

		if($id=="" || $id==null || $id==0){
			return 1;
		}else{
			return $id+1;
		}
	}

	public function TraerVentas(){
		$c = new conectar();
		$conexion = $c->conexion();
		$sql="SELECT * FROM ventas GROUP by id_venta,id_cliente,id_usuario,fechaCompra";
		$resultado = mysqli_query($conexion,$sql);
		return $resultado;
	}


	public function TraerNameCli($id){
		$c = new conectar();
		$conexion = $c->conexion();
		$sql = "SELECT apellido,nombre FROM clientes where id_cliente = $id";
		$execute = mysqli_query($conexion,$sql);
		$respuesta = mysqli_fetch_row($execute);
		$nameComplete = $respuesta[0]." ".$respuesta[1];
		return $nameComplete;
	}

	public function TreaerTotalVenta($id){
		$c = new conectar();
		$conexion = $c->conexion();
		$sql = "SELECT SUM(precio) as Total FROM ventas WHERE id_venta=$id";
		$execute = mysqli_query($conexion,$sql);
		$resultad = mysqli_fetch_row($execute);
		return $resultad[0];
	}

	public function TraerVentaxID($id){
		$c = new conectar();
		$conexion = $c->conexion();
		$sql = "SELECT * FROM ventas WHERE id_venta=$id";
		$execute = mysqli_query($conexion,$sql);
		return $execute;
	}

	public function NombreProducto($id_Articulo){
		$c = new conectar();
		$conexion = $c->conexion();
		$sql = "select nombre from articulos where id_producto= $id_Articulo";
		$result = mysqli_query($conexion,$sql);
		return mysqli_fetch_row($result)[0];
	}

}


 ?>