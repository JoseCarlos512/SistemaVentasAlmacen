
<?php 
session_start();

if (isset($_SESSION['usuario'])) {
	# code...

	?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>Articulos</title>
		<?php 
		require_once "menu.php";
		require_once "../clases/Conexion.php";
		$c = new conectar();
		$conexion = $c->conexion();
		$sql = "select id_categoria,nombreCategoria from categorias";
		$result = mysqli_query($conexion,$sql);
		
		?>
	</head>
	<body>
		<div class="container">
			<h1>Articulos</h1>
			<div class="row">
				<div class="col-sm-4">
					<form id="formArticulos" action="categorias_submit" method="get" accept-charset="utf-8" enctype="multipart/form-data"> <!-- el ultimo atibuto sirve para poder mandar archivos-->
						<label>Categoria</label>
						<select id="id_categoria" name="id_categoria" class="form-control input-sm">
							<option value="A">Selecciona Categoria</option>
							<?php while ($row = mysqli_fetch_row($result)): ?>
								<option value="<?php echo $row[0]; ?>"> <?php echo $row[1]; ?></option>
							<?php endwhile; ?>
						</select>
						<label>Nombre</label>
						<input type="text"  class="form-control input-sm" name="nombre" id="nombre" placeholder="Ingrese la categoria">
						<label>Descripcion</label>
						<input type="text"  class="form-control input-sm" name="descripcion" id="descripcion" placeholder="Ingrese la descripcion">
						<label>Cantidad</label>
						<input type="text"  class="form-control input-sm" name="cantidad" id="cantidad" placeholder="Ingrese la cantidad">
						<label>Precio</label>
						<input type="text"  class="form-control input-sm" name="precio" id="precio" placeholder="Ingrese el precio">
						<label>Imagen</label>
						<input type="file"  class="form-control input-sm" name="imagen" id="imagen" >
						<p></p>
						<span class="btn btn-primary" id="btnAgregarArticulo">Agregar</span>
					</form>
				</div>
				<div class="col-sm-8">
					<div id="tablaArticulosLoad"></div>
				</div>
			</div>
		</div>

		<!--Ventana Modal -->
		<div class="modal fade" id="actualizarArticulo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Actualiza Articulos</h4>
					</div>
					<div class="modal-body">
						<form id="formModalArticulo"> <!-- atrbuto hidden oculta el campo -->
							<input type="text" hidden="true" id="id_articulo" name="id_articulo"  >
							<label>Categoria</label>
							<select id="id_categoriaM" name="id_categoriaM" class="form-control input-sm">
								<option value="A">Selecciona Categoria</option>
								<?php							
								$sql = "select id_categoria,nombreCategoria from categorias";
								$result = mysqli_query($conexion,$sql);
								?>
								<?php while ($row = mysqli_fetch_row($result)): ?>
									<option value="<?php echo $row[0]; ?>"> <?php echo $row[1]; ?></option>
								<?php endwhile; ?>
							</select>
							<label>Nombre</label>
							<input type="text"  class="form-control input-sm" name="nombreM" id="nombreM" placeholder="Ingrese la categoria">
							<label>Descripcion</label>
							<input type="text"  class="form-control input-sm" name="descripcionM" id="descripcionM" placeholder="Ingrese la descripcion">
							<label>Cantidad</label>
							<input type="text"  class="form-control input-sm" name="cantidadM" id="cantidadM" placeholder="Ingrese la cantidad">
							<label>Precio</label>
							<input type="text"  class="form-control input-sm" name="precioM" id="precioM" placeholder="Ingrese el precio">
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" id="btnActualizarArticulo" class="btn btn-warning" data-dismiss="modal">Actualizar</button>
					</div>
				</div>
			</div>
		</div>

	</body>
	</html>
	<!-- Atributo serialize no manda archivos file -->

		<!-- Atributo serialize no manda archivos file -->
	<script type="text/javascript">
		$(document).ready(function() {
			$('#tablaArticulosLoad').load("articulos/tablaArticulos.php");
			$('#btnAgregarArticulo').click(function() {

				vacios = ValidarFormVacio('formArticulos');
				if (vacios>0) {
					alertify.alert("Debes llenar todos los campos..!!");
					return false;
				}

				//datos = $('#formArticulos').serialize(); No se usa esto porque no manda imagenes
				var formData = new FormData(document.getElementById("formArticulos"));
				$.ajax({
					url: '../procesos/articulos/agregarArticulos.php',
					type: 'POST',
					dataType: 'html',
					data: formData,
					cache :false,
					contentType: false,
					processData: false,
					success:function(r){
						if(r==1){
						//metodo reset permite limpiar el formulario una ves insertado
						$('#formArticulos')[0].reset();
						$('#tablaArticulosLoad').load("articulos/tablaArticulos.php");
						alertify.success("Articulo agregado con exito :D");
					}else{
						alertify.error("No se pudo agregar la categoria :C");
					}
				}
			});


			});

		});
	</script>

	<script type="text/javascript">
		$('#tablaArticulosLoad').load("articulos/tablaArticulos.php");
		function editarDatoArticulo(idProducto){ //esta funcion se desencadena en la tabla cuando das click en editar de la tabla
			$.ajax({
				url: '../procesos/articulos/obtenerDatosArticulos.php',
				type: 'POST',
				data: "id_art="+idProducto, //aca viene un array donde el id_categoria seria quien recibe el parametro de la funcion para mandarla a otra pagina y sea ejecutado
				success:function(r){
					$dato=$.parseJSON(r);
					$('#id_articulo').val($dato['id_articulo']);
					$('#id_categoriaM').val($dato['id_categoria']);
					$('#nombreM').val($dato['nombre']);
					$('#descripcionM').val($dato['descripcion']);
					$('#cantidadM').val($dato['cantidad']);
					$('#precioM').val($dato['precio']);
				}
			});
		}

					function deleteDato(idProducto){

			alertify.confirm('Desea eliminar este producto ?',function(){
				alertify.success('Ok') /*Eliminar incomodo ver don confirmaciones*/

				$.ajax({
					url: '../procesos/articulos/deleteArticulo.php',
					type: 'POST',
					data: "id_articulo="+idProducto, //aca viene un array donde el id_categoria seria quien recibe el parametro de la funcion para mandarla a otra pagina y sea ejecutado
			success:function(r){
				alert(r);
				if(r==1){
					$('#tablaArticulosLoad').load("articulos/tablaArticulos.php");
					alertify.success("Articulo eliminada");
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
	
	<script type="text/javascript">
		$(document).ready(function() {
			$('#btnActualizarArticulo').click(function() {

				datos = $('#formModalArticulo').serialize(); //No se usa esto porque no manda imagenes
				//var formData = new FormData(document.getElementById("formModalArticulo"));
				$.ajax({
					url: '../procesos/articulos/actualizarArticulos.php',
					type: 'POST',
					data: datos, //aca viene un array
						success:function(r){
							
							if(r==1){
								$('#tablaArticulosLoad').load("articulos/tablaArticulos.php");
								alertify.success("Categoria actualizada");
							}else{
								alertify.error("Error al realizar el proceso");
							}
						}
					});


			});

		});
	</script>

	<?php

}else{

	header("location:../index.php");
}

?>