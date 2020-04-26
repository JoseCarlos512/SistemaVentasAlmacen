<?php 
$index = $_POST['index'];

session_start();

unset($_SESSION['tablasVentasTemp'][$index]);

$datos = array_values($_SESSION['tablasVentasTemp']);

unset($_SESSION['tablasVentasTemp']);

$_SESSION['tablasVentasTemp'] = $datos;

echo "ok";
 ?>