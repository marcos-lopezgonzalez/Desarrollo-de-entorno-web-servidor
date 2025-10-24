<?php

include_once __DIR__ . '/../modelo/libro.php';

const file = "bbdd/data.json";

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
    $listaLibros = obtenerLibros();

    // Ver si la lista de libros está vacía (no existe ningún libro en BBDD)
    if ($listaLibros === null) {
        $listaLibros = [];
    }

    //Añadimos el nuevo libro
    array_push($listaLibros, $nuevoLibro);
    //Pasamos el array de libros a JSON y guardamos los cambios en el fichero
    $jsonData = json_encode($listaLibros, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    file_put_contents(file, $jsonData);
}

function obtenerLibros()
{
    //Obtenemos los libros del fichero de BBDD
    $listaLibros = [];
    $jsonData = file_get_contents(file, FILE_USE_INCLUDE_PATH);

    //Pasamos el formato JSON a un array
    $listaLibros = json_decode($jsonData);
    return $listaLibros;
}

function obtenerLibro($libroBusqueda)
{
    $listaLibros = obtenerLibros();

    foreach ($listaLibros as $libro) {
        // Comparamos títulos ignorando espacios y mayúsculas/minúsculas
        if (str_replace(' ', '', strtolower($libro->titulo)) === str_replace(' ', '', strtolower($libroBusqueda))) {
            // Si devuelvo un objeto libro debo acceder despues con los getters y setters a los atributos
            // Si devuelvo un objeto estandar php no hace falta
            // return new Libro(
            //     $libro->titulo,
            //     $libro->autor,
            //     $libro->genero, 
            //     $libro->ano,
            //     $libro->portada
            // );
            return $libro;
        }
    }

    return null; // Si no se encuentra el libro
}



function existeLibro($titulo)
{
    $listaLibros = obtenerLibros();

    //Si ya existe ese libro
    foreach ($listaLibros as $libro)
        //Eliminamos espacios con str_replace y pasamos a minusculas los titulos para comprobar si son iguales
        if (str_replace(' ', '', strtolower($libro->titulo)) === str_replace(' ', '', strtolower($titulo)))
            return true;
    //Si no existe
    return false;
}

function borrarLibro($libroABorrar)
{
    $listaLibros = obtenerLibros();

    foreach ($listaLibros as $key => $libro) {
        // Comparamos títulos (quitando espacios y pasando a minúsculas)
        if (str_replace(' ', '', strtolower($libro->titulo)) === str_replace(' ', '', strtolower($libroABorrar))) {
            unset($listaLibros[$key]); // Eliminamos usando el índice
        }
    }

    //Pasamos el array de libros a JSON y guardamos los cambios en el fichero
    $jsonData = json_encode($listaLibros, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    file_put_contents(file, $jsonData);
}
