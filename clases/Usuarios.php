<?php 

	class usuarios{
			public function registrarUsuario($datos){
			$c = new conectar();	//tipo coneccion
			$conexion = $c->conexion();
			$fecha = date('Y-m-d');
			$sql = "insert into usuarios (nombre,apellido,email,password,fechaCaptura)
				values('$datos[0]','$datos[1]','$datos[2]','$datos[3]','$fecha')";

				return mysqli_query($conexion,$sql);
		}

		public function loginUser($datos){
			$c = new conectar();
			$conexion = $c->conexion();
			$password=sha1($datos[1]);

			$_SESSION['usuario'] =	$datos[0];
			$_SESSION['id_user'] = 	$this->traerID($datos); //no hay necesidad de instanciar cuando llamemos la funcion 

			$sql=" select * from usuarios 
					where email='$datos[0]' and password='$password'";
			$result = mysqli_query($conexion,$sql);

			if(mysqli_num_rows($result)>0){
				//creo que aca se inicializaria la sesion 
				return 1;
			}else{
				return 0;
			}
		}

		public function traerID($datos){
			$c = new conectar();
			$conexion = $c->conexion();
			$password=sha1($datos[1]);

			$sql=" select id_usuario from usuarios 
					where email='$datos[0]' and password='$password'";
			$result = mysqli_query($conexion,$sql);
			return mysqli_fetch_row($result)[0];
		}

		public function traerTablaUsuarios(){
			$c = new conectar();
			$conexion = $c->conexion();
			$sql="select nombre,apellido,email,fechaCaptura,id_usuario from usuarios";
			return mysqli_query($conexion,$sql);
		}

		public function updateUsuarios($dato){
			$c = new conectar();
			$conexion = $c->conexion();
			$sql="update usuarios set nombre='$dato[0]', apellido='$dato[1]', email='$dato[2]' ,
				  password='$dato[3]' where id_usuario ='$dato[4]'";
			return mysqli_query($conexion,$sql);

		}

		public function deleteUsuario($idUsuario){
			$c = new conectar();
			$conexion = $c->conexion();
			$sql="delete from usuarios where id_usuario ='$idUsuario'";
			return mysqli_query($conexion,$sql);
		}
	}


 ?>