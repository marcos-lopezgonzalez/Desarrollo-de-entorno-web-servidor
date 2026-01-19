<?php

namespace App\models;

use PDO;
use PDOException;

require __DIR__ . "/../../vendor/autoload.php";

class BBDD
{
    private PDO | null $conexion;

    public function __construct()
    {
        $configPath = __DIR__ . "/../config.json";
        $config = json_decode(file_get_contents($configPath), true);

        $motor = $config["dbMotor"];
        $host = $config["mysqlHost"];
        $user = $config["mysqlUser"];
        $pass = $config["mysqlPassword"];
        $database = $config["mysqlDatabase"];

        $dsn = "$motor:host=$host;dbname=$database;charset=utf8mb4";

        try {
            $this->conexion = new PDO($dsn, $user, $pass);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo ($e);
            $this->conexion = null;
        }
    }

    public function conectado()
    {
        return isset($this->conexion);
    }

    public function getData($sql, $params = [])
    {
        try {
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->execute($params);
            return $sentencia;
        } catch (PDOException $e) {
            return null;
        }
    }

    public function addEmpleado($empleado)
    {
        $sql = "INSERT INTO empleados (nombre, direccion, salario) VALUES (:nombre, :direccion, :salario)";
        try {
            $sentencia = $this->conexion->prepare($sql);

            $sentencia->bindParam(":nombre", $empleado->nombre);
            $sentencia->bindParam(":direccion", $empleado->direccion);
            $sentencia->bindParam(":salario", $empleado->salario);

            $sentencia->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function deleteEmpleado($id)
    {
        $sql = "DELETE FROM empleados WHERE id = :id";
        try {
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindParam(":id", $id);
            $sentencia->execute();
            return $sentencia->rowCount() > 0;
        } catch (PDOException $e) {
            return false;
        }
    }
}
