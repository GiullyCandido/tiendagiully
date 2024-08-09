<?php
session_start();

if (!empty($_POST['Stock'])) {
    if (isset($_SESSION['nuevo_producto'])) {
        $nuevo_producto = $_SESSION['nuevo_producto'];

        $nuevo_producto->Stock = htmlspecialchars($_POST['Stock'], ENT_QUOTES, 'UTF-8');

        $_SESSION['nuevo_producto'] = $nuevo_producto;

        echo "<pre>";
        print_r($nuevo_producto);
        echo "</pre>";

       // Redirigir a la página de acc_final.php
       header("Location: acc_final.php");
       exit(); // Asegurarse de que se detenga la ejecución del script 
    }
}

echo "<pre>";
print_r($_POST);
echo "</pre>";
?>
