<?php
    $datos = ["Alicia", "Camacho", 24, "alicia.camacho@gmail.com"];
    list($nombre, $apellido, $edad, $email) = $datos;

    echo "<ul>";
    echo "<li>Nombre: $nombre</li>";
    echo "<li>Apellido: $apellido</li>";
    echo "<li>Edad: $edad</li>";
    echo "<li>Email: $email</li>";
    echo "</ul>";


    $edades = [
        "Andrés" => 21,
        "Bárbara" => 19,
        "Camilo" => 15
    ];

    print "<p>Bárbara tiene $edades[Bárbara] años</p>";
    print "<p>Camilo tiene {$edades["Camilo"]} años</p>";
    print "<p>Andrés tiene " . $edades["Andrés"] . " años</p>";

    echo "<p>El array tiene " . count($edades) . " personas</p>";
    echo "<ul>";
    foreach ($edades as $nombre => $edad) {
        echo "<li>$nombre tiene $edad años</li>";
    }
    echo "</ul>";

    echo "<ul>";
    foreach ($edades as $edad) {
        echo "<li>$edad años</li>";
    }
    echo "</ul>";
?>