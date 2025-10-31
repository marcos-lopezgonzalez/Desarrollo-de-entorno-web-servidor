<?php

// const file = "articulos.json";

//Codigo para leer todo el json de un archivo en una varible
// $datos = [];
// $file = 'nombre_archivo';

// $jsonData = file_get_contents($file, FILE_USE_INCLUDE_PATH);
// $datos = json_decode($jsonData);

function obtenerDatos()
{
    $listaArticulos = [];
    $file = "articulos.json";

    $jsonData = file_get_contents($file, FILE_USE_INCLUDE_PATH);
    $listaArticulos = json_decode($jsonData);

    return $listaArticulos;
}

function obtenerArticulo($id)
{
    $listaArticulos = [];
    $listaArticulos = obtenerDatos();

    foreach ($listaArticulos as $articulo) {
        if ($articulo->id == $id) {
            return $articulo;
        }
    }

    return false;
}
