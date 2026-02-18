<?php

require __DIR__ . "/../../vendor/autoload.php";

use App\models\Basedatos;

$id = $_POST["id"];
$resolucion = $_POST["resolucion"];

if ($resolucion === "sin resolver" || trim($resolucion) === "") {
    $mensaje = "Resolucion no válida";
    header("Location: ./../views/ver.php?id=$id&mensaje=$mensaje");
    die;
}
// echo ($id);
// echo ($resolucion);

$db = new Basedatos();

$sentencia = $db->resolverIncidencia($id, $resolucion);
header("Location: ./../views/listado.php");
die;
