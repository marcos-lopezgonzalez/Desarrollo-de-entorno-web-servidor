<?php

require __DIR__ . "/../../vendor/autoload.php";

use App\models\BBDD;

session_start();

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo ("No tienes acceso a esto");
    die;
}

$usuario = $_POST["usuario"];
$password = $_POST["password"];

$sql = "SELECT * FROM usuarios WHERE usuario = :usuario";

$parametros = [
    "usuario" => $usuario
];

$db = new BBDD();
$sentencia = $db->getData($sql, $parametros);

if ($sentencia->rowCount() === 0) {
    // echo ("No existe usuario");
    $mensaje = "No existe usuario";
    header("Location: ./../views/login.php?mensaje=$mensaje");
    die;
}

// $registro = $sentencia->fetch(PDO::FETCH_OBJ);

$registro = $sentencia->fetch(PDO::FETCH_OBJ);
if (password_verify($password, $registro->password)) {
    // echo("Login correcto");
    $_SESSION["logeado"] = true;
    if ($registro->es_admin) {
        $_SESSION["admin"] = true;
    }
    header("Location: ./../views/login.php");
    die;
} else {
    // echo("Login incorrecto");
    $mensaje = "Login incorrecto";
    header("Location: ./../views/login.php?mensaje=$mensaje");
    die;
}
