<?php
class Variedad {
    private $ID_Variedad;
    private $Talle;
    private $Color;

    public function getIDVariedad() {
        return $this->ID_Variedad;
    }

    public function getTalle() {
        return $this->Talle;
    }

    public function getColor() {
        return $this->Color;
    }

    public function setIDVariedad($id_variedad) {
        $this->ID_Variedad = $id_variedad;
        return $this;
    }

    public function setTalle($talle) {
        $this->Talle = $talle;
        return $this;
    }

    public function setColor($color) {
        $this->Color = $color;
        return $this;
    }

    public function catalogo_completo() {
        $conexion = (new Conexion())->getConexion();
        $query = "SELECT * FROM variedad";
        $PDOStatement = $conexion->query($query);
        $variedades = [];

        while ($row = $PDOStatement->fetch(PDO::FETCH_ASSOC)) {
            $variedad = new Variedad();
            $variedad->setIDVariedad($row['ID_Variedad'])
                     ->setTalle($row['Talle'])
                     ->setColor($row['Color']);
            $variedades[] = $variedad;
        }
        return $variedades;
    }
}
?>
