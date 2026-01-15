<?php

function conectarBBDD()
{
    $motor = "mysql";
    $host = "localhost";
    $db = "libros_apikey";
    $user = "root";
    $password = "";
    $charset = "UTF8mb4";

    $dsn = "$motor:host=$host;dbname=$db;charset=$charset";

    try {
        $conexion = new PDO($dsn, $user, $password);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conexion;
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(["error" => "Error en conexión a BBDD"]);
        die;
    }
}

function obtenerRol($key)
{
    $conexion = conectarBBDD();

    $keyHash = hash("sha256", $key);

    $sql = "SELECT rol FROM api_keys WHERE api_key = :api_key";

    try {
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(":api_key", $keyHash);
        $sentencia->execute();

        $rol = $sentencia->fetchColumn();
        return $rol;
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(["error" => "Error al obtener rol"]);
        die;
    }
}

function obtenerLibros($titulo = null)
{
    $conexion = conectarBBDD();

    if (isset($titulo)) {
        $titulo = "%" . $titulo . "%";
        $sql = "SELECT * FROM libro WHERE titulo LIKE :titulo";
    } else {
        $sql = "SELECT * FROM libro";
    }

    try {
        $sentencia = $conexion->prepare($sql);
        if (isset($titulo)) {
            $sentencia->bindParam(":titulo", $titulo);
        }
        $sentencia->execute();

        $libros = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $libros;
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(["error" => "Error al obtener libros"]);
        echo json_encode($e->getMessage());
        die;
    }
}


function insertarLibro($nuevoLibro)
{
    $conexion = conectarBBDD();


    $titulo = $nuevoLibro->titulo;
    $autor = $nuevoLibro->autor;
    $genero = $nuevoLibro->genero;

    $sql = "INSERT INTO libro (titulo, autor, genero) VALUES (:titulo, :autor, :genero)";

    try {
        $sentencia = $conexion->prepare($sql);

        $sentencia->bindParam(":titulo", $titulo);
        $sentencia->bindParam(":autor", $autor);
        $sentencia->bindParam(":genero", $genero);

        $sentencia->execute();
        return true;
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(["error" => "Error al crear libro"]);
        die;
    }

    return false;
}
