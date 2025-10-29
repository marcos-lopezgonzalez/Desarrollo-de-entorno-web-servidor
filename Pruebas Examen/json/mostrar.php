<?php
$listaLibros = [];
$jsonData = file_get_contents("bbdd.json", FILE_USE_INCLUDE_PATH);

$listaLibros = json_decode($jsonData);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<table>
    <thead>
        <tr>
            <th>Titulo</th>
            <th>Autor</th>
            <th>Editorial</th>
            <th>ISBN</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($listaLibros as $libro) {
            echo ("<tr>");
            echo ("<td>$libro->titulo</td>");
            echo ("<td>$libro->autor</td>");
            echo ("<td>$libro->editorial</td>");
            echo ("<td>$libro->isbn</td>");
            echo ("<td><a href=\"ver_libro.php?titulo=$libro->titulo&autor=$libro->autor\">Ver libro</a></td>");
            echo ("</tr>");
        }
        ?>
    </tbody>

</table>

<body>
    <a href="index.php">Volver</a>
</body>

</html>