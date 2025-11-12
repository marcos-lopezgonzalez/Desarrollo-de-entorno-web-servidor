<?php
// require_once __DIR__ . "/../models/bbdd.php";
// require_once __DIR__ . "/../models/usuario.php";
require __DIR__ . "/../../vendor/autoload.php";

use App\models\BBDD;
use App\models\Usuario;

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    die;
} else {
    $id = $_POST["id"];

    $dbInstancia = BBDD::getInstance();
    $dbInstancia->borrarUsuario($id);

    header("Location: ../views/listado.php");
    die;
}
