<?php 
	require_once "../../clases/Conexion.php";
	require_once "../../clases/ventasProductosClass.php";

	$obj = new ventasProductos();
	$lista = $obj->TraerVentas();

 ?>

<h4>Reporte de Ventas</h4>
<div class="row">
	<div class="col-sm-1"></div>
	<div class="col-sm-10">
		<div class="table-responsive">
			<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
				<caption><label>Ventas</label></caption>
				
					<tr>
						<td>Folio</td>
						<td>Fecha</td>
						<td>Cliente</td>
						<td>Total Compra</td>
						<td>Ticket</td>
						<td>Reporte</td>
					</tr>
					<?php while ($row = mysqli_fetch_row($lista)): 
					# code...
				 ?>
					<tr>
						<td><?php echo $row[0]; ?></td>
						<td><?php echo $row[5]; ?></td>
						<td>
							<?php 
								echo $obj->TraerNameCli($row[1]);
							 ?>
						</td>
						<td>
							<?php 
								echo $obj->TreaerTotalVenta($row[0]);
							 ?>
						</td>
						<td>
							<a href="#" class="btn btn-danger btn-sm">
							Ticket
							<span class="glyphicon glyphicon-list-alt"></span>
							</a>
						</td>
						<td>
							<a href="../procesos/ventas/crearReportePDF.php?id=<?php echo $row[0];?>" class="btn btn-danger btn-sm">
							Reporte
							<span class="glyphicon glyphicon-file"></span>
							</a>
						</td>
					</tr>
					<?php
				endwhile;
					?>
			</table>
		</div>
	</div>
	<div class="col-sm-1"></div>
</div>