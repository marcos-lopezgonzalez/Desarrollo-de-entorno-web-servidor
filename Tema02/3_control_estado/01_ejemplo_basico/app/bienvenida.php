<?php

session_start();

//Si se ha iniciado sesion anteriomente (sin cerrar el navegador)
if (isset($_SESSION["usuario"]))
    $usuario = $_SESSION["usuario"];
//Si se intenta acceder a bienvenida.php sin haber iniciado sesion    
else {
    header("Location: index.php");
    die;
}

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Bienvenida</title>
</head>

<body>
    <h2>Bienvenido, <?= $usuario ?> 👋</h2>
    <p>Has iniciado sesión correctamente.</p>
    <a href="logout.php">Cerrar sesión</a>
</body>

</html>