<?php
session_start();
require_once "../../funciones/autoload.php";

$id = isset($_GET["id"]) ? (int)$_GET["id"] : 0;
$color = isset($_GET["color"]) ? $_GET["color"] : '';
$talle = isset($_GET["talle"]) ? $_GET["talle"] : '';

if ($id && $color && $talle) {
    $producto = (new ProductosClass())->catalogo_x_id($id);
    if ($producto && $producto->verificarStock($color, $talle)) {
        (new Carrito())->agregar_item($id, 1, $color, $talle);
        header("location: ../../index.php?sec=carrito");
    } else {
        header("location: ../../index.php?sec=id&id=$id&error=no_stock");
    }
    exit;
} else {
    header("location: ../../index.php?error=1");
    exit;
}
