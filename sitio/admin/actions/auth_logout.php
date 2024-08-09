<?php
require_once "../../funciones/autoload.php";
// Crear una instancia de la class
$autenticacion = new Autenticacion();
// Llamar al método logoutCliente
$autenticacion->log_out();
header("Location: ../index.php");
?>