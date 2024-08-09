
<?php 
session_start();

if (!empty($_POST['Texto_descripcion'])) {
    if (isset($_SESSION['nuevo_producto'])) {
        // Recupero el objeto de la sesión
        $nuevo_producto = $_SESSION['nuevo_producto'];

        // Agrego la descripción al objeto
        $descripcion = htmlspecialchars($_POST['Texto_descripcion'], ENT_QUOTES, 'UTF-8');
        $nuevo_producto->Texto_descripcion = $descripcion;

        // Guardar el objeto actualizado en la sesión
        $_SESSION['nuevo_producto'] = $nuevo_producto;

        //Imprimir el contenido del objeto $nuevo_producto
        echo "<pre>";
        print_r($nuevo_producto);
        echo "</pre>";

          // Redirigir a la página
        header("Location: ../index.php?sec=add_img");
        exit(); // Asegurarse de que se detenga la ejecución del script
    }}

echo "<pre>";
print_r($_POST);
echo "</pre>";
?>
