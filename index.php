
<?php 

	require_once "clases/Conexion.php";
	require_once "clases/Usuarios.php";
	$obj = new conectar();
	$conexion = $obj->conexion();
	$sql="select * from usuarios where email ='admin'";
	$result=mysqli_query($conexion,$sql);
	$validar =0;
	if(mysqli_num_rows($result)>0){
		$validar = 1;
	}

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Login de Usuario</title>
	<link rel="stylesheet" type="text/css" href="librerias/bootstrap/css/bootstrap.css">
	<script src="librerias/jquery-3.2.1.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/funciones.js"></script>
</head>
<body style="background-color: #439889 ">
	<br><br><br>
	<div>
		<div>
			<div class="col-sm-4"></div>
			<div class="col-sm-4">
				<div class="panel panel-primary">
					<div class="panel panel-heading">
						Sistema de Ventas y Almacen 
					</div>
						<div class="panel panel-body">
							<p align="center">
								<img src="img/ventas.png" width="350" height="190" alt="">
							</p>
							<form id="formlogin">
								<label>Usuario</label>
								<input type="text" class="form-control input-sm" name="usuario" id="usuario">
								<label>Password</label>
								<input type="password" name="password" id="password" class="form-control input-sm">
								<p></p>
								<button type="button" class="btn btn-primary btn-sm" id="entrarSistema">Entrar</button> 
								<!-- <?php /* if (!$validar): */ ?> -->
								<a href="registro.php" class="btn btn-primary btn-danger btn-sm">Registrar</a>
								<!-- <?php /* endif; */ ?> -->
							</form>
							<div>
								
							</div>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
		</div>
	</div>
</body>
</html>
<script type="text/javascript">
	$(document).ready(function() {
		$('#entrarSistema').click(function() {

		vacios = ValidarFormVacio('formlogin');
			if (vacios>0) {
				alert("Debes llenar todos los campos..!!");
				return false;
			}

			datos = $('#formlogin').serialize();
			$.ajax({
				type: 'POST',
				data: datos,
				url: 'procesos/regLogin/login.php',
				success:function(r){
					if(r==1){
						window.location="vistas/inicio.php"
					}else{
						alert("no se pudo acceder");
					}
				}
			});
			
		});	
	});
</script>