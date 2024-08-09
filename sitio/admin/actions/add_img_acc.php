<?php
session_start();

if (isset($_FILES['Ruta']) && $_FILES['Ruta']['error'] === UPLOAD_ERR_OK) {
    if (isset($_SESSION['nuevo_producto'])) {
        // Recupero el objeto de la sesión
        $nuevo_producto = $_SESSION['nuevo_producto'];

        // Defino el directorio donde se almacenará la imagen
        $directorio_imagenes = "../../img/";
        $archivo_imagen = basename($_FILES['Ruta']['name']);
        $ruta_imagen = $directorio_imagenes . $archivo_imagen;

        // Muevo la imagen al directorio correspondiente
        if (move_uploaded_file($_FILES['Ruta']['tmp_name'], $ruta_imagen)) {
            // Solo guardo el nombre del archivo en el objeto, no la ruta completa
            $nuevo_producto->Ruta_imagen = $archivo_imagen;

            // Guardar el objeto actualizado en la sesión
            $_SESSION['nuevo_producto'] = $nuevo_producto;

            // Redirigir a la página de agregar imagen
            header("Location: ../index.php?sec=add_productos");
            exit(); // Asegurarse de que se detenga la ejecución del script
        } else {
            echo "Error al subir la imagen.";
        }
    }
}
?>

