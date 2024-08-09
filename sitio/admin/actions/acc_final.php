<?php
session_start();
require_once "../../funciones/autoload.php";

if (isset($_SESSION['nuevo_producto'])) {
    $nuevo_producto = $_SESSION['nuevo_producto'];
    $productos = new ProductosClass();

    try {
        // Insertar el nuevo producto usando la función de la clase Productos
        $productos->insertarNuevoProducto($nuevo_producto);

        // Limpiar sesión
        unset($_SESSION['nuevo_producto']);

        // Redirigir a la página de administración de productos
        header("Location: ../index.php?sec=admin_productos&success=1");
        exit; // Asegura que el script se detiene después de la redirección

    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "No hay datos para insertar.";
}
?>
