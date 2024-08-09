<?php
//MOLDE DE TODOS LOS PRODUCTOS
class ProductosClass {
    //COLUMNAS DE MI TABLA productos
    public $ID_producto;
    public $Nombre;
    public $Precio;
    public $ID_Marca;
    public $ID_Descripcion;
    public $Tipo;
    public $ID_Img;


    public function catalogo_completo(){
       $catalogo = [];
        
        //instancio la class Conexion y llamo el metodo getConexion del nuevo objeto para obtener una conexión a la base de datos.
        $conexion = new Conexion();
        $db = $conexion->getConexion();

        //hago una consulta a la base de datos (query)
        $query = "SELECT * FROM productos";

        //Inicio la preparacion de la consulta a la DB(data base/base de datos),
        //El resultado es un objeto PDOStatement, que representa la consulta preparada.
        $PDOStatement = $db->prepare($query);

        //Configuro el modo en que se devuelven los resultados de la consulta. (setFetchMode())
        //PDO::FETCH_CLASS: Es una constante que indica que queremos que los resultados se devuelvan como una instancia de una clase(objeto).
        //  ProductoClass::class: indica cual clase tiene que instanciar
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, ProductosClass::class);
        //ejecuto la consulta
        $PDOStatement->execute();
        // $resultadoMolde = $PDOStatement->fetchAll();
        while ($producto = $PDOStatement->fetch()) {
            $resultadoMolde[] = $producto;
        }
       return $resultadoMolde;
    }

    function catalogo_x_tipoDeproducto($tipodeproducto){
        $productos = $this->catalogo_completo();
        $tipoDeProductos = [];

        foreach($productos as $producto) {
            if($producto->Tipo == $tipodeproducto) {
                $tipoDeProductos[] = $producto;
            }
        }

        return $tipoDeProductos;
    }

    public function catalogo_x_id(int $id): ?ProductosClass
    {
        $productos = $this->catalogo_completo();

        foreach ($productos as $producto) {
            if ($producto->ID_producto == $id) {
                return $producto;
            }
        }

        return null;
    }

     
    public function obtenerVariedades() {
        $conexion = new Conexion();
        $db = $conexion->getConexion();
        $query = "
        SELECT variedad.Color, variedad.Talle 
        FROM prod_var
        JOIN variedad ON prod_var.ID_Variedad = variedad.ID_Variedad
        WHERE prod_var.ID_Producto = :id_producto
         ";


        $PDOStatement = $db->prepare($query);
        $PDOStatement->bindParam(':id_producto', $this->ID_producto, PDO::PARAM_INT);
        $PDOStatement->execute();

        $variedades = $PDOStatement->fetchAll(PDO::FETCH_ASSOC);

        return $variedades;
    }

    public function verificarStock($color, $talle) {
        $conexion = new Conexion();
        $db = $conexion->getConexion();
    
        $query = "
            SELECT stock
            FROM prod_var
            JOIN variedad ON prod_var.ID_Variedad = variedad.ID_Variedad
            WHERE prod_var.ID_Producto = :id_producto AND variedad.Color = :color AND variedad.Talle = :talle
        ";
    
        $PDOStatement = $db->prepare($query);
        $PDOStatement->bindParam(':id_producto', $this->ID_producto, PDO::PARAM_INT);
        $PDOStatement->bindParam(':color', $color, PDO::PARAM_STR);
        $PDOStatement->bindParam(':talle', $talle, PDO::PARAM_STR);
        $PDOStatement->execute();
    
        $result = $PDOStatement->fetch(PDO::FETCH_ASSOC);
    
        if ($result) {
            return $result['stock'] > 0;
        } else {
            return false;
        }
    }
    
    public function getIdVariedad($color, $talle) {
        $conexion = new Conexion();
        $db = $conexion->getConexion();
        $query = "
            SELECT ID_Variedad
            FROM variedad
            WHERE Color = :color AND Talle = :talle
        ";
    
        $PDOStatement = $db->prepare($query);
        $PDOStatement->bindParam(':color', $color, PDO::PARAM_STR);
        $PDOStatement->bindParam(':talle', $talle, PDO::PARAM_STR);
        $PDOStatement->execute();
    
        $result = $PDOStatement->fetch(PDO::FETCH_ASSOC);
    
        return $result ? $result['ID_Variedad'] : null;
    }
    

    /**
     * Get the value of ID_producto
     */
    public function getIDProducto()
    {
        return $this->ID_producto;
    }

    /**
     * Set the value of ID_producto
     */
    public function setIDProducto($ID_producto): self
    {
        $this->ID_producto = $ID_producto;

        return $this;
    }

    /**
     * Get the value of Nombre
     */
    public function getNombre()
    {
        return $this->Nombre;
    }

    /**
     * Set the value of Nombre
     */
    public function setNombre($Nombre): self
    {
        $this->Nombre = $Nombre;

        return $this;
    }

    /**
     * Get the value of Precio
     */
    public function getPrecio()
    {
        return $this->Precio;
    }

    /**
     * Set the value of Precio
     */
    public function setPrecio($Precio): self
    {
        $this->Precio = $Precio;

        return $this;
    }

    /**
     * Get the value of ID_Marca
     */
    public function getIDMarca()
    {
        //return $this->ID_Marca;
        $marca = (new Marca())->get_x_id($this->ID_Marca);
        return $marca->getNombre();

     
    }

    /**
     * Set the value of ID_Marca
     */
    public function setIDMarca($ID_Marca): self
    {
        $this->ID_Marca = $ID_Marca;

        return $this;
    }

    /**
     * Funcion que instancia la clase descripcion y trae los textos de la descripcion
     */
    public function getIDDescripcion()
    {
        $descripcion = (new Descripcion())->get_x_id($this->ID_Descripcion);
        return $descripcion->getTextoDescripcion();
    }


    /**
     * Set the value of ID_Descripcion
     */
    public function setIDDescripcion($ID_Descripcion): self
    {
        $this->ID_Descripcion = $ID_Descripcion;

        return $this;
    }

    /**
     * Get the value of Tipo
     */
    public function getTipo()
    {
        return $this->Tipo;
    }

    /**
     * Set the value of Tipo
     */
    public function setTipo($Tipo): self
    {
        $this->Tipo = $Tipo;

        return $this;
    }

    /**
     * Get the value of ID_Img
     */
    public function getIDImg() {
        $img = Img::get_x_id($this->ID_Img);
        if ($img !== null) {
            return $img->getRuta();
        } else {
            throw new Exception('No se encontró la imagen con el ID proporcionado.');
        }
    }

    /**
     * Set the value of ID_Img
     */
    public function setIDImg($ID_Img): self
    {
        $this->ID_Img = $ID_Img;

        return $this;
    }
    //insertar producto - ADMIN
    public function insertarNuevoProducto($nuevo_producto) {
        $conexion = (new Conexion())->getConexion();

        try {
            // Iniciar transacción
            $conexion->beginTransaction();

            // Insertar marca si es nueva
            if (isset($nuevo_producto->Nombre)) {
                $query = "INSERT INTO marca (Nombre) VALUES (:nombre)";
                $stmt = $conexion->prepare($query);
                $stmt->bindParam(':nombre', $nuevo_producto->Nombre);
                $stmt->execute();
                $nuevo_producto->ID_Marca = $conexion->lastInsertId();
            } else {
                $nuevo_producto->ID_Marca = str_replace('Marca existente con ID: ', '', $nuevo_producto->ID_Marca);
            }

            // Insertar descripción
            $query = "INSERT INTO descripcion (Texto_Descripcion) VALUES (:texto)";
            $stmt = $conexion->prepare($query);
            $stmt->bindParam(':texto', $nuevo_producto->Texto_descripcion);
            $stmt->execute();
            $nuevo_producto->ID_Descripcion = $conexion->lastInsertId();

            // Insertar imagen
            $query = "INSERT INTO img (Ruta, Alt_img) VALUES (:ruta, :alt)";
            $stmt = $conexion->prepare($query);
            $stmt->bindParam(':ruta', $nuevo_producto->Ruta_imagen);
            $stmt->bindParam(':alt', $nuevo_producto->NombreProducto);
            $stmt->execute();
            $nuevo_producto->ID_Img = $conexion->lastInsertId();

            // Insertar producto
            $query = "INSERT INTO productos (Nombre, Precio, ID_Marca, ID_Descripcion, Tipo, ID_Img) VALUES (:nombre, :precio, :id_marca, :id_descripcion, :tipo, :id_img)";
            $stmt = $conexion->prepare($query);
            $stmt->bindParam(':nombre', $nuevo_producto->NombreProducto);
            $stmt->bindParam(':precio', $nuevo_producto->Precio);
            $stmt->bindParam(':id_marca', $nuevo_producto->ID_Marca);
            $stmt->bindParam(':id_descripcion', $nuevo_producto->ID_Descripcion);
            $stmt->bindParam(':tipo', $nuevo_producto->Tipo);
            $stmt->bindParam(':id_img', $nuevo_producto->ID_Img);
            $stmt->execute();
            $nuevo_producto->ID_Producto = $conexion->lastInsertId();

            // Insertar producto y variedad en prod_var
            $query = "INSERT INTO prod_var (ID_Producto, ID_Variedad, Stock) VALUES (:id_producto, :id_variedad, :stock)";
            $stmt = $conexion->prepare($query);
            $stmt->bindParam(':id_producto', $nuevo_producto->ID_Producto);
            $stmt->bindParam(':id_variedad', $nuevo_producto->ID_Variedad);
            $stmt->bindParam(':stock', $nuevo_producto->Stock);
            $stmt->execute();

            // Confirmar transacción
            $conexion->commit();

            return true;

        } catch (Exception $e) {
            // Revertir transacción en caso de error
            $conexion->rollBack();
            throw new Exception("Error al insertar el nuevo producto: " . $e->getMessage());
        }
    }
}

?>

