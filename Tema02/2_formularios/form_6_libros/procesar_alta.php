<?php

include_once("includes/funciones.php");
include_once("modelo/libro.php");

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: index.php");
    die;
} else {
    $mensaje = "";

    //Recogemos datos excepto portada
    $titulo = recoge("titulo");
    $autor = recoge("autor");
    $genero = recoge("generos");
    $ano = recoge("ano");
    $portada = "";


    $rutaSubida = "bbdd/portadas/"; // Carpeta para subir las portadas
    $portada = "";

    // Comprobaciones 
    if ($genero === null || count($genero) === 0) {
        $mensaje = "Debes asignar al menos un género...";
        header("Location: alta.php?mensaje=" . urlencode($mensaje));
        exit;
    }

    if (existeLibro($titulo)) {
        $mensaje = "Ese libro ya está registrado...";
        header("Location: alta.php?mensaje=" . urlencode($mensaje));
        exit;
    }


    // Recogemos portada
    // Comprobar si se ha adjuntado una portada
    if (!isset($_FILES['portada']) || $_FILES['portada']['error'] === UPLOAD_ERR_NO_FILE) {
        // Si no se adjunta portada usamos portada genérica
        $portada = $rutaSubida . "portada_generica.png"; // ajusta el nombre de tu archivo
    } else {
        // Si se adjunta portada
        // Validar tamaño máximo
        if ($_FILES["portada"]["size"] > 100000) {
            $mensaje = "Archivo demasiado grande";
            header("Location: alta.php?mensaje=" . urlencode($mensaje));
            exit;
        }

        // Combinamos el nombre del archivo de la portada con la ruta destino
        $nombrePortada = basename($_FILES["portada"]["name"]);
        $rutaCompleta = $rutaSubida . $nombrePortada;

        // Mover archivo hasta la ruta destino
        if (move_uploaded_file($_FILES["portada"]["tmp_name"], $rutaCompleta)) {
            $portada = $rutaCompleta;
        } else {
            $mensaje = "Error al guardar la portada";
            header("Location: alta.php?mensaje=" . urlencode($mensaje));
            die;
        }
    }

    //Creamos el objeto para el nuevo libro
    $nuevoLibro = new Libro($titulo, $autor, $genero, $ano, $portada);

    //Guardamos el libro con la función externa
    guardarLibro($nuevoLibro);

    $mensaje = "Alta correcta";
    header("Location: alta.php?mensaje=$mensaje");
    die;
}
