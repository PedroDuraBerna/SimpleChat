<?php
    require("vista/header.php");
    require("clases/usuario.php");
?>

<style>
    #login{
        background-color: rgb(173, 7, 7);
    }
</style>

<?php

    function validar($err,$correo,$contraseña){

        if($correo == ""){
            $err["correo"] = "No has introducido el correo";
        } else {

            //si introducimos correo, comprobamos que exista

            if(!usuario::existe_correo($correo)){
                $err["correoNoExiste"] = "El correo que has introducido no existe";
            }

        }

        if($contraseña == ""){
            $err["contraseña"] = "No has introducido la contraseña";
        }

        //si existe el correo y se ha introducido contraseña, comprobamos que la contraseña es de ese correo

        if(usuario::existe_correo($correo) && $contraseña != ""){

            if(!usuario::comprobamos_contraseña_correo($correo,$contraseña)){

                $err["contraseñaCorreo"] = "La contraseña que has introducido es incorrecta";

            }

        }

        return $err;

    }

    $correo = "";
    $err = array();

    if(isset($_POST["entrar"])){

        $correo = $_POST["correo"];
        $contraseña = $_POST["contraseña"];

        $err = validar($err,$correo,$contraseña);

    }

    if(isset($_POST["entrar"]) && empty($err)){

        $user = usuario::datos_usuario($correo);

        $_SESSION["login"]["nombre"] = $user["nombre"];
        $_SESSION["login"]["id"] = $user["id_usr"];
        $_SESSION["login"]["correo"] = $user["email"];
        $_SESSION["login"]["tipo"] = $user["tipo"];

        echo "<section>";
        echo "<h1>Usuario logeado correctamente</h1>";
        echo "<hr>";
        echo "<p id='redireccion'>Redireccionando en 3 segundos</p>";
        echo "</section>";
        header("refresh:3; url=index.php");

    } else {

?>

<section>
    <h1>Entra a SimpleChat</h1>
    <hr>
    <form action="" method="post">
        <input type="text" name="correo" placeholder="Correo electrónico" value="<?php echo $correo ?>">
        <?php if(isset($err["correo"])) echo "<p class='red'>".$err['correo']."</p>" ?>
        <?php if(isset($err["correoNoExiste"])) echo "<p class='red'>".$err["correoNoExiste"]."</p>" ?>
        <input type="password" name="contraseña" placeholder="Contraseña">
        <?php if(isset($err["contraseña"])) echo "<p class='red'>".$err["contraseña"]."</p>" ?>
        <input type="submit" value="Entrar" name="entrar">
    </form>
</section>

<?php

    }

    require("vista/footer.php");
?>