<?php
    $personas = [
        "nombre" => "Alicia", 
        "emails" => ["alicia.camacho@gmail.com", "alicialajefa@gmail.com"], 
        "calificaciones" => ["Programacion" => 8, "Bases de Datos" => 10]
    ];

    echo $personas["emails"][1] . "<br>";

    foreach ($personas["calificaciones"] as $asignatura => $nota) {
        echo  "$asignatura: $nota<br>";
    }

?>