<?php
session_start();

require __DIR__ . "/../../vendor/autoload.php";

use App\models\Basedatos;
use App\models\Incidencia;

$camposOrdenacion = ["titulo", "nivel", "id_usuario"];
if (isset($_GET["orden"]) && in_array($_GET["orden"], $camposOrdenacion)) {
    $orden = $_GET["orden"];
} else {
    $orden = null;
}

$db = new Basedatos();

// $sql = "SELECT * FROM incidencia ORDER BY campo";
// $sql = "SELECT * FROM incidencia WHERE id_usuario = valor ORDER BY campo";

if ($_SESSION["rol"] === "admin") {
    if (isset($orden))
        $sql = "SELECT * FROM incidencia ORDER BY $orden";
    else
        $sql = "SELECT * FROM incidencia";
    $sentencia = $db->getData($sql);
} else {
    $idUsuario = $_SESSION["id"];
    if (isset($orden)) {
        $sql = "SELECT * FROM incidencia WHERE id_usuario = $idUsuario ORDER BY $orden";
        $sentencia = $db->getData($sql);
    } else {
        $sql = "SELECT * FROM incidencia WHERE id_usuario = :id";
        $parametros = [
            "id" => $idUsuario
        ];
        $sentencia = $db->getData($sql, $parametros);
    }
}
// $registro = $sentencia->fetchAll(PDO::FETCH_OBJ);
// echo ($sql);
// var_dump($registro);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./../../public/css/estilos.css">
    <title>Incidencias</title>
</head>

<body>
    <header>
        <h1>GESTOR DE INCIDENCIAS</h1>
    </header>

    <main>
        <?php
        include("menu.php");
        ?>
        <div class="tabla-contenedor">
            <table border="1" class="tabla">
                <thead>
                    <tr>
                        <!-- <th>TITULO</th>
                        <th>NIVEL</th>
                        <th>PROPIETARIO</th>
                        <th>ACCION</th> -->
                        <th><a href="./listado.php?orden=titulo">TITULO</a></th>
                        <th><a href="./listado.php?orden=nivel">NIVEL</a></th>
                        <th><a href="./listado.php?orden=id_usuario">PROPIETARIO</a></th>
                        <th>ACCION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($registro = $sentencia->fetch(PDO::FETCH_OBJ)):
                        $incidencia = new Incidencia(
                            $registro->id,
                            $registro->titulo,
                            $registro->descripcion,
                            $registro->nivel,
                            $registro->resuelta,
                            $registro->resolucion,
                            $registro->id_usuario
                        );
                    ?>
                        <!-- <tr class='fondo-verde'> |
                        <tr class='fondo-rojo'> -->

                        <?php
                        if ($incidencia->resuelta) {
                            // echo("resuelta");
                            echo ("<tr class='fondo-verde'>");
                        } else {
                            // echo("NO resuelta");
                            echo ("<tr class='fondo-rojo'>");
                        }
                        ?>
                        <td><?= $incidencia->titulo ?></td> <!-- campo titulo -->
                        <td><?= $incidencia->nivel ?></td> <!-- campo nivel -->
                        <td><?= nombre_dado_id($incidencia->id_usuario); ?></td> <!-- campo propietario -->
                        <!-- campo accion -->
                        <td>
                            <!-- BOTON VER -->
                            <a href="./ver.php?id=<?= $incidencia->id ?>"><button>VER</button></a>
                        </td>

                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        <div class="leyenda">
            <span class="color fondo-verde"></span> Resuelta &nbsp;&nbsp;
            <span class="color fondo-rojo"></span> Sin resolver
        </div>


        <div class="centrado">
            <br><br>
            <!-- crea el formulario/enlace, hazlo como quieras con el atributo target="_blank" para que
                 se abra en otra pestaña -->

            <button type="submit"
                style="background-color:#0275d8; color:white; padding:10px 18px; border:none; border-radius:5px; cursor:pointer;">
                <a href="./../controllers/generar_estadisticas.php">GENERAR ESTADÍSTICAS EN PDF</a>
            </button>

        </div>
    </main>


</body>

</html>