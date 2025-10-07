<?php

include_once("includes/funciones.php");

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: index.php");
    die;
} else {
    $mensaje = "";
    $titulo = recoge("titulo");
    $autor = recoge("autor");
    $genero = recoge("genero");
    $ano = recoge("ano");
    $portada = recoge("portada");

    // Comprobaciones 
    if ($genero === null) {
        $mensaje = "Debes asignar un género...";
        header("Location: alta.php?mensaje=$mensaje");
        die;
    }
}
