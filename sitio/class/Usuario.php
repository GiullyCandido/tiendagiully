<?php
class Usuario {
    protected $id;
    protected $email;
    protected $nombre_usuario;
    protected $nombre_completo;
    protected $password;
    protected $roles;

    public function getEmail() {
        return $this->email;
    }

    public function getNombre_usuario() {
        return $this->nombre_usuario;
    }

    public function getNombre_completo() {
        return $this->nombre_completo;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getId() {
        return $this->id;
    }

    public function usuario_x_email(string $email): ?self {
        $conexion = (new Conexion())->getConexion();
        $query = "SELECT * FROM usuarios WHERE email = :email";
        $PDOStament = $conexion->prepare($query);
        $PDOStament->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStament->execute(["email" => $email]);

        $result = $PDOStament->fetch();

        return $result ? $result : null;
    }

    public function getRoles() {
        return $this->roles;
    }

    public function insert($email, $nombre_usuario, $nombre_completo, $passwordHash) {
        try {
            $conexion = (new Conexion())->getConexion();
            $roles = 'superadmin'; // rol por defecto como superadmin

            $query = "INSERT INTO usuarios (email, nombre_usuario, nombre_completo, password, roles) 
                      VALUES (:email, :nombre_usuario, :nombre_completo, :password, :roles)";
            $PDOStament = $conexion->prepare($query);
            $PDOStament->execute([
                "email" => $email,
                "nombre_usuario" => $nombre_usuario,
                "nombre_completo" => $nombre_completo,
                "password" => $passwordHash,
                "roles" => $roles
            ]);

            return $conexion->lastInsertId();
        } catch (PDOException $e) {
            die("Error al insertar usuario: " . $e->getMessage());
        }
    }

    public function obtenerDatosUsuarios() {
        $conexion = (new Conexion())->getConexion();
        $query = "
            SELECT 
                'Usuario' AS Tipo,
                roles AS rol, 
                email, 
                nombre_usuario, 
                nombre_completo 
            FROM usuarios
        ";
        $stmt = $conexion->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
?>
