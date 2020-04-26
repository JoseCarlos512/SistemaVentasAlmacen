<?php 

class clientes{

	function tablaClientes(){
		$c = new conectar();
		$conexion = $c->conexion();
		$sql = "select nombre,apellido,direccion,email,telefono,rfc,id_cliente from clientes";
		return mysqli_query($conexion,$sql);
	}

	function agregarCliente($datos){
		$c = new conectar();
		$conexion = $c->conexion();
		$sql = "insert into  clientes (id_usuario,nombre,apellido,direccion,email,telefono,rfc) 		values ('$datos[0]','$datos[1]','$datos[2]','$datos[3]','$datos[4]','$datos[5]','$datos[6]')";
		return mysqli_query($conexion,$sql);	
	}

	function updateCliente($datos){
		$c = new conectar();
		$conexion = $c->conexion();
		$sql = "update clientes set id_usuario='$datos[0]',nombre='$datos[1]',apellido='$datos[2]',direccion='$datos[3]',email='$datos[4]',telefono='$datos[5]',rfc='$datos[6]' where id_cliente='$datos[7]'";
		return mysqli_query($conexion,$sql);
	}

	function traerDatosCliente($id_cliente){
		$c = new conectar();
		$conexion = $c->conexion();
		$sql = "select nombre,apellido,direccion,email,telefono,rfc,id_cliente from clientes where id_cliente='$id_cliente' ";
		$result =  mysqli_query($conexion,$sql);
		$row = mysqli_fetch_row($result);	/*Escribir bien el codigo*/
		$DatosCliente = array('nombre' => $row[0],
							  'apellido' => $row[1],
							  'direccion' => $row[2],
							  'email' => $row[3],
							  'telefono' => $row[4],
							  'rfc' => $row[5],
							  'id_cliente' => $row[6] );
		return $DatosCliente;
	}

	function deleteCliente($id_cliente){
		$c = new conectar();
		$conexion = $c->conexion();
		$sql = "delete from clientes where id_cliente='$id_cliente' ";
		return mysqli_query($conexion,$sql);
	}
}
 ?>