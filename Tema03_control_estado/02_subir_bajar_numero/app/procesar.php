<?php

session_start();

if (!isset($_POST["accion"])) {
    header("Location: index.php");
}

$accion = $_POST["accion"];
$nPulsaciones = $_COOKIE["nPulsaciones"];

switch ($accion) {
    case "subir":
        if ($_SESSION["numero"] < 9) {
            $_SESSION["numero"]++;
            $nPulsaciones++;
            setcookie("nPulsaciones", $nPulsaciones, time() + (7 * 24 * 60 * 60), "/");
        }

        header("Location: index.php");
        die;
        break;

    case "bajar":
        if (0 < $_SESSION["numero"]) {
            $_SESSION["numero"]--;
            $nPulsaciones++;
            setcookie("nPulsaciones", $nPulsaciones, time() + (7 * 24 * 60 * 60), "/");
        }
        header("Location: index.php");
        die;
        break;

    case "cero";
        $_SESSION["numero"] = 0;
        setcookie("nPulsaciones", 0, time() + (7 * 24 * 60 * 60), "/");
        header("Location: index.php");
        die;
        break;

    default:
        break;
}
