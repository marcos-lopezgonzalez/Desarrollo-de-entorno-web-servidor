<?php

require __DIR__ . "/../../vendor/autoload.php";

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

function crearLog($tipoLog, $mensajeLog, $archivo, PDOException | null $excepcionLog = null)
{
    $log = new Logger('app');
    $log->pushHandler(new StreamHandler(__DIR__ . "/../../app.log"));

    if ($tipoLog === "error") {
        $log->error($mensajeLog);
        $log->error($excepcionLog->getMessage(), ["archivo:" => $archivo]);
    } else if ($tipoLog === "info") {
        $log->info($mensajeLog, ["archivo:" => $archivo]);
    }
}
