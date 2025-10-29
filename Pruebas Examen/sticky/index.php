<?php
session_start();

if (isset($_COOKIE["logged"])) {
  header("Location: bienvenida.php");
}

$usuario = $_SESSION["usuario"] ?? "";
$password = $_SESSION["password"] ?? "";
$sexo = $_SESSION["sexo"] ?? "";
$aficiones = $_SESSION["aficiones"] ?? [];
$error = $_SESSION["error"] ?? "";

session_unset();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
</head>

<body>
  <form action="datos.php" method="post">
    <label>Usuario</label>
    <input type="text" name="usuario" value="<?= $usuario ?>" />
    <br />

    <label>Contraseña</label>
    <input type="password" name="password" value="<?= $password ?>" />
    <br />

    <input type="radio" id="sexo_M" name="sexo" value="M"
      <?php
      echo $sexo === "M" ? "checked" : "";
      ?> />
    <label for=" sexo_M">Masculino</label>
    <br />

    <input type="radio" id="sexo_F" name="sexo" value="F"
      <?php
      echo $sexo === "F" ? "checked" : "";
      ?> />
    <label for="sexo_F">Femenino</label>
    <br />

    <input type="checkbox" name="aficiones[]" value="1"
      <?php
      if (in_array("1", $aficiones)) echo "checked";
      ?> />
    <label>1</label>
    <input type="checkbox" name="aficiones[]" value="2"
      <?php
      if (in_array("2", $aficiones)) echo "checked";
      ?> />
    <label>2</label>
    <input type="checkbox" name="aficiones[]" value="3"
      <?php
      if (in_array("3", $aficiones)) echo "checked";
      ?> />
    <label>3</label>

    <button type="submit">Enviar</button>

    <?php
    if ($error !== "")
      var_dump($error);
    ?>
  </form>
</body>

</html>