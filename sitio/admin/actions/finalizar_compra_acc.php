<?php
session_start();

require_once "../../funciones/autoload.php";

// Obtener el id_cliente de la sesión
$id_cliente = $_SESSION['login']['id'];

// Continuar con el proceso de finalizar la compra
$miCarrito = new Carrito();
$miCarrito->finalizar_compra($id_cliente);

exit;
?>