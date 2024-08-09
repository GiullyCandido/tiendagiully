<?php
class Clientes {
    protected $id_cliente; 
    protected $rol = 'comun'; 
    protected $email;
    protected $nombre_usuario;
    protected $nombre_completo;
    protected $password;

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
        return $this->id_cliente;
    }

    public function usuario_x_email(string $email): ?self {
        $conexion = (new Conexion())->getConexion();
        $query = "SELECT * FROM clientes WHERE email = :email";
        $stmt = $conexion->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->setFetchMode(PDO::FETCH_CLASS, self::class);
        $stmt->execute();
    
        $result = $stmt->fetch();
    
        return $result ? $result : null;
    }
    

    public function insert($email, $nombre_usuario, $nombre_completo, $passwordHash) {
        try {
            $conexion = (new Conexion())->getConexion();
    
            $query = "INSERT INTO clientes (rol, email, nombre_usuario, nombre_completo, password)
                      VALUES (:rol, :email, :nombre_usuario, :nombre_completo, :password)";
            $PDOStament = $conexion->prepare($query);
            $PDOStament->execute([
                "rol" => $this->rol,
                "email" => $email,
                "nombre_usuario" => $nombre_usuario,
                "nombre_completo" => $nombre_completo,
                "password" => $passwordHash,
            ]);
    
            return $conexion->lastInsertId(); // El id retornado es el id_cliente insertado
        } catch (PDOException $e) {
            die("Error al insertar usuario: " . $e->getMessage());
        }
    }

    public function obtenerDatosClientes() {
        $conexion = (new Conexion())->getConexion();
        $query = "
            SELECT 
                'Cliente' AS Tipo,
                rol, 
                email, 
                nombre_usuario, 
                nombre_completo 
            FROM clientes
        ";
        $stmt = $conexion->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //todos los pedidos para mostrar en el admin
    public function obtenerPedidos() {
        $conexion = (new Conexion())->getConexion();
        $query = "
            SELECT 
                c.nombre_completo AS Nombre_Cliente, 
                c.email AS Email_Cliente, 
                p.fecha AS Fecha_Pedido, 
                p.total AS Total_Pedido, 
                pr.Nombre AS Nombre_Producto,
                v.Talle,
                v.Color,
                dp.cantidad AS Cantidad_Producto,  -- Agregar esta columna
                p.id_pedido
            FROM pedidos p
            JOIN clientes c ON p.id_cliente = c.id_cliente
            JOIN detalles_pedidos dp ON p.id_pedido = dp.id_pedido
            JOIN prod_var pv ON dp.ID_prod_var = pv.ID_prod_var
            JOIN productos pr ON pv.ID_producto = pr.ID_Producto
            JOIN variedad v ON pv.ID_Variedad = v.ID_Variedad
            ORDER BY p.id_pedido, p.fecha DESC
        ";
        $stmt = $conexion->prepare($query);
        $stmt->execute();
        $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        // Agrupar datos por id_pedido
        $pedidos = [];
        foreach ($datos as $dato) {
            $id_pedido = $dato['id_pedido'];
            if (!isset($pedidos[$id_pedido])) {
                $pedidos[$id_pedido] = [
                    'Nombre_Cliente' => $dato['Nombre_Cliente'],
                    'Email_Cliente' => $dato['Email_Cliente'],
                    'Fecha_Pedido' => $dato['Fecha_Pedido'],
                    'Total_Pedido' => $dato['Total_Pedido'],
                    'Productos' => []
                ];
            }
            $pedidos[$id_pedido]['Productos'][] = [
                'Nombre_Producto' => $dato['Nombre_Producto'],
                'Talle' => $dato['Talle'],
                'Color' => $dato['Color'],
                'Cantidad' => $dato['Cantidad_Producto']  // Agregar la cantidad
            ];
        }
    
        return $pedidos;
    }
    

    //pedidos de un cliente en especifico para seccion de "mi perfil"
    public function obtenerPedidosCliente(int $id_cliente) {
        $conexion = (new Conexion())->getConexion();
        $query = "
            SELECT 
                p.id_pedido AS ID_Pedido,
                p.fecha AS Fecha_Pedido,
                p.total AS Total_Pedido,
                pr.Nombre AS Nombre_Producto,
                v.Talle,
                v.Color,
                dp.cantidad AS Cantidad_Producto
            FROM pedidos p
            JOIN detalles_pedidos dp ON p.id_pedido = dp.id_pedido
            JOIN prod_var pv ON dp.ID_prod_var = pv.ID_prod_var
            JOIN productos pr ON pv.ID_producto = pr.ID_Producto
            JOIN variedad v ON pv.ID_Variedad = v.ID_Variedad
            WHERE p.id_cliente = :id_cliente
            ORDER BY p.fecha DESC
        ";
        $stmt = $conexion->prepare($query);
        $stmt->execute(['id_cliente' => $id_cliente]);
        $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        // Agrupar datos por id_pedido
        $pedidos = [];
        foreach ($datos as $dato) {
            $id_pedido = $dato['ID_Pedido'];
            if (!isset($pedidos[$id_pedido])) {
                $pedidos[$id_pedido] = [
                    'Fecha_Pedido' => $dato['Fecha_Pedido'],
                    'Total_Pedido' => $dato['Total_Pedido'],
                    'Productos' => []
                ];
            }
            $pedidos[$id_pedido]['Productos'][] = [
                'Nombre_Producto' => $dato['Nombre_Producto'],
                'Talle' => $dato['Talle'],
                'Color' => $dato['Color'],
                'Cantidad' => $dato['Cantidad_Producto']
            ];
        }
    
        return $pedidos;
    }
       
    
    

}
?>
