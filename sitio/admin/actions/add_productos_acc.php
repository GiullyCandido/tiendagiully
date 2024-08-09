<?php 
session_start();

if (!empty($_POST['Nombre']) && !empty($_POST['Precio']) && !empty($_POST['Tipo'])) {
    if (isset($_SESSION['nuevo_producto'])) {
        // Recupero el objeto de la sesión
        $nuevo_producto = $_SESSION['nuevo_producto'];

        // Agrego la información al objeto
        $nuevo_producto->NombreProducto = htmlspecialchars($_POST['Nombre'], ENT_QUOTES, 'UTF-8');
        $nuevo_producto->Precio = htmlspecialchars($_POST['Precio'], ENT_QUOTES, 'UTF-8');
        $nuevo_producto->Tipo = htmlspecialchars($_POST['Tipo'], ENT_QUOTES, 'UTF-8');

        // Guardar el objeto actualizado en la sesión
        $_SESSION['nuevo_producto'] = $nuevo_producto;

        // Imprimir el contenido del objeto $nuevo_producto 
        echo "<pre>";
        print_r($nuevo_producto);
        echo "</pre>";

        // Redirigir a la página de variedad
        header("Location: ../index.php?sec=add_variedad");
        exit(); // Asegurarse de que se detenga la ejecución del script
    }}

echo "<pre>";
print_r($_POST);
echo "</pre>";
?>
