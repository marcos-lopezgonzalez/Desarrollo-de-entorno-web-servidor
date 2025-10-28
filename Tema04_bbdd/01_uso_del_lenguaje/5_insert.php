<?php

require_once "funciones.php";

$conexion = conectaDB();

$nombre = "Pepito";
$apellidos = "Conejo";
$edad = 69;


$sql = "INSERT INTO personas (nombre, apellidos,edad)
             VALUES (:nombre, :apellidos, :edad)";

try {
    $sentencia = $conexion->prepare($sql);
    $sentencia->bindParam(":nombre", $nombre);
    $sentencia->bindParam(":apellidos", $apellidos);
    $sentencia->bindParam(":edad", $edad);
    $sentencia->execute();
    echo "<p>Registro creado correctamente</p>";
} catch (PDOException $e) {
    echo $e->getMessage();
    die;
}
