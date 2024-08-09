<?php 
class Descripcion{
    protected $ID_Descripcion;
    protected $Texto_Descripcion;


    /**
     * Get the value of ID_Descripcion
     */
    public function getIDDescripcion()
    {
        return $this->ID_Descripcion;
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
     * Get the value of Texto_Descripcion
     */
    public function getTextoDescripcion()
    {
        return $this->Texto_Descripcion;
    }

    /**
     * Set the value of Texto_Descripcion
     */
    public function setTextoDescripcion($Texto_Descripcion): self
    {
        $this->Texto_Descripcion = $Texto_Descripcion;

        return $this;
    }

    public function get_x_id(int $ID_Descripcion) :? Descripcion{
        $conexion = ( new Conexion() )->getConexion();
        $query = "SELECT * FROM descripcion WHERE ID_Descripcion = $ID_Descripcion";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
            $PDOStatement->execute();
            $resultado = $PDOStatement->fetch();
            return isset($resultado) ? $resultado : null;
    }

    public function catalogo_completo(): array {
        $conexion = (new Conexion())->getConexion();
        $query = "SELECT * FROM descripcion";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute();
        return $PDOStatement->fetchAll();
    }
        


}

?>