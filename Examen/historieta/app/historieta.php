<?php
session_start();

if (!isset($_SESSION["vineta"]))
    $_SESSION["vineta"] = 1;
else {
    $accion = $_POST["accion"] ?? "";

    if ($accion === "anterior") {
        if (1 < $_SESSION["vineta"]) {
            $_SESSION["vineta"]--;
        }
    } else if ($accion === "siguiente") {
        if ($_SESSION["vineta"] < 6) {
            $_SESSION["vineta"]++;
        }
    } else if ($accion === "volver") {
        header("Location: index.php");
        die;
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historieta</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <!-- ejemplo de poner una viñeta -->
    <div class="viñeta">
        <!-- <img src="./img/1.png" alt="Image 1" width="500px"> -->
        <img src="
         <?php
            echo ("./img/" . $_SESSION["vineta"] . ".png");
            ?>
         " alt="Image 1" width="500px">
    </div>


    <!-- como poner los botones -->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
        <div style="text-align: center;">
            <button type="submit" name="accion" value="anterior" class="movimiento">⬅️ Anterior</button>
            <button type="submit" name="accion" value="siguiente" class="movimiento">Siguiente ➡️</button>
        </div>
        <button type="submit" name="accion" value="volver" class="movimiento">INICIO</button>
    </form>



</body>

</html>