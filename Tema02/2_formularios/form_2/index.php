<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["nombre"]) && trim($_POST["nombre"]) != "") {
        //$nombre = $_POST["nombre"];
        $nombre = trim(htmlspecialchars(strip_tags($_POST["nombre"])));
    } else {
        $nombreError = "No se ha escrito ningún nombre";
    }

    if (0 < $_POST["edad"] && $_POST["edad"] < 150) {
        if (isset($_POST["edad"]) && $_POST["edad"] != "" && is_numeric($_POST["edad"])) {
            $edad = $_POST["edad"];
        } else {
            $edadError = "No se ha escrito ninguna edad";
        }
    } else {
        $edadError = "Edad no válida";
    }
}
?>





<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css" title="Color">
    <title>form_02</title>
</head>

<body>
    <h1>####################Incompleto####################</h1>
    <header>
        <h1>Formulario 02 - el form recibe los datos</h1>
    </header>
    <main>

        <!-- usar 
       action = "< ?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"  
     -->
        <form action="index.php" method="post">
            <fieldset>
                <legend>Envio tipo POST</legend>
                <p>
                    <!-- al usar <label> y que coincida con el id del <input> correspondiente, permite que al hacer click 
            en el texto del <label>, el cursor se coloque directamente en el campo asociado -->
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre">
                </p>
                <p>
                    <label for="edad">Edad:</label>
                    <input type="number" id="edad" name="edad">
                </p>

                <p>
                    <input type="radio" id="sexo_masculino" name="sexo" value"M"></input>
                    <label for="sexo_masculino">MASCULINO</label>
                    <input type="radio" id="sexo_femenino" name="sexo" value"F"></input>
                    <label for="sexo_femenino">FEMENINO</label>
                </p>

                <p>
                    <input type="checkbox" name="aficiones[]" value="musica">Musica</input>
                    <input type="checkbox" name="aficiones[]" value="cine">Cine</input>
                    <input type="checkbox" name="aficiones[]" value="lectura">Lectura</input>
                </p>

            </fieldset>

            <p>
                <button type="submit">Enviar</button>
                <button type="reset">Borrar</button>
            </p>
        </form>

        <br><br>
        <div class="datos-recibidos">
            <?php

            if (isset($nombreError)) {
                echo "<div class='error'>ERROR: $nombreError</div>";
            }

            if (isset($edadError)) {
                echo "<div class='error'>ERROR: $edadError</div>";
            }

            if (isset($nombre)) {
                echo "Nombre: " . $nombre . "<br>";
            }

            if (isset($edad)) {
                echo "Edad: " . $edad . "<br>";
            }
            ?>
        </div>



    </main>
    <footer>
        <hr>
        <p>Autor: Juan Antonio Cuello</p>
    </footer>
</body>

</html>