<?php

## Recogemos los datos con POST, y solo permitimos POST

if ($_SERVER["REQUEST_METHOD"] != "POST") {

    echo ("⚠️ Petición no válida (Hay que pasar por el formlario)");
    //Volvemos al formulario
    print "<p><a href='index.html'>Formulario</a></p>";
} else {

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

    if (isset($nombre)) {
        echo ("Nombre: " . $nombre . "<br>");
    } else {
        echo ("ERROR: " . $nombreError . "<br>");
    }

    if (isset($edad)) {
        echo ("Edad: " . $edad . "<br>");
    } else {
        echo ("ERROR: " . $edadError . "<br>");
    }
}

//Volvemos al formulario.
print "<p><a href='index.html'>Formulario</a></p>";
