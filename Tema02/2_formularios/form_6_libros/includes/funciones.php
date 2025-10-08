<?php
// includes/funciones.php

function recoge($var)
{
    if (!isset($_REQUEST[$var])) {
        return null;
    }

    $valor = $_REQUEST[$var];

    // Si es un array
    if (is_array($valor)) {
        $result = [];
        foreach ($valor as $v) {
            if ($v !== "") {
                $tmp = trim(htmlspecialchars(strip_tags($v)));
                $result[] = $tmp;
            }
        }
        return count($result) ? $result : null;
    }

    // Si es una cadena
    if ($valor != "") {
        return trim(htmlspecialchars(strip_tags($valor)));
    }

    return null;
}

function guardarLibro($nuevoLibro)
{
    //Fichero donde se guardan los libros. Obtenemos los libros guardados
    $file =  "bbdd/data.json";
    $jsonData = file_get_contents($file);
    $listaLibros = json_decode($jsonData);

    // Ver si la lista de libros está vacía (no existe ningún libro en BBDD)
    if ($listaLibros === null) {
        $listaLibros = [];
    }

    //Añadimos el nuevo libro
    array_push($listaLibros, $nuevoLibro);
    //Pasamos el array de libros a JSON y guardamos los cambios en el fichero
    $jsonData = json_encode($listaLibros, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    file_put_contents($file, $jsonData);
}
