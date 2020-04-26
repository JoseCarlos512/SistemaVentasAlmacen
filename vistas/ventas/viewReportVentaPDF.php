<?php 
require_once "arreglo.php";
require_once "../../clases/Conexion.php";
require_once "../../clases/ventasProductosClass.php";

	$id_venta = $_GET["id"];

	$obj = new ventasProductos();
	$lista = $obj->TraerVentaxID($id_venta);
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div class="container" >
		<h3>Boleta</h3>	
	</div>
	<br><br>
	
	<div class="container">
		<div class="row">
			<div class="col-sm-6 col-lg-6">
				<img src="../../img/ventas.png" alt="" width="300" height="100">	
			</div>
			<div class="col-sm-6 col-lg-6">
				<h5>De: LEON TITO JOSE CARLOS</h5>
				<h5>Jr.Marañon N 321 - Lima</h5>
				<h5>Numero: 948887196</h5>
				<h5>RUC: 1008564852</h5>
			</div>
		</div>
	</div>
<br><br><br><br><br><br><br><br><br><br><br>
<div class="row">
	<div class="col-sm-1"></div>
	<div class="col-sm-10">
		<div class="table-responsive">
			<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
				
					<tr>
						<td>Codigo</td>
						<td>Nombre</td>
						<td>Precio</td>
						<td>Cantidad</td>
					</tr>
					<?php while ($row = mysqli_fetch_row($lista)): 
					# code...
				 ?>
					<tr>
						<td><?php echo $row[2]; ?></td>
						<td><?php echo $obj->NombreProducto($row[2]); ?></td>
						<td>
							<?php 
								echo $row[4];
							 ?>
						</td>
						<td></td>
					</tr>
					<?php
				endwhile;
					?>
			</table>
		</div>
	</div>
	<div class="col-sm-1"></div>
</div>
</body>
</html>