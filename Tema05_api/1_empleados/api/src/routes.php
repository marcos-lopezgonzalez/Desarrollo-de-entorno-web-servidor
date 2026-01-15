<?php

require __DIR__ . '/../vendor/autoload.php';

use App\models\BBDD;

function manejarRequest($uri, $requestMethod, $param)
{
    $db = new BBDD();

    if (!$db->isConectado()) {
        // 500 Internal Server Error
        http_response_code(500);
        $respuesta = ["error" => "No es posible contectarse a la base de datos"];
        echo json_encode($respuesta);
        die;
    }


    $partes = explode("/", $uri);
    // print_r($partes);

    if ($partes[4] !== "api" || $partes[5] != "empleados") {
        header("HTTP/1.1 401 Bad Request");
        $respuesta = ["mensaje" => "No existe el endpoint"];
        echo json_encode($respuesta);
        die;
    }

    $userId = $partes[6] ?? null;

    switch ($requestMethod) {
        case "GET":
            // -------------------------
            // Endpoint /api/empleados/X
            // -------------------------
            if ($userId !== null && $userId != "") {
                $sql = "SELECT * FROM empleados WHERE id = :id";
                $statement = $db->getData($sql, ["id" => $userId]);
                $respuesta = $statement->fetch(PDO::FETCH_ASSOC);

                if (empty($respuesta)) {
                    http_response_code(404);
                    $respuesta = ["error" => "No existe el usuario con id $userId"];
                    echo json_encode($respuesta);
                    die;
                } else {
                    http_response_code(200);
                    // $respuesta = ["mensaje" => "Mando al empleado $userId"];
                    echo json_encode($respuesta);
                    die;
                }
            }
            // -------------------------
            // Endpoint /api/empleados
            // -------------------------
            else {
                $sql = "SELECT * FROM empleados";
                $statement = $db->getData($sql);
                $respuesta = $statement->fetchAll(PDO::FETCH_ASSOC);

                http_response_code(200);
                // $respuesta = ["mensaje" => "Mando todos los empleados"];
                echo json_encode($respuesta);
                die;
            }
            break;

        case "POST":
            //-------------------------------
            //Endpoint POST /api/empleados/
            //-------------------------------
            $data = json_decode(file_get_contents('php://input'), TRUE);
            //....................

            $nombre = $data["nombre"] ?? null;
            $direccion = $data["direccion"] ?? null;
            $salario = $data["salario"] ?? null;

            if (!isset($nombre) || !isset($direccion) || !isset($salario)) {
                http_response_code(400);
                $respuesta = "Campos necesarios vacíos";
                echo json_encode($respuesta);
            }

            if ($db->insertarEmpleado($nombre, $direccion, $salario)) {
                http_response_code(200);
                $respuesta = "Empleado creado correctamente";
                echo json_encode($respuesta);
            } else {
                http_response_code(500);
                $respuesta = "Error al crear empleado";
                echo json_encode($respuesta);
            }
            die;
            break;

        case "DELETE":
            //-------------------------------
            //Endpoint DELETE /api/empleados/X
            //-------------------------------
            $data = json_decode(file_get_contents('php://input'), TRUE);
            //....................

            $userId = $data["id"] ?? null;

            if (!isset($userId)) {
                http_response_code(400);
                $respuesta = "No se ha especificado ID";
                echo json_encode($respuesta);
                die;
            }

            if ($db->borrarEmpleado($userId)) {
                http_response_code(200);
                $respuesta = "Empleado borrado correctamente";
                echo json_encode($respuesta);
            } else {
                http_response_code(500);
                $respuesta = "Error al borrar empleado";
                echo json_encode($respuesta);
            }
            die;
            break;

        case "PATCH":
            //-------------------------------
            //Endpoint DELETE /api/empleados/X
            //-------------------------------
            $data = json_decode(file_get_contents('php://input'), TRUE);
            //....................

            if (!isset($userId)) {
                http_response_code(400);
                $respuesta = "No se ha especificado ID";
                echo json_encode($respuesta);
                die;
            }

            if ($db->actualizarEmpleado($userId, $data)) {
                $respuesta = ['mensaje' => "Empleado con id $userId actualizado."];
                http_response_code(200);
                echo json_encode($respuesta);
                exit();
            } else {
                $respuesta = ['error' => 'Error al actualizar empleado.'];
                http_response_code(500);
                echo json_encode($respuesta);
                exit();
            }
            break;

        default:
            http_response_code(400);
            $respuesta = ["mensaje" => "No existe el endpoint"];
            echo json_encode($respuesta);
            die;
            break;
    }
}
