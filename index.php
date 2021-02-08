<?php

        //para borrar los comentarios, si pulsamos el boton de borrar (lo pongo aquí por el css)

        if(isset($_POST["delete"])){
            $id_comentario = $_POST["id"];
            echo "<div id='emergente'>";
            echo "<form action=" . $_SERVER["PHP_SELF"] . " method='post'>";
            echo "<p>¿Estas seguro?</p>";
            echo "<input type='hidden' name='id' value='$id_comentario'>";
            echo "<p><input type='submit' name='seguroSI' value='sí'><input type='submit' name='seguro' value='no'></p>";
            echo "</form>";
            echo "</div>";
        }

        require("vista/header.php");
        require("clases/comentario.php");

        //segunda comprobación, si pulsamos que seguro que sí

        if(isset($_POST["seguroSI"])){
            $id_comentario = $_POST["id"];
            comentario::borrar_comentario($id_comentario);
            echo "<script>alert('comentario borrado');</script>";
        }

    if(isset($_GET["pagina"])){
        $pagina_actual = $_GET["pagina"];
        echo "<style>";
        echo "#pag$pagina_actual{";
        echo "border:0.5px solid rgb(80, 80, 80);";
        echo "}";
        echo "</style>";
    } else {
        echo "<style>";
        echo "#pag1{";
        echo "border:0.5px solid rgb(80, 80, 80);";
        echo "}";
        echo "</style>";
    }

?>

<style>
    #chat{
        background-color: rgb(173, 7, 7);
    }
</style>

<?php

    function validar($err,$comentario){

        if($comentario == ""){
            $err["comentario"] = "No has introducido ningún mensaje";
        } else if(strlen($comentario) >= 300){
            $err["comentario"] = "Has introducido más de 300 carácteres";
        }

        return $err;

    }

    $comentario = "";
    $err = array();

    if(isset($_POST["enviar"])){

        $comentario = $_POST["comentario"];
        
        $err = validar($err,$comentario);

        //si hemos pulsado a enviar y no hay errores entonces guardamos el comentario en la base de datos

        if(empty($err)){

            $comentario = htmlspecialchars($comentario);

            $comentario = nl2br($comentario);

            comentario::insertar_comentario($comentario,$_SESSION["login"]["id"]);

            $comentario = "";

        }

    }

?>

<section>
    <?php
        if(isset($_SESSION["login"])){
            echo "<h1>Conectado como " . $_SESSION["login"]["nombre"] . "</h1>";
        } else {
            echo "<h1>Desconectado. Haz login para chatear.</h1>";
        }
    ?>
<hr>

<?php 

    if(isset($_SESSION["login"])){
        echo "<h3>Envía un mensaje</h3>";
        echo "<form action=" . $_SERVER["PHP_SELF"] . " method='post'>";
        echo "<textarea rows='5' name='comentario'>" . $comentario . "</textarea>";
        if(isset($err["comentario"])){
            echo "<p class='red'>" . $err["comentario"] . "</p>";
        }
        echo "<input type='submit' value='Enviar' name='enviar'>";
        echo "</form>";
        echo "<hr>";
    }

?>

<h3>Últimos comentarios (5 por página)</h3>

<?php

    //------------------------------------------------------------paginación

    $filas_por_pagina = 5;

    if(isset($_GET["pagina"])){

        if($_GET["pagina"] == 1){

            header("Location: index.php");            

        } else {

            $pagina = $_GET["pagina"];

        }

    } else {

        $pagina = 1;

    }

    $empezar_desde = ($pagina - 1) * $filas_por_pagina;

    $conectar = conexion::abrir_conexion();
    $result = $conectar->query("Select * from comentarios");
    $numero_filas = $result->num_rows;
    $numero_paginas = ceil($numero_filas/$filas_por_pagina);
    $result->close();
    $conectar = conexion::cerrar_conexion();

    //------------------------------------------------------------impresión de los comentarios

    comentario::mostrar_comentarios($empezar_desde,$filas_por_pagina);

    //------------------------------------------------------------paginador

    echo "<div id='paginador'><span>Páginas: </span>";
    for($i = 1; $i <= $numero_paginas; $i++){
        if($i == $numero_paginas){
            echo "<a id='pag$i' href='?pagina=$i'>$i</a>";
        } else {
            echo "<a id='pag$i' href='?pagina=$i'>$i</a> , ";
        }
    }
    echo "</div>";

?>

</section>

<?php
    require("vista/footer.php");
?>