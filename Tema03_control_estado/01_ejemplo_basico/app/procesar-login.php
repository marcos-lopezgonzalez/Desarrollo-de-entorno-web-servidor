<?php

session_start();

$usuario_valido = "admin";
$clave_valida = "1234";

if (isset($_POST["usuario"])) {
    $usuario = $_POST["usuario"];
} else {
    $usuario = "";
}

//Si existe devuelve el valor de $_POST["clave], si no, devuelve una cadena vacía
$clave = $_POST["clave"] ?? "";

$recordar = isset($_POST["recordar"]);

if ($usuario === $usuario_valido && $clave === $clave_valida) {

    $_SESSION["usuario"] = $usuario;

    if ($recordar) {
        //Le ponemos un tiempo de expiración a la cookie
        setcookie("usuario", $usuario, time() + (7 * 24 * 60 * 60), "/");
    } else {
        //Expirar la cookie
        setcookie("usuario", "", time() - 3600, "/");
    }
    header("Location: bienvenida.php");
    die;
} else {
    echo "<p>Usuario o contraseña incorrectos</p>";
    echo "<a href='index.php'>Volver</a>";
}
