<?php

session_start();

if (isset($_SESSION["username"])) {
    header("Location: listar-libros.php");
    die;
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>05 Libros Login</title>
</head>

<body>
    <form action="procesar_login.php" method="post">
        <p>Username</p>
        <input type="text" name="username" id="username">
        <p>Password</p>
        <input type="password" name="password" id="password">
        <br><br>
        <input type="submit" value="Login">

        <?php
        if (isset($_SESSION["mensajeLogin"])) {
            echo ("<p>" . $_SESSION["mensajeLogin"] . "</p>");
            unset($_SESSION["mensajeLogin"]);
        }
        ?>
    </form>
</body>

</html>