<?php

// Creación de una clase llamada Conexion
class Conexion {

    // Definición de constantes para los parámetros de conexión
    const DB_SERVER = "localhost:3306";  // Servidor y puerto de la base de datos
    const DB_USER = "root";              // Usuario administrador
    const DB_PASS = "";                  // Contraseña del usuario
    const DB_NAME = "dw3_candido-machdo_giully";     // Nombre de la base de datos
    const DB_DNS = "mysql:host=".self::DB_SERVER.";dbname=".self::DB_NAME.";charset=utf8mb4";  // Cadena de conexión

    protected PDO $db;  // Declaración de una propiedad protegida que almacenará un objeto PDO

    // Constructor de la clase
    public function __construct() {
        // Intento de crear una nueva instancia de PDO con los parámetros definidos
        try {
            $this->db = new PDO(self::DB_DNS, self::DB_USER, self::DB_PASS);
        } catch (Exception $e) {
            die("No fue posible conectarse");  // Mensaje de error si la conexión falla
        }
    }

    public function getConexion(){
        return $this->db;
    }
}


?>

