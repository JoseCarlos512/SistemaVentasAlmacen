<?php 
/*
	require_once "clases/Conexion.php";
	require_once "clases/Usuarios.php";
	$obj = new conectar();
	$conexion = $obj->conexion();
	$sql="select * from usuarios where email ='admin'";
	$result=mysqli_query($conexion,$sql);
	$validar =0;
	if(mysqli_num_rows($result)>0){
		header("location:index.php");
	}
*/
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Registro</title>
	<link rel="stylesheet" type="text/css" href="librerias/bootstrap/css/bootstrap.css">
	<script src="librerias/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="js/funciones.js"></script>
</head>
<body style="background-color: #439889">
	<br><br><br>
	<div class="container">
		<div class="row">
			<div class="col-sm-4"></div>
			<div class="col-sm-4">
				<div class="panel panel-danger">
					<div class="panel panel-heading">Registrar Administrador</div>
					<div class="panel panel-body">
						<form id="frmRegistro">
							<label>Nombre</label>
							<input type="text" name="nombre" id="nombre" placeholder=""class="form-control input-sm">
							<label>Apellido</label>
							<input type="text" name="apellido" id="apellido" placeholder="" class="form-control input-sm">
							<label>Usuario</label>
							<input type="text" name="usuario" id="usuario" placeholder="" class="form-control input-sm">
							<label>Password</label>
							<input type="password" name="password" id="password" placeholder="" class="form-control input-sm">
							<p></p>
							<span class="btn btn-primary btn-sm" id="registro">Registrar</span>
							<a href="index.php" class="btn btn-default">Regresar al login </a>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
<script type="text/javascript">
		$(document).ready(function(){
			$('#registro').click(function(){

				 vacios = ValidarFormVacio('frmRegistro');

			if (vacios>0) {
				alert("Debes llenar todos los campos..!!");
				return false;
			}
				datos=$('#frmRegistro').serialize();
				$.ajax({
					url: 'procesos/regLogin/registrarUsuario.php',
					type: "POST",
					data: datos,
					success:function(r){
						if(r==1){
							alert("Agregado con exito");
						}else{
							alert("Fallo en agregar");
						}
					}
				});
			});
		});
</script>