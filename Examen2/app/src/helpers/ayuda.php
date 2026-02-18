<?php

require __DIR__ . "/../../vendor/autoload.php";

use App\models\Basedatos;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

function nombre_dado_id($_id)
{
    $db = new Basedatos();
    $sql = "SELECT nombre FROM usuario WHERE id = :id";
    $parametros = [
        "id" => $_id
    ];
    $sentencia = $db->getData($sql, $parametros);
    $registro = $sentencia->fetch(PDO::FETCH_OBJ);
    return $registro->nombre;
}

function enviar_log($tipoLog, $mensaje)
{
    $log = new Logger("name");
    $logPath = __DIR__ . "/../../app.log";
    $log->pushHandler(new StreamHandler($logPath));

    if ($tipoLog === "info") {
        $log->info($mensaje);
    } else if ($tipoLog === "error") {
        $log->error($mensaje);
    }
}

function hola()
{
    return "hola";
}
