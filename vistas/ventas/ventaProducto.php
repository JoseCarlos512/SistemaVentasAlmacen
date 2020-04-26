<?php 
require_once "../../clases/Conexion.php";
require_once "../../clases/ventasProductosClass.php";
$obj= new ventasProductos();
$result = $obj->rsCliente();
$result2 = $obj->rsNombreProducto();
?>

<h4>formVentasProducto Productos Amiguito</h4>
<div class="row">
	<div class="col-sm-4">
		<form id="formVentasProducto">
			<label>Seleccione Cliente</label>
			<select name="id_cliente" id="id_cliente" class="form-control input-sm">
				<option value="A">Selecciona</option>
				<?php 
				while($row = mysqli_fetch_row($result)):
					?>
					<option value="<?php echo $row[0]; ?>"><?php echo $row[1]." ".$row[2]; ?></option>
				<?php endwhile; ?>
			</select>
			<label>Producto</label>
			<select name="id_producto" id="id_producto" class="form-control input-sm">
				<option value="A">Selecciona</option>
				<?php 
				while ($row = mysqli_fetch_row($result2)):
					?>
					<option value="<?php echo $row[0]; ?>"><?php echo $row[1];?></option>
				<?php endwhile; ?>
			</select>
			<label>Descripcion</label>
			<textarea name="descripcion" readonly="" id="descripcion" class="form-control input-sm"></textarea> 
			<label>Cantidad</label>
			<input type="text" readonly="" class="form-control input-sm" name="cantidad" id="cantidad"  placeholder="Cantidad">
			<label>Precio</label>
			<input type="text" readonly="" class="form-control input-sm" name="precio" id="precio"  placeholder="Precio">
			<p></p>
			<span class="btn btn-primary" id="btnAgregarVenta">Agregar Venta</span>
			<span class="btn btn-danger" id="btnLimpiarVenta">Limpiar venta</span>
		</form>
	</div>
	<div class="col-sm-3">
		<div id="imgProducto"></div>
	</div>
	<div class="col-sm-4">
		<div id="tablaTempProductoLoad"></div>	
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {

		$('#btnAgregarVenta').click(function() {

			vacios = ValidarFormVacio('formVentasProducto');
			if (vacios>0) {
				alertify.alert("Debes llenar todos los campos..!!");
				return false;
			}
			datos = $('#formVentasProducto').serialize();
			$.ajax({
				type: 'POST',
				data: datos,
				url: '../procesos/ventas/agregarProductoTemp.php',
				success:function(r){
						//metodo reset permite limpiar el formulario una ves insertado
						/*$('#formVentasProducto')[0].reset();*/
						$('#tablaTempProductoLoad').load("ventas/tablasVentasTemp.php");


					}
				});

		});

		$('#btnLimpiarVenta').click(function() { 
			$.ajax({
				url: '../procesos/ventas/limpiarTableTemp.php',
				success:function(r){
					$('#tablaTempProductoLoad').load("ventas/tablasVentasTemp.php");
				}
			});
		});
	});

</script>

<script>
	function quitarP(index){
		$.ajax({
			url: '../procesos/ventas/quitarP.php',
			type: 'POST',
			data: "index="+index,
			success:function(r){
				if (r=="ok") {
					alertify.success("Articulo eliminado");
					$('#tablaTempProductoLoad').load("ventas/tablasVentasTemp.php");
				}
			}

		});	 
	}

	function crearVenta(){
		$.ajax({
			url: '../procesos/ventas/crearVenta.php',
			success:function(r){
				
				if (r=="ok") {
					alertify.success("Venta Registrada");
					$('#tablaTempProductoLoad').load("ventas/tablasVentasTemp.php");
					$('#formVentasProducto')[0].reset();
				}else{
					alertify.error("No ha realizado ningun movimiento");
				}
			}

		});	 
	}
</script>			

<script type="text/javascript">
	$(document).ready(function() {
		$('#id_cliente').select2(); //convertimos en un buscador el selector
		$('#id_producto').select2();
	});

	$('#tablaTempProductoLoad').load("ventas/tablasVentasTemp.php");
	$(document).ready(function() {
		$('#id_producto').change(function() {
			$.ajax({
				url: '../procesos/ventas/obtenerDescripcionArticulo.php',
				type: 'POST',
				data: "id_producto="+ $('#id_producto').val(), //aca viene un array
				success:function(r){
				
					if($('#id_producto').val() =="A"){
						$('#formVentasProducto')[0].reset();
					}
					$dato=$.parseJSON(r);
					$('#descripcion').val($dato['descripcion']);
					$('#cantidad').val($dato['cantidad']);
					$('#precio').val($dato['precio']);
					$('#imgProducto').prepend('<img class="img-thumbnail" id="imgp" src="' + $dato['ruta'] + '" />');
				} 
			});
		});

	});
</script>