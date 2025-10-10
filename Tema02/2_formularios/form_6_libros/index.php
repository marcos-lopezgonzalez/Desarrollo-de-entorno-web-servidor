<?php
include_once "includes/funciones.php";
include_once "modelo/libro.php";
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Libros Marcos López González</title>
</head>

<body>
    <?php include('menu.php'); ?>
    <main>
        <?php
        $listaLibros = obtenerLibros();

        if (count($listaLibros) == 0) {
            //No existen libros
            echo "<p>No existen libros</p>";
        } else {
            echo "<table class=\"tabla-libros\">";
            echo "<tr>
                    <th>Portada</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Año</th>
                    <th>Géneros</th>
                  </tr>";

            foreach ($listaLibros as $libro) {
                echo "<tr>";
                //Portada
                echo "<td><img src=\"$libro->portada\"</td>";
                //Titulo
                echo "<td>$libro->titulo</td>";
                //Autor
                echo "<td>$libro->autor</td>";
                //Año
                echo "<td>$libro->ano</td>";
                //Genero/s
                echo "<td>";
                echo "<select>";
                for ($i = 0; $i < count($libro->genero); $i++) {
                    echo "<option value=\"$genero\">{$libro->genero[$i]}</option>";
                }
                echo "</select>";
                echo "</td>";
                echo "</tr>";
            }

            echo "</table>";
        }
        ?>
    </main>
    <?php include('footer.php'); ?>
</body>

</html>