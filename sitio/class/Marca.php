<?php
    class Marca{
        protected $ID_Marca;
        protected $Nombre;

        /**
         * Get the value of ID_Marca
         */
        public function getIDMarca()
        {
                return $this->ID_Marca;
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

        public function get_x_id(int $ID_Marca) :? Marca{
            $conexion = ( new Conexion() )->getConexion();
            $query = "SELECT * FROM marca WHERE ID_Marca = $ID_Marca";
            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
                $PDOStatement->execute();
                $resultado = $PDOStatement->fetch();
                return isset($resultado) ? $resultado : null;
        }

        public function catalogo_completo() : array {
                $conexion = (new Conexion())->getConexion();
                $query = "SELECT * FROM marca";
                $PDOStatement = $conexion->prepare($query);
                $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
                $PDOStatement->execute();
                return $PDOStatement->fetchAll();
        }


         public function insert($marca){
                $conexion = (new Conexion())->getConexion();
                $query = "INSERT INTO marca VALUES (NULL, '$marca')";
                $PDOStatement = $conexion->prepare($query);
                $PDOStatement->execute();
                //return $PDOStatement->fetchAll();
        }
    }

    
    

?>