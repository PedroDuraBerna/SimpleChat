<?php
    require("vista/header.php");
    require("clases/usuario.php");

    if(isset($_POST["cambiarNombre"])){
        if($_POST["nombre"] == ""){
            $err["nombre"] = "No has introducido el nombre";
        } else {
            usuario::cambio_nombre($_SESSION["login"]["id"],$_POST["nombre"]);
            $_SESSION["login"]["nombre"] = $_POST["nombre"];
            header("Location: configuracionusuario.php");
        }
    }

    if(isset($_POST["cambiarContraseña"])){
        if($_POST["contraseña"] == ""){
            $err["contraseña"] = "No has introducido la contraseña";
        }
        if($_POST["contraseñaRepe"] == ""){
            $err["contraseñaRepe"] = "No has introducido la contraseña repetida";
        }
        if($_POST["contraseñaRepe"] == $_POST["contraseña"] && $_POST["contraseña"] != ""){

            usuario::cambio_contraseña($_SESSION["login"]["id"],$_POST["contraseña"]);

        } else if($_POST["contraseña"] != ""){
            $err["contraseñaDiferente"] = "Las contraseñas que has introducido son diferentes";
        }
    }

?>

<style>
    #config{
        background-color: rgb(173, 7, 7);
    }
</style>

<section>
    <h1>Mi perfíl de usuario</h1>
    <hr>
    <article>
    <h3>Datos Personales</h3>
        <p>Correo: <b><?php echo $_SESSION["login"]["correo"] ?></b></p>
        <p>Nombre: <b><?php echo $_SESSION["login"]["nombre"] ?></b></p>
    </article>
    <article>
    <h3>Cambiar datos personales</h3>
    <form action="" method="post" id='cambio'>
        <input type="text" name="nombre" placeholder="Nombre">
        <?php if(isset($err["nombre"])) echo "<p class='red'>" . $err["nombre"] . "</p>" ?>
        <input type="submit" value="Cambiar Nombre" name="cambiarNombre">
        <input type="password" name="contraseña" placeholder="Contraseña">
        <?php if(isset($err["contraseña"])) echo "<p class='red'>" . $err["contraseña"] . "</p>" ?>
        <input type="password" name="contraseñaRepe" placeholder="Repite la contraseña">
        <?php if(isset($err["contraseñaRepe"])) echo "<p class='red'>" . $err["contraseñaRepe"] . "</p>" ?>
        <?php if(isset($err["contraseñaDiferente"])) echo "<p class='red'>" . $err["contraseñaDiferente"] . "</p>" ?>
        <input type="submit" value="Cambiar Contraseña" name="cambiarContraseña">
    </form>
    </article>
</section>

<?php
    require("vista/footer.php");
?>