<?php

session_start();

if (!empty($_SESSION["edad"])) {
  $edad = $_SESSION["edad"];
} else {
  $edad = "";
}

if (!empty($_SESSION["nombre"])) {
  $nombre = $_SESSION["nombre"];
} else {
  $nombre = "";
}

$aficiones = $_SESSION["aficiones"] ?? [];

?>


<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="estilos.css" title="Color">
  <title>03_stickyform</title>
</head>

<body class="body-tipo2">
  <header>
    <h1>3 Sticky form</h1>
  </header>
  <main>

    <!-- usar 
       action = "< ?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"  
     -->
    <form action="procesar.php" method="post">
      <p>Nombre: <input type="text" name="nombre" value="<?= $nombre ?>"></p>
      <p>Edad: <input type="text" name="edad" value="<?= $edad ?>"></p>

      <input type="radio" id="sexo_masculino" name="sexo" value="M" <?php echo isset($_SESSION['sexo']) && $_SESSION['sexo'] == "M" ? "checked" : ""; ?>>
      <label for="sexo_masculino">MASCULINO</label>

      <input type="radio" id="sexo_femenino" name="sexo" value="F" <?php echo isset($_SESSION['sexo']) && $_SESSION['sexo'] == "F" ? "checked" : ""; ?>>
      <label for="sexo_femenino">FEMENINO</label>

      <p>
        <input type="checkbox" name="aficiones[]" value="musica" <?php if (in_array("musica", $aficiones)) echo "checked"; ?>> Musica<br />
        <input type="checkbox" name="aficiones[]" value="cine" <?php if (in_array("cine", $aficiones)) echo "checked"; ?>> Cine<br />
        <input type="checkbox" name="aficiones[]" value="lectura" <?php if (in_array("lectura", $aficiones)) echo "checked"; ?>> Lectura<br />
      </p>

      </p>
      <p><input type="submit" name="submit" value="Enviar"></p>
    </form>

    <?php
    // Muestro errores si los hay
    if (isset($_SESSION["error"]["nombre"]))
      echo ("<p class=\"error\">" . $_SESSION["error"]["nombre"] . "</p>");

    if (isset($_SESSION["error"]["edad"]))
      echo ("<p class=\"error\">" . $_SESSION["error"]["edad"] . "</p>");

    if (isset($_SESSION["error"]["sexo"]))
      echo ("<p class=\"error\">" . $_SESSION["error"]["sexo"] . "</p>");

    if (isset($_SESSION["error"]["aficiones"]))
      echo ("<p class=\"error\">" . $_SESSION["error"]["aficiones"] . "</p>");

    unset($_SESSION["error"]["nombre"]);
    unset($_SESSION["error"]["edad"]);
    unset($_SESSION["error"]["sexo"]);
    unset($_SESSION["error"]["aficiones"]);

    unset($_SESSION["nombre"]);
    unset($_SESSION["edad"]);
    unset($_SESSION["sexo"]);
    unset($_SESSION["aficione"]);
    ?>

  </main>
  <footer>
    <hr>
    <p>Autor: Marcos López González</p>
  </footer>
</body>

</html>