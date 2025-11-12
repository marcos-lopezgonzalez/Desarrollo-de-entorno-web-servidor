<?php
require __DIR__ . "/vendor/autoload.php";

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$log = new Logger("app");
$log->pushHandler(new StreamHandler("app.log"));
$log->error("Error generico");

$nombre = "Marcos";
$log->debug("Debug: $nombre");

var_dump($log);