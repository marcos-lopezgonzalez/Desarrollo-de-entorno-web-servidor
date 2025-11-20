<?php

require __DIR__ . "/../vendor/autoload.php";

use App\models\BBDD;

//Nos conectamos a la base de datos
$db = new BBDD();

if ($db->isConected()) {
    // echo ("Conexión con BBDD completada");
    $db->crearDB();
    header("Location: ../src/views/login.php");
    die;
} else {
    echo ("Error al conectarse a BBDD");
    die;
}

//Si has conectado bien, te vas a listado.php
