<?php

require_once __DIR__ . "/includes/funciones.php";

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
//header("Content-Type: text/plain; charset=UTF-8");

header("Access-Control-Allow-Methods: GET,POST,PATCH,DELETE");
header("Access-Control-Max-Age: 3400");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//SOLO PATH
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

//SOLO PARAMETROS
$param = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);

$requestMethod = $_SERVER["REQUEST_METHOD"];

//Un alias: getallheaders()
$headers = apache_request_headers();

// print_r($uri);
// print("\n");
// print_r($headers);
// print("\n");
// print_r($param);


$keyRecibida = $headers["x-API-key"] ?? "";
$rol = obtenerRol($keyRecibida);

if (!$rol) {
    http_response_code(401);
    echo json_encode(["error" => "API key no encontrada"]);
    exit;
}

//
$partes = explode("/", $uri);

if ($partes[4] !== "api" || $partes[5] !== "libros") {
    http_response_code(400);
    $respuesta = ["mensaje" => "No existe el endpoint"];
    echo json_encode($respuesta);
    die;
}

$titulo = $partes[6] ?? null;

switch ($requestMethod) {
    case "GET":
        //Endpoint GET /api/libros/
        if ($titulo === null) {
            $libros = obtenerLibros();
            http_response_code(200);
            echo json_encode($libros);
            die;
        }
        //Endpoint GET /api/libros/titulo
        else {
            $libros = obtenerLibros($titulo);
            http_response_code(200);
            if (!$libros) {
                $respuesta = ["mensaje" => "No hay libros con ese titulo"];
                echo json_encode($respuesta);
            } else {
                echo json_encode($libros);
            }
            die;
        }

        break;
    case "POST":
        //Endpoint POST /api/libros/
        if ($rol === "ADMIN") {
            $data = json_decode(file_get_contents("php://input", TRUE));
            if (insertarLibro($data)) {
                $respuesta = ["mensaje" => "Libro añadido"];
                http_response_code(200);
                echo json_encode($respuesta);
                die;
            }
        } else {
            $respuesta = ["error" => "No tienes permisos"];
            http_response_code(400);
            echo json_encode($respuesta);
            exit();
        }
        break;
}
