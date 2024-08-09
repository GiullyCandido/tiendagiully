<?php
require_once "../../funciones/autoload.php";

// Verificar si se reciben los datos POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST["email"];
    $pass = $_POST["pass"];
    
    // Usar la clase Autenticacion para manejar el inicio de sesión
    $autenticacion = new Autenticacion();
    if ($autenticacion->log_in($email, $pass)) {
        // Redirigir a la página principal del admin
        header("Location: ../index.php");
        exit;
    } else {
        // Si las credenciales no son válidas, mostrar mensaje de error
        (new Alerta())->add_alerta("Credenciales incorrectas. Inténtalo de nuevo.", "danger");
        header("Location: ../index.php?sec=login");
        exit;
    }
} else {
    // Si no es un método POST, redirigir a la página de login
    header("Location: ../index.php?sec=login");
    exit;
}
?>
