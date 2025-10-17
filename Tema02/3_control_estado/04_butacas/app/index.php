<?php

// Incializamos sesion para poder usar $_SESSION
session_start();
require_once("includes/funciones.php");

// Para la primera vez que accedemos a la página
// Inicializamos la variable $_SESSION["butacas"] como un array de 3x4 butacas vacias
if (!isset($_SESSION["butacas"])) {
  $_SESSION["butacas"] = [
    [0, 0, 0, 0],
    [0, 0, 0, 0],
    [0, 0, 0, 0]
  ];

  $precio = 0;
}

// Cuando hacemos click en una butaca, es decir, se manda el input con la fila y columna de cada butaca
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $fila = $_POST["fila_seleccionada"];
  $columna = $_POST["columna_seleccionada"];

  //Si la butaca estaba seleccionada
  if ($_SESSION["butacas"][$fila][$columna] == 1)
    $_SESSION["butacas"][$fila][$columna] = 0;
  //Si la butaca NO estaba seleccionada
  else
    $_SESSION["butacas"][$fila][$columna] = 1;

  //Calculamos el precio en función de las butacas seleccionadas (includes/funciones.php)
  $precio = calcularPrecio($_SESSION["butacas"]);
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Butacas</title>
  <link rel="stylesheet" href="assets/css/estilos2.css">
</head>

<body>

  <h1>🎥 Vista de Butacas del Cine</h1>

  <div class="pantalla">PANTALLA</div>

  <!-- Formulario único -->
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" id="formButacas">
    <input type="hidden" id="fila_seleccionada" name="fila_seleccionada">
    <input type="hidden" id="columna_seleccionada" name="columna_seleccionada">
  </form>

  <div class="sala">
    <!-- Mostramos el array de butacas  -->
    <?php
    // Entramos a cada fila
    for ($fila = 0; $fila < count($_SESSION["butacas"]); $fila++) {
      // Entramos a cada item de la fila, es decir, pasamos de columna en columna
      for ($columna = 0; $columna < count($_SESSION["butacas"][$fila]); $columna++) {
        // Si la butaca está seleccionada
        if ($_SESSION["butacas"][$fila][$columna] == 1)
          $src = "assets/asiento-ocupado.png";
        // Si la butaca NO está seleccionada
        else
          $src = "assets/asiento-libre.png";
        echo ("<div>");
        //Mostramos cada butaca con su data-fila, data-columnda y src correspondiente
        echo ("<img class=\"butaca\" data-fila=$fila data-columna=$columna src=\"$src\">");
        echo ("</div>");
      }
    }
    ?>
  </div>

  <script>
    // Al hacer clic en una imagen, guarda el número y envía el formulario. 
    // Vamos a usar DATASET. Para ello, en las imagenes incluifremos el 
    // atributo 'data-fila' y 'data-columna'

    document.querySelectorAll('.butaca').forEach(butaca => {
      butaca.addEventListener('click', () => {
        const fila = butaca.dataset.fila;
        const columna = butaca.dataset.columna;

        console.log("fila:" + fila);
        console.log("columna:" + columna);

        //Asignamos a los campos input hidden el valor
        document.getElementById('fila_seleccionada').value = fila;
        document.getElementById('columna_seleccionada').value = columna;
        document.getElementById('formButacas').submit();
      });
    });
  </script>

  <div class="leyenda">
    <div class="cuadro" style="background-color:red;"></div> Libre
    <div class="cuadro" style="background-color:yellow; margin-left:15px;"></div> Ocupada
  </div>

  <h2>PRECIO TOTAL: <?= $precio ?>€</h2>

  <?php

  //----depuracion------
  print("<pre>");
  print("Butaca pulsada:<br>");
  print_r($_POST);
  print("<hr>");

  print_r($_SESSION);
  print("</pre>");
  //------fin depura------      
  ?>

</body>

</html>