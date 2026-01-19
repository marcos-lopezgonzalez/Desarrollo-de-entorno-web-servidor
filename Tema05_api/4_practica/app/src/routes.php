<?php

require __DIR__ . '/../vendor/autoload.php';

use App\models\BBDD;
use App\models\Empleado;

function manejarRequest($uri, $requestMethod, $param)
{
    $db = new BBDD();

    if (!$db->conectado()) {
        http_response_code(500);
        $respuesta = ["error" => "No es posible contectarse a la base de datos"];
        echo json_encode($respuesta);
        die;
    }

    $partes = explode("/", $uri);
    // var_dump($partes);

    if ($partes[4] !== "app" || $partes[5] != "empleados") {
        header("HTTP/1.1 401 Bad Request");
        $respuesta = ["mensaje" => "No existe el endpoint"];
        echo json_encode($respuesta);
        die;
    }

    $empleado = $partes[6] ?? null;

    switch ($requestMethod) {
        case "GET":
            if (isset($empleado) && $empleado != "") {
                $sql = "SELECT * FROM empleados WHERE id = :id";
                $params = ["id" => $empleado];
                $sentencia = $db->getData($sql, $params);
            } else {
                $sql = "SELECT * FROM empleados";
                $sentencia = $db->getData($sql);
            }

            $respuesta = $sentencia->fetchAll(PDO::FETCH_ASSOC);

            if (empty($respuesta)) {
                http_response_code(404);
                echo json_encode(["error" => "No se han encontrado resultados"]);
            } else {
                http_response_code(200);
                echo json_encode($respuesta);
            }
            die;
            break;

        case "POST":
            $data = json_decode(file_get_contents('php://input'), TRUE);

            $nombre = $data["nombre"] ?? null;
            $direccion = $data["direccion"] ?? null;
            $salario = $data["salario"] ?? null;

            $nuevoEmpleado = new Empleado(null, $nombre, $direccion, $salario);

            if ($db->addEmpleado($nuevoEmpleado)) {
                http_response_code(200);
                $respuesta = "Empleado creado correctamente";
                echo json_encode($respuesta);
            } else {
                http_response_code(500);
                $respuesta = "Empleado creado correctamente";
                echo json_encode($respuesta);
            }
            break;

        case "DELETE":
            if ($empleado !== null && $empleado != "") {
                if ($db->deleteEmpleado($empleado)) {
                    http_response_code(200);
                    $respuesta = "Empleado borrado correctamente";
                    echo json_encode($respuesta);
                } else {
                    http_response_code(500);
                    $respuesta = "Error al borrar empleado";
                    echo json_encode($respuesta);
                }
            }
            break;
    }
}
