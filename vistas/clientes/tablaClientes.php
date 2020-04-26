
<?php 
require_once "../../clases/clientesClass.php";
require_once "../../clases/Conexion.php";
$obj = new clientes();
$result = $obj->tablaClientes();
?>

<table  class="table table-hover table-condensed table-bordered" style="text-align: center;">
	<caption><label>Lista de clientes</label></caption>
		<tr>
			<td>Cliente</td>
			<td>Direccion</td>
			<td>Email</td>
			<td>Telefono</td>
			<td>Rfc</td>
			<td>Editar</td>
			<td>Eliminar</td>
		</tr>
		<?php while ($row = mysqli_fetch_row($result)): ?>
		<tr>
			<td><?php echo $row[0]." ".$row[1]; ?></td>
			<td><?php  echo $row[2]; ?></td>
			<td><?php  echo $row[3]; ?></td>
			<td><?php  echo $row[4]; ?></td>
			<td><?php  echo $row[5]; ?></td>
			<td>
			<span class="btn btn-warning btn-xs" data-toggle="modal" data-target="#actualizaCliente" onclick="mandarDatos('<?php echo $row[6]; ?>')">
				<span class="glyphicon glyphicon-pencil"></span>
			</span>
			</td>
			<td>
				<span class="btn btn-danger btn-xs" onclick="deleteDato('<?php echo $row[6] ?>')">
					<span class="glyphicon glyphicon-remove"></span>
				</span>
			</td>
		</tr>
		<?php endwhile; ?>
</table>