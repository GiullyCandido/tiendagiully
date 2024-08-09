<?php
require_once "../../funciones/autoload.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST["email"];
    $pass = $_POST["pass"];

    $autenticacion = new Autenticacion();
    
    if ($autenticacion->loginCliente($email, $pass)) {
        header("Location: ../../index.php?sec=log_in");
        exit;
    } else {
        (new Alerta())->add_alerta("Credenciales incorrectas. Inténtalo de nuevo.", "danger");
        header("Location: ../../index.php?sec=log_in");
        exit;
    }
} else {
    header("Location: ../../index.php?sec=log_in");
    exit;
}
?>

