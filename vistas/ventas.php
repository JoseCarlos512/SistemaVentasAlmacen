
<?php 
session_start();

if (isset($_SESSION['usuario'])) {
	# code...

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Ventas</title>
	<?php 
			require_once "menu.php";
	?>
</head>
<body>
	<div class="container">
		<h1>Venta de Productos</h1>
		<div class="row">
			<div class="col-sm-12">
				<span id="btnVentaProducto" class="btn btn-default">Vender Producto</span>
				<span id="btnVentasHechas" class="btn btn-default">Ventas Hechas</span>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div id="ventaProducto">
					
				</div>
				<div id="ventasHechas">
					
				</div>
			</div>
		</div>
	</div>
</body>
</html>
<script type="text/javascript">
	$(document).ready(function() {
		$("#btnVentaProducto").click(function() {
			esconderSeccionVenta();
			$('#ventaProducto').load('ventas/ventaProducto.php');
			$('#ventaProducto').show();
		});
		$("#btnVentasHechas").click(function() {
			esconderSeccionVenta();
			$('#ventasHechas').load('ventas/ventaHechas.php'); //cargar
			$('#ventasHechas').show();
		});
	});

	function esconderSeccionVenta(){
		$('#ventaProducto').hide(); //esconder
		$('#ventasHechas').hide();
	}
</script>
<?php

	}else{

		header("location:../index.php");
	}

 ?>