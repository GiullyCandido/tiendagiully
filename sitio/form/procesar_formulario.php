<?php
$personas = [];
// Verificar si se envio el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $telefono = $_POST["telefono"];
    $mensaje = $_POST["mensaje"];
    // Creo un array asociativo con los datos de la persona actual
    $persona = array(
        'nombre' => $nombre,
        'email' => $email,
        'telefono' => $telefono,
        'mensaje' => $mensaje
    );
    // Agrego la persona al array de personas
    $personas[] = $persona;
    //imprimir array para chequear si funciona
    echo "<h2>Array de personas:</h2>";
    echo "<pre>";
    print_r($personas);
    echo "</pre>";

}
?>
