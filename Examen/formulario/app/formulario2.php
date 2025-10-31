<?php
session_start();
// $_SESSION["error"] = null;
$_SESSION["error"]["nombre"] = null;
$_SESSION["error"]["curso"] = null;

$asignaturas = $_SESSION["asignaturas"] ?? [];

if ($_SERVER["REQUEST_METHOD"] === "POST" || isset($_SESSION["error"]["asignaturas"])) {
  $nombre = $_POST["nombre"] ?? $_SESSION["nombre"] ?? "";
  $curso = $_POST["curso"] ?? $_SESSION["curso"] ?? "";

  if ($nombre === "") {
    $_SESSION["error"]["nombre"] = "Falta el nombre";
    $_SESSION["nombre"] = null;
  } else {
    $_SESSION["nombre"] = $nombre;
  }

  if ($curso === "") {
    $_SESSION["error"]["curso"] = "Hay que escoger un curso";
    $_SESSION["curso"] = null;
  } else {
    $_SESSION["curso"] = $curso;
  }

  if (isset($_SESSION["error"]["asignaturas"])) {
    $mensajeError = $_SESSION["error"]["asignaturas"];
  } else if (isset($_SESSION["error"]["nombre"]) || isset($_SESSION["error"]["curso"])) {
    //header("Location: formulario1.php");
    echo ("<p>Hola1</p>");
    // die;
  }
} else {
  //header("Location: formulario1.php");
  echo ("<p>Hola2</p>");
  // die;
}


?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/estilos.css" title="Color">
  <title>Sticky</title>
</head>

<body class="body-gris">
  <header>
    <h1>FORMULARIO DE MATRICULACION</h1>
    <h2>Eleccion de materias de XXXXXX</h2>
  </header>
  <main>
    <!-- 
        <input type="checkbox" name="" value="programacion">Programación<br />
        <input type="checkbox" name="" value="basedatos">Bases de Datos<br />
        <input type="checkbox" name="" value="lmarcas">Lenguaje de Marcas<br />
        <input type="checkbox" name="" value="ingles">Ingles<br />
        <input type="checkbox" name="" value="digitalizacion">Digitalizacion<br />
        <input type="checkbox" name="" value="servidor">Desarrollo Web Servidor<br />
        <input type="checkbox" name="" value="cliente">Desarrollo Web Cliente<br />
        <input type="checkbox" name="" value="interfaces">Diseño de Interfaces<br />
        <input type="checkbox" name="" value="ia">IA generativa<br />
        <input type="checkbox" name="" value="despliegue">Despliegue<br /> 
        -->
    <form action="mostrar-datos.php" method="post">
      <p>
        <?php
        if ($_SESSION["curso"] === "daw1") {
          echo "<input type=\"checkbox\" name=\"asignaturas[]\" value=\"programacion\"";
          if (in_array("programacion", $asignaturas)) echo "checked";
          echo ">Programación<br />";
          echo "<input type=\"checkbox\" name=\"asignaturas[]\" value=\"basedatos\"";
          if (in_array("basedatos", $asignaturas)) echo "checked";
          echo "
          >Base de Datos<br />";
          echo "<input type=\"checkbox\" name=\"asignaturas[]\" value=\"lmarcas\"";
          if (in_array("lmarcas", $asignaturas)) echo "checked";
          echo "
          >Lenguaje de Marcas<br />";
          echo "<input type=\"checkbox\" name=\"asignaturas[]\" value=\"ingles\"";
          if (in_array("ingles", $asignaturas)) echo "checked";
          echo "
          >Ingles<br />";
          echo "<input type=\"checkbox\" name=\"asignaturas[]\" value=\"digitalizacion\"";
          if (in_array("digitalizacion", $asignaturas)) echo "checked";
          echo "
          >Digitalizacion<br />";
        } else if ($_SESSION["curso"] === "daw2") {
          echo "<input type=\"checkbox\" name=\"asignaturas[]\" value=\"servidor\"";
          if (in_array("servidor", $asignaturas)) echo "checked";
          echo ">Desarrollo Web Servidor<br />";
          echo "<input type=\"checkbox\" name=\"asignaturas[]\" value=\"cliente\"";
          if (in_array("cliente", $asignaturas)) echo "checked";
          echo ">Desarrollo Web Cliente<br />";
          echo "<input type=\"checkbox\" name=\"asignaturas[]\" value=\"interfaces\"";
          if (in_array("interfaces", $asignaturas)) echo "checked";
          echo ">Diseño de interfaces<br />";
          echo "<input type=\"checkbox\" name=\"asignaturas[]\" value=\"ia\"";
          if (in_array("ia", $asignaturas)) echo "checked";
          echo ">IA generativa<br />";
          echo "<input type=\"checkbox\" name=\"asignaturas[]\" value=\"despliegue\"";
          if (in_array("despliegue", $asignaturas)) echo "checked";
          echo ">Despliegue<br />";
        }

        if (isset($_SESSION["error"]["asignaturas"])) {
          echo ("<p class='error'>" . $_SESSION["error"]["asignaturas"] . "</p>");
        }
        ?>
        <button name="accion" value="volver" type="submit">VOLVER</button>
        <button name="accion" value="mostrar" type="submit">MOSTRAR DATOS</button>
      </p>
    </form>

  </main>
  <footer>
    <hr>
    <p>IES Floridablanca</p>
  </footer>
</body>

</html>