<?php

require __DIR__ . "/../../vendor/autoload.php";

use App\models\BBDD;
use App\models\Tarea;

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ./../../public/index.php");
    die;
}

$descripcion = $_POST["descripcion"];

$tarea = new Tarea(null, $descripcion);

$db = new BBDD();
$db->insertarTarea($tarea);

header("Location: ./../views/listado.php");
die;
