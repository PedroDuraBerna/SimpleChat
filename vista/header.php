<?php
    session_start();

    if(isset($_POST["logout"])){
        unset($_SESSION["login"]);
        header("Location: index.php");
    }

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>SimpleChat</title>
</head>
<body>

<?php
        if(isset($_SESSION["login"])){
            echo "<form id='logoutBoton' action=" . $_SERVER["PHP_SELF"] . " method='post'>";
            echo "<p>" . $_SESSION["login"]["nombre"] . "</p>";
            echo "<input type='submit' name='logout' value='Logout'>";
            echo "</form>";
        }
?>
    
<header>
    <h1>SimpleChat</h1>
    <nav>
        <a id="chat" href="index.php">Chat</a>
        <?php 
            if(!isset($_SESSION["login"])){
                echo "<a id='login' href='login.php'>Login</a>";
            }
            if(isset($_SESSION["login"])){
                echo "<a href='configuracionusuario.php' id='config'>Configuración de usuario</a>";
            } else {
                echo "<a id='nuevo' href='nuevoUsuario.php'>Nuevo Usuario</a>";
            }
        ?>
    </nav>
</header>
