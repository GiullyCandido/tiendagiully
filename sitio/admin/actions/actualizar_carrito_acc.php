<?php

require_once '../../class/Carrito.php';

session_start();

$cantidades = $_POST['c'];

$miCarrito = new Carrito();
$miCarrito->actualizar_carrito($cantidades);

header("Location: ../../index.php?sec=carrito");
exit;
?>
