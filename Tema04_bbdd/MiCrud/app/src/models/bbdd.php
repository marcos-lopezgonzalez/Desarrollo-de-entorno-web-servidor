<?php

namespace App\models;

require __DIR__ . "/../../vendor/autoload.php";

use PDO;
use PDOException;
use PDOStatement;

//================= Para conectar
//DSN = "mysql:dbname=test;host=127.0.0.1;charset=utf8mb4"

//CONEXION = new PDO(DSN, USUARIO, PASSWORD);
//CONEXION->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//Las excepciones se recogen con (PDOException $e) Y para ver el mensaje
//tenemos el método "getMessage()"

//================== ejecutar consultas


// sentencia = conexionPDO->prepare(CADENA CON LA CONSULTAD SQL);

// OPCION1
// sentencia -> bindParam(":ETIQUETA",VALOR);
// sentencia -> execute();

// OPCION2
// sentencia -> execute([":ETIQUETA" => VALOR, ":ETIQUETA" => VALOR, ... ]);


class BBDD
{
    private PDO|null $conexionPDO;
    private bool $conectado;

    public function __construct()
    {
        $configPath = __DIR__ . "/../config.json";
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
            crearLog("info", "Conexión con base de datos establecida correctamente", "bbdd.php");
        } catch (PDOException $e) {
            $this->conexionPDO = null;
            $this->conectado = false;
            crearLog("error", "Fallo en el constructor creando el objeto PDO", "bbdd.php", $e);
        }
    } //fin constructor

    public function isConected()
    {
        return $this->conectado;
    }

    public function getData($sql, array $parametros = []): PDOStatement
    {
        try {
            $sentencia = $this->conexionPDO->prepare($sql);
            $sentencia->execute($parametros);
            // crearLog("info", "Usuario " . $parametros["usuario"] . " logeado", "bbdd.php");
            return $sentencia;
        } catch (PDOException $e) {
            // crearLog("error", "Fallo en el login", "bbdd.php", $e);
            echo $e->getMessage();
            die;
        }
    }

    public function crearDB()
    {
        try {
            $sql = "DROP DATABASE IF EXISTS usuariosDB;
                    CREATE DATABASE usuariosDB CHARACTER SET utf8mb4;
                    USE usuariosDB;

                    CREATE TABLE `usuarios` (
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `nombre` varchar(255) NOT NULL,
                    `apellidos` varchar(255) DEFAULT NULL,
                    `usuario` varchar(255) NOT NULL,
                    `password` varchar(255) NOT NULL,
                    `fecha_nac` datetime NOT NULL,
                    `es_admin` BOOLEAN NOT NULL,
                    PRIMARY KEY (`id`)
                    );

                    INSERT INTO usuarios (nombre, apellidos, usuario, password, fecha_nac, es_admin) VALUES
                    ('María', 'Gómez Ruiz', 'm.gomez', '$2y$10\$pTiLJ/.KIvMaKZJ1g7iv2uYw83Bua9PDiRjKMhneAjYcz897BHmdu', '1990-03-12', 1),
                    ('Carlos', 'Fernández López', 'c.fernandez', '$2y$10\$pTiLJ/.KIvMaKZJ1g7iv2uYw83Bua9PDiRjKMhneAjYcz897BHmdu', '1985-07-25', 0),
                    ('Lucía', 'Martínez Díaz', 'l.martinez', '$2y$10\$pTiLJ/.KIvMaKZJ1g7iv2uYw83Bua9PDiRjKMhneAjYcz897BHmdu', '1992-11-08', 0),
                    ('Andrés', 'Sánchez Ortega', 'a.sanchez', '$2y$10\$pTiLJ/.KIvMaKZJ1g7iv2uYw83Bua9PDiRjKMhneAjYcz897BHmdu', '1998-04-17', 0),
                    ('Elena', 'Torres Navarro', 'e.torres', '$2y$10\$pTiLJ/.KIvMaKZJ1g7iv2uYw83Bua9PDiRjKMhneAjYcz897BHmdu', '2000-01-30', 0);";

            $this->conexionPDO->exec($sql);
        } catch (PDOException $e) {
            echo ($e->getMessage());
        }
    }

    public function borrarUsuario($id)
    {
        try {
            $sql = "DELETE FROM usuarios WHERE id = :id";
            $sentecia = $this->conexionPDO->prepare($sql);
            $sentecia->bindParam(":id", $id);
            $sentecia->execute();
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    public function actualizarUsuario($id, $nombre, $apellidos, $usuario, $password)
    {
        try {
            $sql = "UPDATE usuarios SET 
                nombre = :nombre,
                apellidos = :apellidos,
                usuario = :usuario,
                password = :password 
                WHERE id = :id";

            $sentecia = $this->conexionPDO->prepare($sql);
            $sentecia->bindParam(":nombre", $nombre);
            $sentecia->bindParam(":apellidos", $apellidos);
            $sentecia->bindParam(":usuario", $usuario);
            $sentecia->bindParam(":password", password_hash($password, PASSWORD_DEFAULT));
            $sentecia->bindParam(":id", $id);
            $sentecia->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
            die;
        }
    }
} //fin clase
