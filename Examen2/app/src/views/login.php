<?php
session_start();
if (isset($_SESSION["logeado"]) && $_SESSION["logeado"]) {
    // echo ("LOGIN CORRECTO");
    header("Location: ./listado.php");
    die;
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Incidencias</title>
    <link rel="stylesheet" href="../../public/css/estilos.css">
</head>

<body>

    <div class="form-login">
        <p style="font-size: 1rem">Administrador: admin@kk.com / toor</p>
        <p style="font-size: 1rem">Usuario: goku@kk.com / 1234</p>
        <form action="./../controllers/procesar-login.php" method="POST">
            <input type="email" size="30" name="email" placeholder="Email" required><br>
            <input type="password" size="30" name="password" placeholder="Contraseña" required><br>
            <button type="submit">Entrar</button>
        </form>
        <?php

        if (isset($_GET["mensaje"])) {
            $mensaje = $_GET["mensaje"];
            echo ("<p class='error-mensaje'>$mensaje</p>");
        }
        ?>

    </div>

</body>

</html>