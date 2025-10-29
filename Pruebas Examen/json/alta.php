<?php

require_once "libro.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    die;
}

$titulo = $_POST["titulo"];
$autor = $_POST["autor"];
$editorial = $_POST["editorial"];
$isbn = $_POST["isbn"];

$libro = new Libro($titulo, $autor, $editorial, $isbn);

//Obtenemos los libros del fichero de BBDD
$listaLibros = [];
$jsonData = file_get_contents("bbdd.json", FILE_USE_INCLUDE_PATH);

//Pasamos el formato JSON a un array
//Hay que poner al menos un ejemplo en el json
$listaLibros = json_decode($jsonData);

array_push($listaLibros, $libro);

$jsonData = json_encode($listaLibros, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
file_put_contents("bbdd.json", $jsonData);

echo ("<p>Correcto</p>");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <a href="index.php">Volver</a>
</body>

</html>