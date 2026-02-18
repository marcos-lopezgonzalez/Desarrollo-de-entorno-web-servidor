<?php

//=============== AYUDA =====================================
//--------------cargar json a array asociativo
//ARRAY_ASOCIATIVO = json_decode(file_get_contents(RUTA), true);


//------------- Para conectar
//DSN = "mysql:dbname=test;host=127.0.0.1;charset=utf8mb4"

//CONEXION = new PDO(DSN, USUARIO, PASSWORD);
//CONEXION->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//Las excepciones se recogen con (PDOException $e) Y para ver el mensaje
//tenemos el método "getMessage()"

// -------- ejecutar consultas

// sentencia = conexionPDO->prepare(CADENA CON LA CONSULTAD SQL);

// OPCION1
// sentencia -> bindParam(":ETIQUETA",VALOR);
// sentencia -> execute();

// OPCION2
// sentencia -> execute([":ETIQUETA" => VALOR, ":ETIQUETA" => VALOR, ... ]);


//=============== AYUDA =====================================

namespace App\models;

require __DIR__ . "/../../vendor/autoload.php";

use PDO;
use PDOException;
use PDOStatement;

class Basedatos
{
    private PDO | null $conexionPDO;
    private bool $conectado;

    public function __construct()
    {
        $configPath = __DIR__ . "/../config/config.json";
        $config = json_decode(file_get_contents($configPath), true);

        $dbMotor = $config["dbMotor"];
        $host = $config["mysqlHost"];
        $database = $config["mysqlDatabase"];
        $username = $config["mysqlUser"];
        $password = $config["mysqlPassword"];

        $dsn = "$dbMotor:host=$host;dbname=$database;charset=utf8mb4";

        try {
            $this->conexionPDO = new PDO($dsn, $username, $password);
            $this->conexionPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conectado = true;
            // enviar_log("info", "Conexión a BBDD correcta");
        } catch (PDOException $e) {
            $this->conexionPDO = null;
            $this->conectado = false;
            enviar_log("error", "ERROR al conectarse a BBDD");
            enviar_log("error", "ERROR: " . $e->getMessage());
        }
    } //fin constructor

    public function isConectado()
    {
        return $this->conectado;
    }

    public function getData($sql, array $parametros = []): PDOStatement | null
    {
        try {
            $sentencia = $this->conexionPDO->prepare($sql);
            $sentencia->execute($parametros);
            // enviar_log("info", "Lanzando consulta: $sql");
            return $sentencia;
        } catch (PDOException $e) {
            echo $e->getMessage();
            // die;
            enviar_log("error", "ERROR al lanzar la consulta $sql");
            enviar_log("error", "ERROR: " . $e->getMessage());
            return null;
        }
    }

    public function resolverIncidencia($_id, $_resolucion)
    {
        $sql = "UPDATE incidencia SET resuelta = TRUE, resolucion = :resolucion WHERE id = :id";
        try {
            $sentencia = $this->conexionPDO->prepare($sql);
            $sentencia->bindParam(":resolucion", $_resolucion);
            $sentencia->bindParam(":id", $_id);
            $sentencia->execute();
            enviar_log("info", "INCIDENCIA id:$_id RESUELTA. RESOLUCION: $_resolucion");
            return true;
        } catch (PDOException $e) {
            echo ($e->getMessage());
            enviar_log("error", "ERROR al resolver incidencia $_id");
            enviar_log("error", "ERROR: " . $e->getMessage());
            return null;
        }
    }
} //fin clase
