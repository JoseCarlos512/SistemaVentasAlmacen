		<?php 
			require_once "../../clases/Conexion.php";
			$c = new conectar();
			$conexion = $c->conexion();

			$sql="select id_categoria,nombreCategoria
					from categorias";
			$result = mysqli_query($conexion,$sql);


		 ?>

<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
	<caption><label>Categorias :v</label></caption>
	<tr>
		<td>Categoria</td>
		<td>Editar</td>
		<td>Eliminar</td>
	</tr>

		<?php 
			while ( $ver=mysqli_fetch_row($result)):
		 ?>

	<tr>
		<td><?php echo $ver[1]; ?></td>
		<td>
			<span class="btn btn-warning btn-xs" data-toggle="modal" data-target="#actualizaCategoria" onclick="agregarDato('<?php echo $ver[0]; ?>','<?php echo $ver[1]; ?>')">
				<span class="glyphicon glyphicon-pencil"></span>
			</span>
		</td>
		<td>
			<span class="btn btn-danger btn-xs" onclick="deleteDato('<?php echo $ver[0] ?>')">
				<span class="glyphicon glyphicon-remove"></span>
			</span>
		</td>
	</tr>
	<?php 
		endwhile;
	 ?>
</table>