<?php

require_once("includes/funciones.php");

session_start();

$username = recoge("username");
$password = recoge("password");

if ($username !== "admin") {
    $_SESSION["mensajeLogin"] = "Credenciales inválidas";
    header("Location: index.php");
    die;
}

if ($password !== "1234") {
    $_SESSION["mensajeLogin"] = "Credenciales inválidas";
    header("Location: index.php");
    die;
}

$_SESSION["username"] = $username;
header("Location: listar_libros.php");