<?php

require_once '../../class/Carrito.php';

session_start();

$miCarrito = new Carrito();
$miCarrito->vaciar_carrito();

header("Location: ../../index.php?sec=carrito");
exit;
?>
