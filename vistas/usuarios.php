
<?php 
session_start();

if (isset($_SESSION['usuario'])) {
	# code...

	?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>Categorias</title>
		<?php 
		require_once "menu.php";
		?>
	</head>
	<body>
		<div class="container">
			<h1>Categorias</h1>
			<div class="row">
				<div class="col-sm-4">
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
					</form>
				</div>
				<div class="col-sm-8">
					<div id="tablaCategoriasLoad"></div>
				</div>
			</div>
		</div>

		<!--Ventana Modal -->
		<div class="modal fade" id="actualizarUsuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Actualiza categorias</h4>
					</div>
					<div class="modal-body">
						<form id="formModalUsuario"> <!-- atrbuto hidden oculta el campo -->
							<input type="text" hidden="" id="id_usuarioM" name="id_usuarioM">
							<label>Nombre</label>
							<input type="text" name="nombreM" id="nombreM" placeholder=""class="form-control input-sm">
							<label>Apellido</label>
							<input type="text" name="apellidoM" id="apellidoM" placeholder="" class="form-control input-sm">
							<label>Usuario</label>
							<input type="text" name="usuarioM" id="usuarioM" placeholder="" class="form-control input-sm">
							<label>Password</label>
							<input type="password" name="passwordM" id="passwordM" placeholder="" class="form-control input-sm">
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" id="btnActualizarUsuario" class="btn btn-warning" data-dismiss="modal">Guardar</button>
					</div>
				</div>
			</div>
		</div>

	</body>
	</html>

	<script type="text/javascript">
		$(document).ready(function() {
			$("#btnActualizarUsuario").click(function() {
				
				datos=$('#formModalUsuario').serialize();
				$.ajax({
					url: '../procesos/regLogin/updateUsuario.php',
					type: "POST",
					data: datos,
					success:function(r){
						alert(r);
						if(r==1){
							$('#tablaCategoriasLoad').load("usuarios/tablaUsuarios.php");
							alertify.success("Usuario registrado");
							
						}else{
							alertify.error("Error al realizar el proceso");
						}
					}
				});


			});	
		});	

	</script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#tablaCategoriasLoad').load("usuarios/tablaUsuarios.php");
			$('#registro').click(function(){

				vacios = ValidarFormVacio('frmRegistro');

				if (vacios>0) {
					alert("Debes llenar todos los campos..!!");
					return false;
				}
				datos=$('#frmRegistro').serialize();
				$.ajax({
					url: '../procesos/regLogin/registrarUsuario.php',
					type: "POST",
					data: datos,
					success:function(r){
						alert(r);
						if(r==1){
							$('#tablaCategoriasLoad').load("usuarios/tablaUsuarios.php");
							alertify.success("Usuario registrado");
							
						}else{
							alertify.error("Error al realizar el proceso");
						}
					}
				});
			});
		});
	</script>
	<script type="text/javascript">
		function editarDatoUsuario(nombre,apellido,usuario,fecha,id_usuario){
			$('#id_usuarioM').val(id_usuario);
			$('#nombreM').val(nombre);
			$('#apellidoM').val(apellido);
			$('#usuarioM').val(usuario);
		}
		function deleteDato(id_usuario){
					$.ajax({
						url: '../procesos/regLogin/deleteUsuario.php',
						type: "POST",
						data: "id_usuario="+id_usuario,
						success:function(r){
							alert(r);
							if(r==1){
								$('#tablaCategoriasLoad').load("usuarios/tablaUsuarios.php");
								alertify.success("Usuario eliminado");
							}else{
								alertify.error("Error al realizar el proceso");
							}
						}
					});
		}
	</script>

	<?php

}else{

	header("location:../index.php");
}

?>