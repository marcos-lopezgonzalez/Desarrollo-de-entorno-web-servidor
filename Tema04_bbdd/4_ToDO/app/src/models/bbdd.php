<?php

namespace App\models;

require __DIR__ . "/../../vendor/autoload.php";

use PDO;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use PDOException;
use PDOStatement;

class BBDD
{
    private PDO | null $conexionPDO;
    private Logger $log;
    private bool $conectado;
    public function __construct()
    {
        $this->log = new Logger("app");
        $this->log->pushHandler(new StreamHandler(__DIR__ . "/../../app.log"));

        $configPath = __DIR__ . "/../config.json";
        $config = json_decode(file_get_contents($configPath), true);

        $dbMotor = $config["dbMotor"];
        $host = $config["mysqlHost"];
        $user = $config["mysqlUser"];
        $password = $config["mysqlPassword"];
        $database = $config["mysqlDatabase"];

        // DSN ejemplo mysql:dbname=test;host=localhost;charset=uft8mb4
        $dsn = "$dbMotor:host=$host;dbname=$database;charset=utf8mb4";

        try {
            $this->conexionPDO = new PDO($dsn, $user, $password);
            $this->conexionPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conectado = true;
        } catch (PDOException $e) {
            $this->conexionPDO = null;
            $this->conectado = false;
            $this->log->error("Fallo en el CONSTRUCTOR creando el objeto PDO");
            $this->log->error($e->getMessage(), ["archivo" => "bbdd.php"]);
        }
    }

    function isConectado()
    {
        return $this->conectado;
    }

    //Método para listar tareas
    public function getData($sql, array $parametros = []): PDOStatement | null
    {
        try {
            $sentencia = $this->conexionPDO->prepare($sql);
            $sentencia->execute($parametros);
            return $sentencia;
        } catch (PDOException $e) {
            // echo $e->getMessage();
            $this->log->error("Error en GET DATA");
            $this->log->error($e->getMessage(), ["archivo" => "bbdd.php"]);
            return null;
        }
    }

    public function insertarTarea(Tarea $_tarea)
    {
        $sql = "INSERT INTO tareas (descripcion, completada, fecha_creacion) VALUES (:descripcion, :completada, :fecha_creacion)";
        try {
            $sentencia = $this->conexionPDO->prepare($sql);
            $sentencia->bindParam("descripcion", $_tarea->descripcion);
            $sentencia->bindParam("completada", $_tarea->completada);
            $sentencia->bindParam("fecha_creacion", $_tarea->fecha_creacion->format("Y-m-d"));
            $sentencia->execute();
            return true;
        } catch (PDOException $e) {
            $this->log->error("ERROR en INSERTAR TAREA");
            $this->log->error($e->getMessage(), ["archivo" => "bbdd.php"]);
            return null;
        }
    }

    public function borrarTarea($_id)
    {
        $sql = "DELETE FROM tareas WHERE id = :id";
        try {
            $sentencia = $this->conexionPDO->prepare($sql);
            $sentencia->bindParam("id", $_id);
            $sentencia->execute();
            return true;
        } catch (PDOException $e) {
            $this->log->error("ERROR en BORRAR TAREA");
            $this->log->error($e->getMessage(), ["archivo" => "bbdd.php"]);
            return null;
        }
    }

    public function completarTarea($_id)
    {
        $sql = "UPDATE tareas set completada = true WHERE id = :id";
        try {
            $sentencia = $this->conexionPDO->prepare($sql);
            $sentencia->bindParam("id", $_id);
            $sentencia->execute();
            return true;
        } catch (PDOException $e) {
            $this->log->error("ERROR en COMPLETAR TAREA");
            $this->log->error($e->getMessage(), ["archivo" => "bbdd.php"]);
            return null;
        }
    }
}
