<?php

require("./conexion/conexion.php");

class usuario{

    private $id_usr;
    private $nombre;
    private $email;
    private $pass;
    private $tipo;

    public static function datos_usuario($correo){

        $conectar = conexion::abrir_conexion();

        try{

            $result = $conectar->query("Select * from usuarios where email = '$correo'");
            $fila = $result->fetch_assoc();

        } catch(exception $e){

            die("Error: " . $e->getMessage());

        }

        $conectar = conexion::cerrar_conexion();

        return $fila;

    }

    public static function insertar_usuario($nombre,$email,$pass){

        $conectar = conexion::abrir_conexion();

        try{

            $conectar->query("Insert into usuarios (nombre,email,pass,tipo) values ('$nombre','$email','$pass','0')");

        } catch(exception $e){

            die("Error: " . $e->getMessage());

        }

        $conectar = conexion::cerrar_conexion();

    }

    public static function existe_correo($email){

        $conectar = conexion::abrir_conexion();

        try{

            $result = $conectar->query("Select * from usuarios where email = '$email'");
            $result = $result->num_rows;

            if($result >= 1){

                $conectar = conexion::cerrar_conexion();
                return true;

            } else {

                $conectar = conexion::cerrar_conexion();
                return false;

            }

        } catch(exception $e){

            die("Error: " . $e->getMessage());

        }

    }

    public static function comprobamos_contraseña_correo($correo,$contraseña){

        $conectar = conexion::abrir_conexion();

        try{

            $result = $conectar->query("Select email,pass from usuarios where email = '$correo'");
            $fila = $result->fetch_assoc();

            if($fila["email"] == $correo && $fila["pass"] == $contraseña){

                $conectar = conexion::cerrar_conexion();
                return true;

            } else {

                $conectar = conexion::cerrar_conexion();
                return false;                

            }

        } catch(exception $e){

            die("Error: " . $e->getMessage());

        }

    }

    public static function obtener_nombre_por_id($id){

        $conectar = conexion::abrir_conexion();

        try{

            $result = $conectar->query("Select distinct nombre from usuarios inner join comentarios on usuarios.id_usr = comentarios.id_usr where comentarios.id_usr = $id");
            $fila = $result->fetch_assoc();
            $nombre = $fila["nombre"];

        } catch(exception $e){

            die("Error: " . $e->getMessade());

        }

        $conectar = conexion::cerrar_conexion();

        return $nombre;

    }

    public static function cambio_nombre($id,$nombre){

        $conectar = conexion::abrir_conexion();

        try{

            $result = $conectar->query("Update usuarios set nombre = '$nombre' where id_usr = $id");

        } catch (exception $e){

            die("Error: " . $e->getMessage());

        }

        $conectar = conexion::cerrar_conexion();

    }

    public static function cambio_contraseña($id,$contraseña){

        $conectar = conexion::abrir_conexion();

        try{

            $result = $conectar->query("Update usuarios set pass = '$contraseña' where id_usr = $id");

        } catch (exception $e){

            die("Error: " . $e->getMessage());

        }

        $conectar = conexion::cerrar_conexion();

    }

}

?>