<?php

namespace App\models;

require __DIR__ . '/../../vendor/autoload.php';

use PDO;
use PDOException;
use PDOStatement;


class BBDD
{
    private PDO|null $conexionPDO;

    public function __construct()
    {
        $configPath = __DIR__ . '/../config.json';
        $config = json_decode(file_get_contents($configPath), true);

        $dbmotor = $config["dbMotor"];
        $host = $config["mysqlHost"];
        $user = $config["mysqlUser"];
        $password = $config["mysqlPassword"];
        $database = $config["mysqlDatabase"];

        //DSN ejemplo: 'mysql:dbname=test;host=localhost'
        $dsn = "$dbmotor:host=$host;dbname=$database;charset=utf8mb4";

        try {
            $this->conexionPDO = new PDO($dsn, $user, $password);
            $this->conexionPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $this->conexionPDO = null;
        }
    }

    public function getData(string $sql, array $parametros = []): PDOStatement | null
    {
        try {
            $sentencia = $this->conexionPDO->prepare($sql);
            $sentencia->execute($parametros);
            return $sentencia;
        } catch (PDOException $e) {
            return null;
        }
    }

    public function isConectado()
    {
        return $this->conexionPDO !== null;
    }

    public function insertarEmpleado($nombre, $direccion, $salario)
    {
        $sql = "INSERT INTO empleados (nombre, direccion, salario) VALUES (:nombre, :direccion, :salario)";
        try {
            $sentencia = $this->conexionPDO->prepare($sql);
            $sentencia->bindParam("nombre", $nombre);
            $sentencia->bindParam("direccion", $direccion);
            $sentencia->bindParam("salario", $salario);
            $sentencia->execute();
            return true;
        } catch (PDOException $e) {
            return null;
        }
    }

    public function borrarEmpleado($id)
    {
        $sql = "DELETE FROM empleados WHERE id = :id";
        try {
            $sentencia = $this->conexionPDO->prepare($sql);
            $sentencia->bindParam("id", $id);
            $sentencia->execute();
            return true;
        } catch (PDOException $e) {
            return null;
        }
    }

    public function actualizarEmpleado(int $userId, array $data)
    {
        //Solo actualizamos los campos que vengan. 
        //Voy a construir dinamicamente el UPDATE con implode
        //En lugar de hacer el binding con :tag, lo haré con ?

        $campos = [];  //hago el binding con la notacion ?
        $valores = [];  //valores a asignar en el binding

        if (isset($data["nombre"])) {
            $campos[] = "nombre = ?";
            $valores[] = $data["nombre"];
        }

        if (isset($data["direccion"])) {
            $campos[] = "direccion = ?";
            $valores[] = $data["direccion"];
        }

        if (isset($data["salario"])) {
            $campos[] = "salario = ?";
            $valores[] = $data["salario"];
        }

        //Añado tambien el ID para hacer el binding
        $valores[] = $userId;

        $sql = "UPDATE empleados SET " . implode(', ', $campos) . " WHERE id = ?";

        try {
            $sentencia = $this->conexionPDO->prepare($sql);
            $sentencia->execute($valores);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}
