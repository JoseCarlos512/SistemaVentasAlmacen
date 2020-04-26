<?php
require_once "../../clases/Conexion.php";
require_once "../../clases/clientesClass.php";

$idCliente = $_POST['id_cliente'];

$obj  = new clientes();
echo $obj->deleteCliente($idCliente);
  ?>
