<?php
require_once("includes/funciones.php");
require_once("modelo/usuario.php");

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: index.php");
    die;
} else {
    $mensaje = "";

    $nombre = recoge("nombre");
    $email = recoge("email");
    $password1 = recoge("password1");
    $password2 = recoge("password2");

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $mensaje = "Email inválido";
        header("Location: alta.php?mensaje=$mensaje");
        die;
    }

    if (comprobarEmailExiste($email)) {
        $mensaje = "El email ya existe";
        header("Location: alta.php?mensaje=$mensaje");
        die;
    }

    if ($password1 !== $password2) {
        $mensaje = "Las contraseñas no coinciden";
        header("Location: alta.php?mensaje=$mensaje");
        die;
    }

    $usuario = new Usuario($nombre, $email, $password1);
    $file =  "bbdd/data.json";
    $jsonData = file_get_contents($file);
    $listaUsuarios = json_decode($jsonData);
    array_push($listaUsuarios, $usuario);
    $jsonData = json_encode($listaUsuarios, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    file_put_contents($file, $jsonData);
    $mensaje = "Alta correcta";
    header("Location: alta.php?mensaje=$mensaje");
    die;
}
