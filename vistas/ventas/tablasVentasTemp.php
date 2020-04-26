<?php 

session_start();

//print_r($_SESSION['tablasVentasTemp']);
 ?>

<h4>Hacer venta</h4>
<h4>
	<div id="nombreClienteVenta"></div>
</h4>
<table class="table table-bordered table-hover table-condensed" style="text-align:center">
	<caption>
		<span class="btn btn-success" onclick="crearVenta()">Generar venta
			<span class="glyphicon glyphicon-usd"></span>
		</span>
	</caption>
		<tr>
			<th>Nombre</th>
			<th>Descripcion</th>
			<th>Precio</th>
			<th>Cantidad</th>
			<th>Quitar</th>

		</tr>
		<?php 
				$cliente= "";
				$total = 0;
				if(isset($_SESSION['tablasVentasTemp'] )):
				foreach (@$_SESSION['tablasVentasTemp'] as $key => $value ) {
					$lista = explode("||", @$value); //lo convierte en un array
				
		?>
		<tr>
			<td><?php echo $lista[1]; ?></td>
			<td><?php echo $lista[2]; ?></td>
			<td><?php echo $lista[3]; ?></td>
			<td><?php echo 1 ?></td>
			<td>
				<span class="btn btn-danger btn-xs"  onclick="quitarP(<?php echo $key; ?>)">
					<span class="glyphicon glyphicon-remove"></span>
				</span>
			</td>
		</tr>
			<?php 
			$total = $total + $lista[3];
			$cliente = $lista[4];
							}
				endif;   
			?>
		<tr>
			<td>
				<?php echo "Total = ".$total; ?>
			</td>
		</tr>
</table>

<script type="text/javascript">
	
$(document).ready(function() {
	  nomCliente= "<?php echo @$cliente ?>";
	$('#nombreClienteVenta').text("Nombre Cliente :"+nomCliente);
});
	
</script>
