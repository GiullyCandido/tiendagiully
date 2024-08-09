<?php
class Autenticacion{
    public function log_in($email, $pass){
        $usuario = (new Usuario())->usuario_x_email($email);
        if(isset($usuario)){
            if(password_verify($pass, $usuario->getPassword())){
                $datosLogin["usuario"] = $usuario->getNombre_usuario();
                $datosLogin["rol"] = $usuario->getRoles();
                $datosLogin["id"] = $usuario->getId();
                $_SESSION["login"] = $datosLogin;
                return true;
            }
        }
        return false;
    }

    public function log_out() {
        // Eliminar todos los datos de la sesión
        session_unset();
        // Destruir la sesión
        session_destroy();
    }


    public function verify(){
        if(isset($_SESSION["login"]) 
            && ($_SESSION["login"]["rol"] == "admin" || $_SESSION["login"]["rol"] == "superadmin") 
        ){
            return true;
        }else{
            header("Location: index.php?sec=login");
        }
    }

    //Clientes:
    public function loginCliente($email, $password) {
        $cliente = (new Clientes())->usuario_x_email($email);
        
        if ($cliente && password_verify($password, $cliente->getPassword())) {
            $datosLogin = [
                "usuario" => $cliente->getNombre_usuario(),
                "id" => $cliente->getId(),
                "email" => $cliente->getEmail(),
                "nombre_completo" => $cliente->getNombre_completo()
            ];
            
            $_SESSION["login"] = $datosLogin;
            return true;
        } else {
            return false;
        }
    }

   

}
?>