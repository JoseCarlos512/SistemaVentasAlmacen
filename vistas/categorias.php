
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
					<form id="formCategorias"  accept-charset="utf-8">
						<label>Categorias</label>
						<input type="text"  class="form-control input-sm" name="categoria" id="categoria" placeholder="Ingrese la categoria">
						<p></p>
						<span class="btn btn-primary" id="btnAgregarCategoria">Agregar</span>
					</form>
				</div>
				<div class="col-sm-8">
					<div id="tablaCategoriasLoad"></div>
				</div>
			</div>
		</div>

		<!--Ventana Modal -->
		<div class="modal fade" id="actualizaCategoria" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Actualiza categorias</h4>
					</div>
					<div class="modal-body">
						<form id="formModalCategoria"> <!-- atrbuto hidden oculta el campo -->
							<input type="text" hidden="" id="idcategoria" name="idcategoria">
							<label>Categoria</label>
							<input type="text" name="categoriaU" id="categoriaU" class="form-control input-sm">
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" id="ActualizarCategoria" class="btn btn-warning" data-dismiss="modal">Guardar</button>
					</div>
				</div>
			</div>
		</div>

	</body>
	</html>

	<script type="text/javascript">
		$(document).ready(function() {
			$('#tablaCategoriasLoad').load("categorias/tablaCategorias.php");

			$('#btnAgregarCategoria').click(function() {

				vacios = ValidarFormVacio('formCategorias');
				if (vacios>0) {
					alertify.alert("Debes llenar todos los campos..!!");
					return false;
				}

				datos = $('#formCategorias').serialize();
				$.ajax({
					type: 'POST',
					data: datos,
					url: '../procesos/categorias/agregarCategoria.php',
					success:function(r){
						alert(r);
						if(r==1){
						//metodo reset permite limpiar el formulario una ves insertado
						$('#formCategorias')[0].reset();
						$('#tablaCategoriasLoad').load("categorias/tablaCategorias.php");
						alertify.success("Categoria agregada con exito :D");
					}else{
						alertify.error("No se pudo agregar la categoria :C");
					}
				}
			});

			});	
		});
	</script>

	<!-- Actualizar Categoria -->
	<script type="text/javascript">
		$(document).ready(function() {
			$('#ActualizarCategoria').click(function() {
				datos = $('#formModalCategoria').serialize();
				$.ajax({
					url: '../procesos/categorias/updateCategorias.php',
					type: 'POST',
					data: datos, //aca viene un array
						success:function(r){
							alert(r);
							if(r==1){
								$('#tablaCategoriasLoad').load("categorias/tablaCategorias.php");
								alertify.success("Categoria actualizada");
							}else{
								alertify.error("Error al realizar el proceso");
							}
						}
					});

			});	
		});
	</script>

	<!-- Eliminar Categoria -->

	<script type="text/javascript">
		function agregarDato(idCategoria,categoria){ //esta funcion se desencadena en la tabla cuando das click en editar de la tabla
			$('#idcategoria').val(idCategoria); // con esto le asigno el valor idCategoria al input del modal
			$('#categoriaU').val(categoria);
		}

		function deleteDato(idCategoria){

			alertify.confirm('Desea eliminar esta categoria ?',function(){
				alertify.success('Ok')

				$.ajax({
					url: '../procesos/categorias/deleteCategoria.php',
					type: 'POST',
					data: "id_categoria="+idCategoria, //aca viene un array donde el id_categoria seria quien recibe el parametro de la funcion para mandarla a otra pagina y sea ejecutado
			success:function(r){
				if(r==1){
					$('#tablaCategoriasLoad').load("categorias/tablaCategorias.php");
					alertify.success("Categoria eliminada");
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