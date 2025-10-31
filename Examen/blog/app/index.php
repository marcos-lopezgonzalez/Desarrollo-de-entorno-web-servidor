<?php
require_once "includes/funciones.php";

$listaArticulos = [];
$listaArticulos = obtenerDatos();

if (!isset($_COOKIE["idioma"])) {
    $idioma = "es";
    setcookie("idioma", $idioma, time() + 3600, "/");
} else if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $idioma = $_POST["idioma"];
    setcookie("idioma", $idioma, time() + 3600, "/");
} else {
    $idioma = $_COOKIE["idioma"];
}
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
    <header>
        <?php
        include("header.php");
        ?>
    </header>

    <div class="selector-idioma">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
            method="post">
            <button name="idioma" value="es" class="boton-idioma"><img src="img/spain.png" width="50px"></button>
            <button name="idioma" value="uk" class="boton-idioma"><img src="img/uk.png" width="50px"></button>
        </form>
    </div>

    <main>
        <?php
        foreach ($listaArticulos as $articulo) {
            echo ("<a href=\"articulo.php?id=$articulo->id\">" . $articulo->title->$idioma . "</a>");
            echo ("<br>");
        }
        ?>
        <!--
        <ul>
            <li><a href="XXXX"><h3>TITULO_ARTICULO</h3></a></li>
            <li><a href="XXXX"><h3>TITULO_ARTICULO</h3></a></li>
            . . .
        </ul>
        -->
    </main>

    <footer>
        <?php
        include("footer.php");
        ?>
    </footer>
</body>

</html>