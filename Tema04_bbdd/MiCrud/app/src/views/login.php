<?php
session_start();

if (isset($_SESSION["logeado"]) && $_SESSION["logeado"] === true) {
    header("Location: ./listado.php");
    die;
}

if(isset($_GET["mensaje"]))
    $mensaje = $_GET["mensaje"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="./../controllers/procesar-login.php" method="post">
        <h1>MENU LOGIN</h1>
        <label for="usuario">Usuario</label>
        <input name="usuario" type="text">
        <br><br>
        <label for="password">Contraseña</label>
        <input name="password" type="password">
        <br><br>
        <button type="submit">LOGIN</button>

        <?php
        if (isset($mensaje))
            echo ($mensaje);
        ?>
    </form>
</body>

</html>