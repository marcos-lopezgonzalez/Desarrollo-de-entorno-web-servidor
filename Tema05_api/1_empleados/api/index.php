<?php

require __DIR__ . "/vendor/autoload.php";

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
// header("HTTP/1.1 200 OK");

$uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$param = parse_url($_SERVER["REQUEST_URI"], PHP_URL_QUERY);
$requestMethod = $_SERVER["REQUEST_METHOD"];

// echo($uri); echo("\n");
// echo($param); echo("\n");
// echo($requestMethod); echo("\n");

manejarRequest($uri, $requestMethod, $param);
