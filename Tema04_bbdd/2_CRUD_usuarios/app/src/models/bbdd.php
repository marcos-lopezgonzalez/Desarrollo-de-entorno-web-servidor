<?php

require_once __DIR__ . "/../config.php";

class BBDD
{

    private $conexionPDO;
    private static $instancia;
    private string $dbMotor;
    private string $host;
    private string $database;
    private string $username;
    private string $password;

    private function __construct()
    {
        global $dbMotor;
        global $mysqlHost;
        global $mysqlDatabase;
        global $mysqlUser;
        global $mysqlPassword;

        $this->dbMotor = $dbMotor;
        $this->host = $mysqlHost;
        $this->database = $mysqlDatabase;
        $this->username = $mysqlUser;
        $this->password = $mysqlPassword;

        $dsnConBBDD = "$this->dbMotor:host=$this->host;dbname=$this->database;charset=utf8mb4";
        $dsnSinBBDD = "$this->dbMotor:host=$this->host;charset=utf8mb4";

        try {
            $this->conexionPDO = new PDO($dsnConBBDD, $this->username, $this->password);
            // echo ("<p>Exito en la conexionPDO a la BBDD '$this->database' con PDO</p>");
            $this->conexionPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // echo "<p>Error: No puede conectarse con la base de datos {$e->getMessage()}</p>";
        }
    }

    public static function getInstance()
    {
        if (!self::$instancia) {
            self::$instancia = new self();
        }
        return self::$instancia;
    }

    public function getConection()
    {
        return $this->conexionPDO;
    }

    //Prohibe la duplicación de la conexión
    private function __clone() {}

    public function getData($sql, array $parametros = [])
    {
        try {
            $sentencia = $this->conexionPDO->prepare($sql);
            $sentencia->execute($parametros);
            return $sentencia;
        } catch (PDOException $e) {
            echo $e->getMessage();
            die;
        }
    }

    //Método para insertar un usuario en la bbdd
    public function insertarUsuario(Usuario $_usuario)
    {
        $sql = "INSERT INTO usuarios (nombre, apellidos, usuario, password, fecha_nac) 
             VALUES (:nombre, :apellidos, :usuario, :password, :fecha_nac)";

        try {
            $sentencia = $this->conexionPDO->prepare($sql);
            $sentencia->bindParam(":nombre", $_usuario->nombre);
            $sentencia->bindParam(":apellidos", $_usuario->apellidos);
            $sentencia->bindParam(":usuario", $_usuario->usuario);
            $sentencia->bindParam(":password", $_usuario->password);
            $sentencia->bindParam(":fecha_nac", $_usuario->fecha_nac->format("Y-m-d"));
            $sentencia->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    //Método para borrar usuario en la bbdd
    public function borrarUsuario(int $_id)
    {
        $sql = "DELETE FROM usuarios WHERE id = :id";
        try {
            $sentencia = $this->conexionPDO->prepare($sql);
            $sentencia->bindParam(":id", $_id);
            $sentencia->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function actualizarUsuario(Usuario $_usuario)
    {
        $id = $_usuario->id;
        $nombre = $_usuario->nombre;
        $apellidos = $_usuario->apellidos;
        $usuario = $_usuario->usuario;
        $password = $_usuario->password;
        $fecha_nac = $_usuario->fecha_nac->format("Y-m-d");

        if (is_null($password)) {
            $sql = "UPDATE usuarios SET 
                nombre = :nombre,
                apellidos = :apellidos,
                usuario = :usuario,
                fecha_nac = :fecha_nac 
                WHERE id = :id";
        } else {
            $sql = "UPDATE usuarios SET 
                nombre = :nombre,
                apellidos = :apellidos,
                usuario = :usuario,
                password = :password,
                fecha_nac = :fecha_nac 
                WHERE id = :id";
        }

        try {
            $sentencia = $this->conexionPDO->prepare($sql);
            $sentencia->bindParam(":nombre", $nombre);
            $sentencia->bindParam(":apellidos", $apellidos);
            $sentencia->bindParam(":usuario", $usuario);
            if (!is_null($password))
                $sentencia->bindParam(":password", $password);
            $sentencia->bindParam(":fecha_nac", $fecha_nac);
            $sentencia->bindParam(":id", $id);
            $sentencia->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}
