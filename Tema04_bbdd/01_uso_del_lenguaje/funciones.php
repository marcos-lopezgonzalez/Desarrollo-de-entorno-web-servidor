<?php

include_once "config.php";

function conectaDB()
{
    global $mysqlHost;
    global $mysqlUser;
    global $mysqlPassword;
    global $mysqlDatabase;

    $dsnConBBDD = "mysql:host=$mysqlHost;dbname=$mysqlDatabase;charset=utf8mb4";
    $dsnSinBBDD = "msql:host=$mysqlHost;charset=utf8mb4";
    $usuario = $mysqlUser;
    $password = $mysqlPassword;

    try {
        //Conexión a BBDD concreta
        $conexion = new PDO($dsnConBBDD, $usuario, $password);
    } catch (PDOException $e) {
        echo "<p>Error: No puede conectarse con la base de datos {$e->getMessage()}</p>";
        try {
            //Conexión al SGBD
            $conexion = new PDO($dsnSinBBDD, $usuario, $password);
        } catch (PDOException $e) {
            echo "<p>Error: No puede conectarse con la base de datos {$e->getMessage()}</p>";
            die;
        }
    }

    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conexion;
}
