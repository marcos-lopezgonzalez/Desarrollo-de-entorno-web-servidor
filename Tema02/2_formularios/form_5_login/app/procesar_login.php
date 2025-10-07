<?php
require_once("includes/funciones.php");
require_once("modelo/usuario.php");

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location index.php");
    die;
} else {
    $mensaje = "";

    $email = recoge("email");
    $password = recoge("password");
    if ($email == null || $password == null) {
        $mensaje = "ERROR: Los campos no pueden estar vacíos";
        header("Location: login.php?mensaje=$mensaje");
        die;
    }

    $usuario = checkUser($email, $password);

    if ($usuario == null) { 
        $mensaje = "ERROR: Credenciales inválidos";
        header("Location: login.php?mensaje=$mensaje");
    } else {
        $mensaje = "Login correcto";
        header("Location: login.php?mensaje=$mensaje");
        die;
    }
}
