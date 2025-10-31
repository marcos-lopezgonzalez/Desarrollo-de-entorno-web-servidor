<?php
require_once "includes/funciones.php";

$idArticulo = $_GET["id"];
$articulo = obtenerArticulo($idArticulo);
$idioma = $_COOKIE["idioma"];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styles.css">
    <title>BLOG</title>
</head>

<body>

    <main>

        <?php
        echo ("<header>");
        include("header.php");
        echo ("</header>");

        if (!$articulo) {
            echo ("<p>No existe ese articulo</p>");
        } else {
            echo "<article class=\"centrado\">";
            echo "<a class=\"volver\" href=\"index.php\">VOLVER</a>";
            echo "<h3>" . $articulo->title->$idioma . "</h3>";
            echo "<p>" . $articulo->description->$idioma . "</p>";
            echo "<div><img src=\" $articulo->image \" width=\"300px\"></div>";
            echo "</article>";
        }

        echo ("<footer>");
        include("footer.php");
        echo ("</footer>");
        ?>
    </main>

</body>

</html>