<?php
include_once "includes/funciones.php";
include_once "modelo/libro.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Comprobacion de parámetros
    $accion = $_POST["accion"] ?? "";
    $libroSeleccionado = $_POST["libro_seleccionado"] ?? null;
    if ($libroSeleccionado && $accion == "borrarLibro")
        borrarLibro($libroSeleccionado);

    // if ($_POST["accion"] === "borrarLibro" && $libroSeleccionado) {
    //     borrarLibro($libroSeleccionado);
    // } else if ($_POST["accion"] === "verLibro" && $libroSeleccionado) {
    //     verLibro($libroSeleccionado);
    // }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Libros Marcos López González</title>
</head>

<body>
    <?php include('menu.php'); ?>

    <!-- Formularios ocultos -->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" id="formLibros">
        <input type="hidden" id="libro_seleccionado_borrar" name="libro_seleccionado">
        <input type="hidden" id="accion" name="accion">
    </form>

    <form action="ver_libro.php" method="POST" id="formVerLibro">
        <input type="hidden" id="libro_seleccionado_ver" name="libro_seleccionado">
    </form>



    <main>
        <?php
        $listaLibros = obtenerLibros();

        if (count($listaLibros) == 0) {
            //No existen libros
            echo "<p>No existen libros</p>";
        } else {
            echo "<table class=\"tabla-libros\">";
            echo "<tr>
                    <th>Portada</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Año</th>
                    <th>Géneros</th>
                  </tr>";

            foreach ($listaLibros as $libro) {
                echo "<tr>";
                //Portada
                echo "<td><img src=\"$libro->portada\"</td>";
                //Titulo
                echo "<td>$libro->titulo</td>";
                //Autor
                echo "<td>$libro->autor</td>";
                //Año
                echo "<td>$libro->ano</td>";
                //Genero/s
                echo "<td>";
                echo "<select>";
                for ($i = 0; $i < count($libro->genero); $i++) {
                    echo "<option value=\"$genero\">{$libro->genero[$i]}</option>";
                }
                echo "</select>";
                echo "</td>";
                echo "<td>";
                echo "<button id=\"borrarLibro\" name=\"borrarLibro\" data-titulo=\"$libro->titulo\">Borrar libro</button>";
                echo "</td>";

                echo "<td>";
                echo "<button id=\"verLibro\" name=\"verLibro\" data-titulo=\"$libro->titulo\">Ver libro</button>";
                echo "</td>";
                echo "</tr>";
            }

            echo "</table>";
        }
        ?>
    </main>
    <?php include('footer.php'); ?>
</body>

</html>

<script>
    // Botones de borrar
    document.querySelectorAll('button[name="borrarLibro"]').forEach(boton => {
        boton.addEventListener('click', (ev) => {
            const titulo = boton.dataset.titulo;
            // rellenar el input que está dentro del formLibros
            const form = document.getElementById('formLibros');
            form.querySelector('input[name="libro_seleccionado"]').value = titulo;
            form.querySelector('input[name="accion"]').value = "borrarLibro";
            form.submit();
        });
    });

    // Botones de ver
    document.querySelectorAll('button[name="verLibro"]').forEach(boton => {
        boton.addEventListener('click', (ev) => {
            const titulo = boton.dataset.titulo;
            // rellenar el input que está dentro del formVerLibro
            const formVer = document.getElementById('formVerLibro');
            formVer.querySelector('input[name="libro_seleccionado"]').value = titulo;
            formVer.submit();
        });
    });
</script>