<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css" title="Color">
    <title>Alta de libros</title>
</head>

<body>
    <!-- BEGIN menu.php INCLUDE -->
    <?php include("menu.php") ?>
    <!-- END menu.php INCLUDE -->
    <main>

        <form class="formulario" action="procesar_alta.php" method="post" enctype="multipart/form-data">
            <h2>Registro</h2>

            <label for="titulo">Título</label>
            <input type="text" id="titulo" name="titulo" required>

            <br><br>

            <label for="autor">Autor</label>
            <input type="text" id="autor" name="autor" required>

            <br><br>

            <label for="genero">Género</label>
            <fieldset>
                <legend>Selecciona uno o varios géneros:</legend>

                <label><input type="checkbox" name="generos[]" value="romance"> Romance</label><br>
                <label><input type="checkbox" name="generos[]" value="ciencia-ficcion"> Ciencia ficción</label><br>
                <label><input type="checkbox" name="generos[]" value="policiaco"> Policiaco</label><br>
                <label><input type="checkbox" name="generos[]" value="terror"> Terror</label><br>
                <label><input type="checkbox" name="generos[]" value="historico"> Histórico</label><br>
                <label><input type="checkbox" name="generos[]" value="fantasia"> Fantasía</label>
            </fieldset>


            <br><br>

            <label for="ano">Año</label>
            <input type="number" id="ano" name="ano" required>

            <br><br>

            <label for="portada">Portada</label>
            <input type="file" id="portada" name="portada">

            <br><br>

            <button type="submit">Registrar</button>

        </form>
        <br>

        <?php
        if (isset($_GET["mensaje"])) {
            $mensaje = $_GET["mensaje"];
            echo "<p class='mensaje fade-in-out'>$mensaje</p>";
        }

        ?>

        <br>

    </main>
    <!-- BEGIN footer.php INCLUDE -->
    <?php include("footer.php") ?>
    <!-- END footer.php INCLUDE -->
</body>

</html>