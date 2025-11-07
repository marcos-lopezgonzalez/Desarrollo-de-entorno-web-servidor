<?php

require_once "../models/usuario.php";
require_once "../models/bbdd.php";

$id = $_POST["id"];
$nombre = $_POST["nombre"];
$apellidos = $_POST["apellidos"];
$usuario = $_POST["usuario"];
$password = $_POST["password"] ?? "";
$fecha_nac = $_POST["fecha_nac"];

if (empty($password))
    $password = null;
else
    $password = password_hash($password, PASSWORD_DEFAULT);

$_usuario = new Usuario($id, $nombre, $apellidos, $usuario, $password, new DateTime($fecha_nac));


//Singletone
$dbInstancia = BBDD::getInstance();

$dbInstancia->actualizarUsuario($_usuario);

header("Location: ../views/listado.php");
die;
