<?php

require_once '../../class/Carrito.php';

session_start();

$id = $_GET['id'];

$miCarrito = new Carrito();
$miCarrito->eliminar_item_carrito($id);

header("Location: ../../index.php?sec=carrito");
exit;
?>
