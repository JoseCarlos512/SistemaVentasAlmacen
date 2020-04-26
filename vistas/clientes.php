
<?php 
session_start();

if (isset($_SESSION['usuario'])) {
	# code...

	?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>Clientes</title>
		<?php 
		require_once "menu.php";
		?>
	</head>
	<body>
		<div class="container">
			<h1>Clientes</h1>
			<div class="row">
				<div class="col-sm-4">
					<form id="formClientes"  accept-charset="utf-8">
						<label>Nombre</label>
						<input type="text" name="nombre" id="nombre" placeholder="registro del nombres"class="form-control input-sm">
						<label>Apellido</label>
						<input type="text" name="apellido" id="apellido" placeholder="registro de apellidos" class="form-control input-sm">
						<label>Direccion</label>
						<input type="text" name="direccion" id="direccion" placeholder="registro de direccion" class="form-control input-sm">
						<label>Email</label>
						<input type="text" name="email" id="email" placeholder="registre el correo electronico"class="form-control input-sm">
						<label>Telefono</label>
						<input type="text" name="telefono" id="telefono" placeholder="registre el numero telefonico" class="form-control input-sm">
						<label>RFC</label>
						<input type="text" name="rfc" id="rfc" placeholder="registre el rfc" class="form-control input-sm">
						<p></p>
						<span class="btn btn-primary btn-sm" id="btnAgregarCliente">Agregar</span>
					</form>
				</div>
				<div class="col-sm-8">
					<div id="tablaClientesLoad"></div>
				</div>
			</div>
		</div>

		<!--Ventana Modal -->
		<div class="modal fade" id="actualizaCliente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Actualiza categorias</h4>
					</div>
					<div class="modal-body">
						<form id="formModalClientes"> <!-- atrbuto hidden oculta el campo -->
							<input type="text" name="clienteM" id="clienteM" hidden="true">
							<label>Nombre</label>
							<input type="text" name="nombreM" id="nombreM" placeholder="registro del nombres"class="form-control input-sm">
							<label>Apellido</label>
							<input type="text" name="apellidoM" id="apellidoM" placeholder="registro de apellidos" class="form-control input-sm">
							<label>Direccion</label>
							<input type="text" name="direccionM" id="direccionM" placeholder="registro de direccion" class="form-control input-sm">
							<label>Email</label>
							<input type="text" name="emailM" id="emailM" placeholder="registre el correo electronico"class="form-control input-sm">
							<label>Telefono</label>
							<input type="text" name="telefonoM" id="telefonoM" placeholder="registre el numero telefonico" class="form-control input-sm">
							<label>RFC</label>
							<input type="text" name="rfcM" id="rfcM" placeholder="registre el rfc" class="form-control input-sm">
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" id="btnActualizarCliente" class="btn btn-warning" data-dismiss="modal">Actualizar</button>
					</div>
				</div>
			</div>
		</div>

	</body>
	</html>

	<!--Agregar el cliente -->
	<script type="text/javascript">
		$(document).ready(function() {
			$('#tablaClientesLoad').load("clientes/tablaClientes.php");
			$('#btnAgregarCliente').click(function() {

				//vacios = ValidarFormVacio('formModalUsuario');
				//if (vacios>0) {
				//	alertify.alert("Debes llenar todos los campos..!!");
				//	return false;
				//}
				datos = $('#formClientes').serialize();
				$.ajax({
					type: 'POST',
					data: datos,
					url: '../procesos/clientes/agregarCliente.php',
					success:function(r){
						alert(r);
						if(r==1){
						//metodo reset permite limpiar el formulario una ves insertado
						$('#formClientes')[0].reset();
						$('#tablaClientesLoad').load("clientes/tablaClientes.php");
						alertify.success("Cliente agregada con exito :D");
					}else{
						alertify.error("No se pudo agregar el cliente :C");
					}
				}
			});

			});	
		});
	</script>

	<!-- Actualizar Cliente -->
	<script type="text/javascript">
		$(document).ready(function() {
			$('#btnActualizarCliente').click(function() {
				datos = $('#formModalClientes').serialize();
				$.ajax({
					url: '../procesos/clientes/updateClientes.php',
					type: 'POST',
					data: datos, //aca viene un array
						success:function(r){
							if(r==1){
								$('#tablaClientesLoad').load("clientes/tablaClientes.php");
								alertify.success("Cliente actualizado");
							}else{
								alertify.error("Error al realizar el proceso");
							}
						}
					});

			});	
		});
	</script>

	<!-- Traer datos a la modal para editar -->
	<script type="text/javascript">
		function mandarDatos(idCliente){ //esta funcion se desencadena en la tabla cuando das click en editar de la tabla
			$.ajax({
					url: '../procesos/clientes/obtenerDatosCliente.php',
					type: 'POST',
					data: "id_cliente="+idCliente,
					success:function(r){
						$dato=$.parseJSON(r);
							$('#clienteM').val($dato['id_cliente']);
							$('#nombreM').val($dato['nombre']);
							$('#apellidoM').val($dato['apellido']);
							$('#direccionM').val($dato['direccion']);
							$('#emailM').val($dato['email']);
							$('#telefonoM').val($dato['telefono']);
							$('#rfcM').val($dato['rfc']);
					}
				});
		}

		function deleteDato(idCliente){

			alertify.confirm('Desea eliminar este cliente ?',function(){
				//alertify.success('Ok')
				/*Ayax utilizado para mandar mis datos */
				$.ajax({
					url: '../procesos/clientes/deleteCliente.php',
					type: 'POST',
					data: "id_cliente="+idCliente, //aca viene un array donde el id_categoria seria quien recibe el parametro de la funcion para mandarla a otra pagina y sea ejecutado
					success:function(r){
						if(r==1){
							$('#tablaClientesLoad').load("clientes/tablaClientes.php");
							alertify.success("Cliente eliminado");
						}else{
							alertify.error("Error al realizar el proceso");
						}
					}
				});

			}, 
			function(){
				alertify.error('Cancel')});
		}
	</script>

	<?php

}else{

	header("location:../index.php");
}

?>