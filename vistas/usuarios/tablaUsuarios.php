<?php 
require_once "../../clases/Conexion.php";
require_once "../../clases/Usuarios.php";

$obj = new usuarios();
$result = $obj->traerTablaUsuarios();
 ?>

<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
	<caption>table title and/or explanatory text</caption>
	<thead>
		<tr>
			<td>Nombres</td>
			<td>Apellidos</td>
			<td>Usuario</td>
			<td>Fecha Registro</td>
			<td>Editar</td>
			<td>Eliminar</td>
		</tr>
	</thead>
	<tbody>
		<?php 
		while ($row = mysqli_fetch_row($result)):
		 ?>
		<tr>
			<td><?php echo $row[0] ?></td>
			<td><?php echo $row[1] ?></td>
			<td><?php echo $row[2] ?></td>
			<td><?php echo $row[3] ?></td>
			<td>
				<span class="btn btn-warning btn-xs" data-toggle="modal" data-target="#actualizarUsuario" onclick="editarDatoUsuario('<?php echo $row[0] ?>','<?php echo $row[1] ?>','<?php echo $row[2] ?>','<?php echo $row[3] ?>','<?php echo $row[4] ?>')" >
					<span class="glyphicon glyphicon-pencil" ></span>
				</span>
			</td>
			<td>
				<span class="btn btn-danger btn-xs" >
					<span class="glyphicon glyphicon-remove" onclick="deleteDato('<?php echo $row[4] ?>')"></span>
				</span>
			</td>
		</tr>
	<?php endwhile; ?>
	</tbody>
</table>