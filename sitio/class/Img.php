<?php
class Img {
    protected $ID_Img;
    protected $Ruta;
    protected $Alt_img;

    /**
     * Get the value of ID_Img
     */
    public function getIDImg()
    {
        return $this->ID_Img;
    }

    /**
     * Set the value of ID_Img
     */
    public function setIDImg($ID_Img): self
    {
        $this->ID_Img = $ID_Img;
        return $this;
    }

    /**
     * Get the value of Ruta
     */
    public function getRuta()
    {
        return $this->Ruta;
    }

    /**
     * Set the value of Ruta
     */
    public function setRuta($Ruta): self
    {
        $this->Ruta = $Ruta;
        return $this;
    }

    /**
     * Get the value of Alt_img
     */
    public function getAltImg()
    {
        return $this->Alt_img;
    }

    /**
     * Set the value of Alt_img
     */
    public function setAltImg($Alt_img): self
    {
        $this->Alt_img = $Alt_img;
        return $this;
    }


   // Función estática para obtener un objeto Img basado en su ID
   public static function get_x_id($ID_Img) {
    $conexion = (new Conexion())->getConexion();
    $query = "SELECT * FROM img WHERE ID_Img = :ID_Img";
    $PDOStatement = $conexion->prepare($query);
    $PDOStatement->bindParam(':ID_Img', $ID_Img, PDO::PARAM_INT);
    $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
    $PDOStatement->execute();
    $resultado = $PDOStatement->fetch();
    return $resultado ? $resultado : null;
}

public function catalogo_completo(): array {
    $conexion = (new Conexion())->getConexion();
    $query = "SELECT * FROM img";
    $PDOStatement = $conexion->prepare($query);
    $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
    $PDOStatement->execute();
    return $PDOStatement->fetchAll();
}


}   
?>
