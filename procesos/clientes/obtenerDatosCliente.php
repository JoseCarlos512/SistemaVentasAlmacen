<?php 

require_once "../../clases/Conexion.php";
require_once "../../clases/clientesClass.php";

$id_cliente = $_POST['id_cliente'];

$obj = new clientes();
echo json_encode($obj->traerDatosCliente($id_cliente));

 ?>