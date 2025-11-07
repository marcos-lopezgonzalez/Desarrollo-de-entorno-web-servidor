<?php
require_once __DIR__ . "/../models/bbdd.php";
require_once __DIR__ . "/../models/usuario.php";

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    die;
} else {
    $id = $_POST["id"];

    $dbInstancia = BBDD::getInstance();
    $dbInstancia->borrarUsuario($id);

    header("Location: ../views/listado.php");
    die;
}
