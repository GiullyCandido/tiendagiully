<?php 
//session_start(): es una función que inicia una sesión o reanuda la sesión actualmente iniciada en el servidor. Las sesiones en PHP son una forma de mantener datos a través de múltiples páginas o interacciones del usuario con el sitio web.
session_start();

if ((!empty($_POST['ID_Marca']) && is_numeric($_POST['ID_Marca'])) || !empty($_POST['Nombre'])) {
    // Crear el objeto "nuevo producto"
    // stdClass es una clase interna predefinida que es utilizada como un objeto genérico cuando se necesita crear un objeto pero no se requiere una estructura de clase específica.
    $nuevo_producto = new stdClass();

    if (!empty($_POST['ID_Marca']) && is_numeric($_POST['ID_Marca'])) {
        $ID_marca = htmlspecialchars($_POST['ID_Marca'], ENT_QUOTES, 'UTF-8');
        $nuevo_producto->ID_Marca = $ID_marca;
    } elseif (!empty($_POST['Nombre'])) {
        $nombre_nueva_marca = htmlspecialchars($_POST['Nombre'], ENT_QUOTES, 'UTF-8');
        $nuevo_producto->Nombre = $nombre_nueva_marca;
    }
    // Guardar el objeto en la sesión
    $_SESSION['nuevo_producto'] = $nuevo_producto;

    // Imprimir el contenido del objeto $nuevo_producto
    // echo "<pre>";
    // print_r($nuevo_producto);
    // echo "</pre>";

     // Redirigir a la página de agregar descripción
     header("Location: ../index.php?sec=add_descripcion");
     exit(); // Asegurarse de que se detenga la ejecución del script
}

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
?>
