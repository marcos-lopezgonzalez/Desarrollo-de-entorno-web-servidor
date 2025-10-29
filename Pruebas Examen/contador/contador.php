<?php
session_start();

if (!isset($_COOKIE["nPulsacione"]))
    setcookie("nPulsaciones", 0, time() + 3600, "/");

if (!isset($_SESSION["numero"]))
    $_SESSION["numero"] = 0;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $numero = $_SESSION["numero"];
    $nPulsaciones = $_COOKIE["nPulsaciones"];

    if ($_POST["accion"] === "sumar") {
        $numero++;
        $nPulsaciones++;
        setcookie("nPulsaciones", $nPulsaciones, time() + 3600, "/");
        $_SESSION["numero"] = $numero;
    } else if ($_POST["accion"] === "restar") {
        $numero--;
        $nPulsaciones++;
        setcookie("nPulsaciones", $nPulsaciones, time() + 3600, "/");
        $_SESSION["numero"] = $numero;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?> " method="post">
    <input type="submit" name="accion" value="sumar">
    <input type="submit" name="accion" value="restar">
    <p>Numero: <?= $numero ?></p>
    <p>Pulsaciones: <?= $nPulsaciones ?></p>
</form>

<body>

</body>

</html>