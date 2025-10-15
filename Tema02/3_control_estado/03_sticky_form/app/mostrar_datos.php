<?php

session_start();

$nombre = $_SESSION["nombre"];
$edad = $_SESSION["edad"];

unset($_SESSION["nombre"]);
unset($_SESSION["edad"]);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2>Datos recibidos</h2>
    <p>Nombre: <?= $nombre ?></p>
    <p>Edad: <?= $edad ?></p>
    <a href="index.php"></a>
    <footer>
        <hr>
        <p>Autor: Marcos López González</p>
    </footer>
</body>

</html>