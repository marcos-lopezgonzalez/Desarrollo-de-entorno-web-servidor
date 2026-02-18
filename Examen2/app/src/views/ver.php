<?php

require __DIR__ . "/../../vendor/autoload.php";

use App\models\Basedatos;
use App\models\Incidencia;

$idIncidencia = $_GET["id"];
if (isset($_GET["mensaje"]))
    $mensaje = $_GET["mensaje"];

$db = new Basedatos();

$sql = "SELECT * FROM incidencia WHERE id = :id";
$parametros = [
    "id" => $idIncidencia
];

$sentencia = $db->getData($sql, $parametros);
$registro = $sentencia->fetch(PDO::FETCH_OBJ);

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

        <form action="./../controllers/resolver.php" method="POST" class="form-actualizar <?= $incidencia->resuelta ? "fondo-verde" : "fondo-rojo"  ?>"> <!-- cambiar a fondo-rojo si esta sin resolver -->

            <!-- Título -->
            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" value="<?= $incidencia->titulo ?>" required>

            <!-- Descripción -->
            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" rows="5" required><?= $incidencia->descripcion ?></textarea>

            <!-- Nivel -->
            <label for="nivel">Nivel:</label>
            <select id="nivel" name="nivel">
                <option value="normal" <?= $incidencia->nivel === "normal" ? "selected" : ""  ?>>Normal</option>
                <option value="urgente" <?= $incidencia->nivel === "urgente" ? "selected" : ""  ?>>Urgente</option>
            </select>

            <!-- Resolución -->
            <label for="resolucion">Resolución:</label>
            <input type="text" id="resolucion" name="resolucion"
                value="<?= $incidencia->resolucion ?>">

            <!-- Usuario -->
            <label for="nombre_usuario"> Usuario de la incidencia:</label>
            <input type="text" id="nombre_usuario" name="nombre_usuario"
                value="<?= nombre_dado_id($incidencia->id_usuario) ?>" disabled>

            <!-- Botones. Si no estan habilitados, indicar "disabled" -->
            <button value="resolver" name="boton" type="submit" <?= $incidencia->resuelta ? "disabled" : ""  ?>>Resolver</button>
            <button value="volver" name="boton" type="submit"><a href="./listado.php">Volver</a></button>

            <input type="hidden" name="id" value="<?= $incidencia->id ?>">


        </form>
        <div class="leyenda">
            <span class="color fondo-verde"></span> Resuelta &nbsp;&nbsp;
            <span class="color fondo-rojo"></span> Sin resolver
            <?php if (isset($mensaje)): ?>
                <p class="error-mensaje"><?= $mensaje ?></p>
            <?php endif; ?>
        </div>
    </main>

</body>

</html>