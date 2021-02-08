<?php

require("usuario.php");

class comentario{

    public static function mostrar_comentarios($empezar_desde,$filas_por_pagina){

        $conectar = conexion::abrir_conexion();

        try{

            $result = $conectar->query("Select * from comentarios order by fecha desc limit $empezar_desde,$filas_por_pagina");

            while($fila = $result->fetch_assoc()){

                if(isset($_SESSION["login"])){
                    $id_usuario = $_SESSION["login"]["id"];
                } else {
                    $id_usuario = -1;
                }

                $id_usuario_comentario = $fila["id_usr"];
                $nombre = usuario::obtener_nombre_por_id($id_usuario_comentario);
                $texto = $fila["comentario"];
                $fecha = $fila["fecha"];
                $id_comentario = $fila["id"];

                echo "<article>";
                echo "<h4>$nombre</h4>";
                echo "<p>$texto</p>";
                echo "<hr>";
                echo "<form action=" . $_SERVER["PHP_SELF"] . " method='post'>";
                echo "<span class='fecha'><span class='gris'>$fecha</span>";
                if($id_usuario_comentario == $id_usuario){
                    echo "<input type='hidden' name='id' value='$id_comentario' >";
                    echo "<input type='submit' name='delete' value='Borrar' class='delete'>";
                }
                echo "</form>";
                echo "</span>";
                echo "</article>";

            }

        } catch(exception $e){

            die("Error: " . $e->getMessage());

        }

    }

    public static function insertar_comentario($comentario,$id){

        $conectar = conexion::abrir_conexion();
        
        $fecha = getdate();
        $año = $fecha["year"];
        $mes = $fecha["mon"];
        $dia = $fecha["mday"];
        $horas = $fecha["hours"];
        $minutos = $fecha["minutes"];
        $segundos = $fecha["seconds"];
        $fecha_comentario = "$año/$mes/$dia $horas:$minutos:$segundos";

        try{

            $conectar->query("Insert into comentarios (comentario,fecha,id_usr) values ('$comentario','$fecha_comentario','$id')");

        } catch(exception $e){

            die("Error: " . $e->getMessage());

        }

        $conectar = conexion::cerrar_conexion();

    }

    public static function borrar_comentario($id){

        $conectar = conexion::abrir_conexion();

        $conectar->query("Delete from comentarios where id = $id");

        $conectar = conexion::cerrar_conexion();

    }

}

?>