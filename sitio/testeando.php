<?php
require_once "class/conexion.php";
require_once "funciones/autoload.php";
require_once "class/ProductosClass.php";

// $conexion = (new Conexion())->getConexion();
//     $query = "INSERT INTO marca VALUES (NULL, '$marca')";
//     $PDOStatement = $conexion->prepare($query);
//     $PDOStatement->execute();
//     return $PDOStatement->fetchAll();

echo "<pre>";
print_r($_SESSION['carrito']);
echo "</pre>";

echo "<pre>";
        print_r($_SESSION);
echo "</pre>";


    $password = "giully"; // La contraseña que deseas hashear

    // Generar el hash de la contraseña
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    
    echo "Hash de la contraseña: " . $passwordHash;

?>

