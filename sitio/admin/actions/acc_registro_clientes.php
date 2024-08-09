<?php
session_start();
require_once "../../funciones/autoload.php";

// Recibir y validar datos del formulario
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$nombre_usuario = filter_input(INPUT_POST, 'nombre_usuario', FILTER_SANITIZE_STRING);
$nombre_completo = filter_input(INPUT_POST, 'nombre_completo', FILTER_SANITIZE_STRING);
$pass = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING);

if ($email && $nombre_usuario && $nombre_completo && $pass) {
    $usuario_cliente = new Clientes();
   
    // Verifico si el usuario ya existe
    if ($usuario_cliente->usuario_x_email($email)) {
        (new Alerta())->add_alerta("El email ya está en uso.", "danger");
        header("Location: ../../index.php?sec=registro");
        exit;
    }
   
    // Hashear la contraseña
    $passwordHash = password_hash($pass, PASSWORD_DEFAULT);

    // Insertar usuario en la base de datos
    $id_usuario = $usuario_cliente->insert($email, $nombre_usuario, $nombre_completo, $passwordHash);
   
    if ($id_usuario) {
        // Establecer datos de sesión (mostrar datos en el perfil del usarlo)
        $_SESSION["login"] = [
            "usuario" => $nombre_usuario,
            "id" => $id_usuario,
            "email" => $email,
            "nombre_completo" => $nombre_completo
        ];

        header("Location: ../../index.php?sec=log_in");
        exit;
    } else {
        (new Alerta())->add_alerta("Error en el registro. Inténtalo de nuevo.", "danger");
        header("Location: ../../index.php?sec=registro");
        exit;
    }
} else {
    (new Alerta())->add_alerta("Completa todos los campos.", "warning");
    header("Location: ../../index.php?sec=registro");
    exit;
}
?>
