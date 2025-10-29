<?php
// session_start();

// if ($_SERVER["REQUEST_METHOD"] !== "POST" && $_SESSION["alreadyLogged"] !== true) {
//     echo ("<p>Que haces picha</p>");
// } else {
//     if (!isset($_SESSION["alreadyLogged"])) {
//         $_SESSION["alreadyLogged"] = true;
//     } else if (!isset($_SESSION["alreadyLogged"])) {
//         echo ("<p>Ya te habias logeado</p>");
//     }


//     echo ("<p>Datos recibidos</p>");

//     $usuario = $_POST["usuario"];
//     $password = $_POST["password"];
//     $sexo = $_POST["sexo"];
//     $aficiones = $_POST["aficiones"];

//     echo ("<p>Usuario: $usuario</p>");
//     echo ("<p>Contraseña: $password</p>");
//     echo ("<p>Sexo: $sexo</p>");
//     echo ("<ul>");
//     for ($i = 0; $i < count($aficiones); $i++) {
//         echo ("<li>$aficiones[$i]</li>");
//     }
//     echo ("</ul>");
// }

session_start();

$usuario = $_POST["usuario"];
$password = $_POST["password"];
$sexo = $_POST["sexo"];
$aficiones = $_POST["aficiones"];
$error = "";

if (!isset($usuario) || $usuario == "") {
    $error .= " usuario";
} else {
    $_SESSION["usuario"] = $usuario;
}

if (!isset($password) || $password == "") {
    $error .= " password";
} else if (strlen($password) < 5) {
    $error .= " contraseñacorta";
} else {
    $_SESSION["password"] = $password;
}

if (!isset($sexo) || $sexo == "") {
    $error .= " sexo";
} else {
    $_SESSION["sexo"] = $sexo;
}

if (!isset($aficiones) || count($aficiones) === 0) {
    $error .= " aficiones";
} else {
    $_SESSION["aficiones"] = $aficiones;
}

$_SESSION["error"] = $error;
if ($error === "")
    setcookie("logged", true, time() + 3600, "/");
header("Location: index.php");
