<?php

require __DIR__ . "/../../vendor/autoload.php";

use App\models\BBDD;
use App\models\Tarea;

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ./../../public/index.php");
    die;
}

$id = $_POST["id"];

$db = new BBDD();
$db->borrarTarea($id);

header("Location: ./../views/listado.php");
die;
