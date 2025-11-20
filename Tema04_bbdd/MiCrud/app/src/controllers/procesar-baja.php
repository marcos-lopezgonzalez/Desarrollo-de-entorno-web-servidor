<?php

require __DIR__ . "/../../vendor/autoload.php";

use App\models\BBDD;

$id = $_POST["id"];

$db = new BBDD();
$db->borrarUsuario($id);

header("Location: ./../views/listado.php");
die;