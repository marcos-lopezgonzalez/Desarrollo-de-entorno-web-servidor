<?php
session_start();

require_once __DIR__ . "/../src/models/bbdd.php";

// Nos conectamos a la BBDD
// Singlentone para tener UNA sola instancia
$dbInstancia = BBDD::getInstance();

if ($dbInstancia->getConection() != null) {
    $_SESSION["conectado"] = true;
    header("Location: ../src/views/listado.php");
} else {
    echo ("ERROR en la conexión a BBDD");
    die;
}
