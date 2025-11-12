<?php

session_start();
// require_once "../models/bbdd.php";
require __DIR__ . "/../../vendor/autoload.php";

use App\models\BBDD;

if (!$_SESSION["conectado"] || !isset($_SESSION["conectado"])) {
    //Lo mandamos a index para que inicie la conexion
    header("Location: ../../public/index.php");
    die;
}

$id = $_GET["id"];

//Singletone
$dbInstancia = BBDD::getInstance();
$sql = "SELECT * FROM usuarios WHERE id = :id";

//Parámetros de la consulta
$parametros = ["id" => $id];
$sentencia = $dbInstancia->getData($sql, $parametros);

$registro = $sentencia->fetch(PDO::FETCH_OBJ);
//var_dump($registro);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php include "menu.php" ?>
    <h2>Detalles del usuario</h2>
    <p>ID: <?= $registro->id ?></p>
    <p>Nombre: <?= $registro->nombre ?></p>
    <p>Apellido: <?= $registro->apellidos ?></p>
    <p>Usuario: <?= $registro->usuario ?></p>
    <p>Fecha de nacimiento: <?= (new DateTime($registro->fecha_nac))->format("d/m/Y") ?></p>
</body>

</html>