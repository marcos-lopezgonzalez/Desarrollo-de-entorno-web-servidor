<?php

session_start();
include_once("includes/funciones.php");

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: index.php");
    die;
}

$nombre = recoge("nombre");
$edad = recoge("edad");
$sexo = recoge("sexo");
$aficiones = recoge("aficiones");

$OK = true;

if (is_null($nombre)) {
    $OK = false;
    $_SESSION["error"]["nombre"] = "Falta el nombre";
} else {
    $_SESSION["nombre"] = $nombre;
}

if (is_null($edad)) {
    $OK = false;
    $_SESSION["error"]["edad"] = "Falta la edad";
} else if (!is_numeric($edad)) {
    $OK = false;
    $_SESSION["error"]["edad"] = "La edad debe ser un número";
} else if ($edad < 0) {
    $OK = false;
    $_SESSION["error"]["edad"] = "La edad debe ser un número positivo";
} else {
    $_SESSION["edad"] = $edad;
}

if (is_null($sexo)) {
    $OK = false;
    $_SESSION["error"]["sexo"] = "Falta el sexo";
} else {
    $_SESSION["sexo"] = $sexo;
}

if (is_null($aficiones)) {
    $OK = false;
    $_SESSION["error"]["aficiones"] = "Selecciona alguna afición";
} else {
    $_SESSION["aficiones"] = $aficiones;
}

if ($OK) {
    header("Location: mostrar_datos.php");
    die;
} else {
    header("Location: index.php");
    die;
}
