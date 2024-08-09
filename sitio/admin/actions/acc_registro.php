<?php
require_once "../../funciones/autoload.php";

// Recibir y validar datos del formulario
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$nombre_usuario = filter_input(INPUT_POST, 'nombre_usuario', FILTER_SANITIZE_STRING);
$nombre_completo = filter_input(INPUT_POST, 'nombre_completo', FILTER_SANITIZE_STRING);
$pass = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING);

if ($email && $nombre_usuario && $nombre_completo && $pass) {
    $usuario = new Usuario();
    
    // Verifico si el usuario ya existe
    if ($usuario->usuario_x_email($email)) {
        (new Alerta())->add_alerta("El email ya está en uso.", "danger");
        header("Location: ../index.php?sec=registro");
        exit;
    }
    
    // Hashear la contraseña
    $passwordHash = password_hash($pass, PASSWORD_DEFAULT);

    // Insertar usuario en la base de datos
    $id_usuario = $usuario->insert($email, $nombre_usuario, $nombre_completo, $passwordHash);
    
    if ($id_usuario) {
        (new Alerta())->add_alerta("Registro exitoso. Puedes iniciar sesión.", "success");
        header("Location: ../index.php?sec=login");
        exit;
    } else {
        (new Alerta())->add_alerta("Error al registrar usuario. Por favor intenta nuevamente.", "danger");
        header("Location: ../index.php?sec=registro");
        exit;
    }
} else {
    (new Alerta())->add_alerta("Por favor, completa todos los campos.", "danger");
    header("Location: ../index.php?sec=registro");
    exit;
}
?>
