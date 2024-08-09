<?php
session_start();

if (!empty($_POST['Talle']) && !empty($_POST['Color'])) {
    if (isset($_SESSION['nuevo_producto'])) {
        $nuevo_producto = $_SESSION['nuevo_producto'];
        $talle = htmlspecialchars($_POST['Talle'], ENT_QUOTES, 'UTF-8');
        $color = htmlspecialchars($_POST['Color'], ENT_QUOTES, 'UTF-8');

        // Definir el mapeo de combinaciones a ID_Variedad
        $variedades = [
            'Único' => ['Negro' => 1, 'Blanco' => 2],
            '38' => ['Negro' => 3, 'Blanco' => 4],
            '37' => ['Negro' => 5, 'Blanco' => 6],
            'M' => ['Negro' => 7, 'Blanco' => 8],
            'S' => ['Negro' => 9, 'Blanco' => 10],
        ];

        // Obtener ID_Variedad correspondiente
        if (isset($variedades[$talle][$color])) {
            $id_variedad = $variedades[$talle][$color];
            $nuevo_producto->ID_Variedad = $id_variedad;

            // Guardar el objeto actualizado en la sesión
            $_SESSION['nuevo_producto'] = $nuevo_producto;

            // Redirigir a la página de agregar stock
            header("Location: ../index.php?sec=add_prod_var");
            exit();
        } else {
            echo "La combinación de talle y color no es válida.";
        }
    }
}
?>



