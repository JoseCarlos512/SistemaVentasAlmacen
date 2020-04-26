<?php 
require_once "../../clases/Conexion.php";
require_once "../../clases/articulosClass.php";

$obj = new articulo();
$result = $obj->tablaArticulo();
?>

<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
	<caption><label>Articulos :v x2</label></caption>
	<tr>
		<td>Nombre</td>
		<td>Descripcion</td>
		<td>Cantidad</td>
		<td>Precio</td>
		<td>Imagen</td>
		<td>Categoria</td>	
		<td>Editar</td>
		<td>Eliminar</td>
	</tr>

	<?php while ($row = mysqli_fetch_row($result)):  ?>
		<tr>
			<td> <?php echo $row[0]; ?> </td>
			<td> <?php echo $row[1]; ?> </td>
			<td> <?php echo $row[2]; ?> </td>
			<td> <?php echo $row[3]; ?> </td>
			<td>
				<!-- esto se puede realizar de diferentes maneras/Yo lo hice diferente del video -->
				<?php $img = $row[4]; ?>
				<img width="80" height="80" src="<?php echo '../archivos/'.$img ?>" alt="Imagen no cargada"> 
			</td>
			<td> <?php echo $row[5]; ?> </td>
			<td>
				<span class="btn btn-warning btn-xs" data-toggle="modal" data-target="#actualizarArticulo" 			onclick="editarDatoArticulo('<?php echo $row[6] ?>')" >
					<span class="glyphicon glyphicon-pencil" ></span>
				</span>
			</td>
			<td>
				<span class="btn btn-danger btn-xs" >
					<span class="glyphicon glyphicon-remove" onclick="deleteDato('<?php echo $row[6] ?>')"></span>
				</span>
			</td>
		</tr>
	<?php endwhile; ?>
</table>