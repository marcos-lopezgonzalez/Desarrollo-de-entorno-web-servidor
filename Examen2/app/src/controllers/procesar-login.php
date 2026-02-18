<?php
session_start();

require __DIR__ . "/../../vendor/autoload.php";

use App\models\Basedatos;
use App\models\Usuario;

$email = $_POST["email"];
$password = $_POST["password"];

$db = new Basedatos();
$sql = "SELECT * FROM usuario WHERE email = :email";
$parametros = [
    "email" => $email
];

$sentencia = $db->getData($sql, $parametros);

if ($sentencia->rowCount() === 0) {
    $mensaje = "No existe usuario en BBDD";
    header("Location: ./../views/login.php?mensaje=$mensaje");
    die;
}

$registro = $sentencia->fetch(PDO::FETCH_OBJ);
$usuario = new Usuario($registro->id, $registro->nombre, $registro->email, $registro->password, $registro->rol);

if (password_verify($password, $usuario->password)) {
    // echo("Login correcto");
    $_SESSION["logeado"] = true;
    // $_SESSION["nombre"] = $registro->nombre;
    $_SESSION["id"] = $usuario->id;
    $_SESSION["rol"] = $usuario->rol;
    enviar_log("info", "Usuario $usuario->nombre se ha logeado");
    header("Location: ./../views/login.php");
    die;
} else {
    // echo("Login incorrecto");
    $mensaje = "Login incorrecto";
    header("Location: ./../views/login.php?mensaje=$mensaje");
    die;
}
