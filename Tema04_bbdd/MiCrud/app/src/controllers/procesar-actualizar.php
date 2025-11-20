<?php

require __DIR__ . "/../../vendor/autoload.php";

use App\models\BBDD;

$id = $_POST["id"];
$nombre = $_POST["nombre"];
$apellidos = $_POST["apellidos"];
$usuario = $_POST["usuario"];
$password = $_POST["password"];

$db = new BBDD();
$db->actualizarUsuario($id, $nombre, $apellidos, $usuario, $password);

header("Location: ./../views/listado.php");
die;