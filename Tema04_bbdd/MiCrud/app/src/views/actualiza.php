<?php
require __DIR__ . "/../../vendor/autoload.php";

use App\models\BBDD;

$id = $_POST["id"];
$parametros = [
    "id" => $id
];
$sql = "SELECT * FROM usuarios WHERE id = :id";

$db = new BBDD();
$sentencia = $db->getData($sql, $parametros);
$registro = $sentencia->fetch(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD usuarios</title>
</head>

<body>


    <h2>Update de usuario</h1>

        <form action="./../controllers/procesar-actualizar.php" method="POST">

            <input type="hidden" name="id" value="<?= $id ?>">
            <p>
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?= $registro->nombre ?>">
            </p>
            <p>
                <label for="apellidos">Apellidos:</label>
                <input type="text" id="apellidos" name="apellidos" value="<?= $registro->apellidos ?>">
            </p>
            <p>
                <label for="usuario">Usuario:</label>
                <input type="text" id="usuario" name="usuario" value="<?= $registro->usuario ?>">
            </p>
            <p>
                <label for="password">Update Password (1234 por defecto):</label>
                <input type="password" id="password" name="password" value="123" disabled>
                <button onclick="alternar()">Activar/Desactivar</button>
            </p>
            <p>
                <label for="fecha_nac">Fecha de Nacimiento:</label>
                <input type="date" id="fecha_nac" name="fecha_nac" value="">
            </p>
            <button type=submit>Actualizar usuario</button>
        </form>

        <script>
            function alternar() {
                event.preventDefault(); // 🔴 Detiene el envío del formulario
                const campo = document.getElementById("password");
                campo.disabled = !campo.disabled;
            }
        </script>

</body>

</html>