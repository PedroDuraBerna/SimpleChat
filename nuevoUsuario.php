<?php
    require("vista/header.php");
    require("clases/usuario.php");
?>

<style>
    #nuevo{
        background-color: rgb(173, 7, 7);
    }
</style>

<?php

    function validar($err,$nombre,$correo,$contraseña,$contraseñaRepe){

        //comprobamos que los campos introducidos no estan vacios

        if($nombre == ""){
            $err["nombre"] = "No has introducido el nombre";
        }

        if($correo == ""){

            $err["correo"] = "No has introducido el correo";


        } else {

            //si el correo no esta vacío, entonces comprobamos si ya existe

            if(usuario::existe_correo($correo)){

                $err["existeCorreo"] = "El correo que has introducido ya existe";

            }

        }

        if($contraseña == ""){
            $err["contraseña"] = "No has introducido la contraseña";
        }

        if($contraseñaRepe == ""){
            $err["contraseñaRepe"] = "No has introducido la contraseña repetida";
        }

        if($contraseña != $contraseñaRepe && (!isset($err["contraseña"]) || !isset($err["contraseñaRepe"]))){
            $err["noCoinciden"] = "Las contraseñas no coinciden";
        }

        return $err;

    }

    $err = array();
    $nombre = "";
    $correo = "";

    if(isset($_POST["crear"])){
        
        $nombre = $_POST["nombre"];
        $correo = $_POST["correo"];
        $contraseña = $_POST["contraseña"];
        $contraseñaRepe = $_POST["contraseñaRepe"];

        $err = validar($err,$nombre,$correo,$contraseña,$contraseñaRepe);

    }

    if(isset($_POST["crear"]) && empty($err)){

        usuario::insertar_usuario($nombre,$correo,$contraseña);

        $user = usuario::datos_usuario($correo);

        $_SESSION["login"]["nombre"] = $user["nombre"];
        $_SESSION["login"]["id"] = $user["id_usr"];
        $_SESSION["login"]["correo"] = $user["email"];
        $_SESSION["login"]["tipo"] = $user["tipo"];

        echo "<section>";
        echo "<h1>Usuario registrado correctamente</h1>";
        echo "<hr>";
        echo "<p id='redireccion'>Redireccionando en 3 segundos</p>";
        echo "</section>";
        header("refresh:3; url=index.php");

    } else {

?>

<section>
    <h1>Creación de nuevo usuario</h1>
    <hr>
    <form action="<?php $_SERVER["PHP_SELF"] ?>" method="post">
        <input type="text" name="nombre" placeholder="Nombre" value="<?php echo $nombre ?>" <?php if(isset($err["nombre"])) echo "class='err'" ?>>
        <?php if(isset($err["nombre"])) echo "<p class='red'>".$err['nombre']."</p>" ?>
        <input type="text" name="correo" placeholder="Correo electrónico" value="<?php echo $correo ?>" <?php if(isset($err["correo"])) echo "class='err'" ?>>
        <?php if(isset($err["correo"])) echo "<p class='red'>".$err['correo']."</p>" ?>
        <?php if(isset($err["existeCorreo"])) echo "<p class='red'>".$err['existeCorreo']."</p>" ?>
        <input type="password" name="contraseña" placeholder="Contraseña" <?php if(isset($err["contraseña"])) echo "class='err'" ?>>
        <?php if(isset($err["contraseña"])) echo "<p class='red'>".$err['contraseña']."</p>" ?>
        <?php if(isset($err["noCoinciden"])) echo "<p class='red'>".$err['noCoinciden']."</p>" ?>
        <input type="password" name="contraseñaRepe" placeholder="Repite Contraseña" <?php if(isset($err["contraseñaRepe"])) echo "class='err'" ?>>
        <?php if(isset($err["contraseñaRepe"])) echo "<p class='red'>".$err['contraseñaRepe']."</p>" ?>
        <p <?php if(!empty($err)) echo "class='red'" ?>><b>Han de rellenarse todos los campos</b></p>
        <input type="submit" value="Crear" name="crear">
    </form>
</section>

<?php

    }

    require("vista/footer.php");
?>