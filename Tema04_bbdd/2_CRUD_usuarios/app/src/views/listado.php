<?php
session_start();

if (!$_SESSION["conectado"] || !isset($_SESSION["conectado"])) {
    //Lo mandamos a index para que inicie la conexion
    header("Location: ../../public/index.php");
    die;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado Usuarios</title>
</head>

<body>
    <h1>LISTADO DE USUARIOS</h1>
</body>

</html>