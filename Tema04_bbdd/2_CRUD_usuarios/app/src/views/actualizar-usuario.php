<?php
require_once "../models/bbdd.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die;
} else {
    $id = $_POST["id"];

    //Singletone
    $dbInstancia = BBDD::getInstance();
    $sql = "SELECT * FROM usuarios WHERE id = :id";

    //Parámetros de la consulta
    $parametros = ["id" => $id];
    $sentencia = $dbInstancia->getData($sql, $parametros);
    $registro = $sentencia->fetch(PDO::FETCH_OBJ);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Usuario</title>
</head>

<body>
    <h1>actualizar DE USUARIO</h1>
    <form action="../controllers/procesar-actualizar.php" method="post">
        <input type="hidden" name="id" value="<?=$registro->id?>">
        <label for="nombre">NOMBRE</label>
        <input name="nombre" type="text" value="<?= $registro->nombre ?>">

        <br><br>

        <label for="apellidos">APELLIDOS</label>
        <input name="apellidos" type="text" value="<?= $registro->apellidos ?>">

        <br><br>

        <label for="usuario">USUARIO</label>
        <input name="usuario" type="text" value="<?= $registro->usuario ?>">

        <br><br>

        <label for="password">CONTRASEÑA</label>
        <!-- $registro->password -->
        <input name="password" type="password" value="">

        <br><br>

        <label for="">FECHA DE NACIMIENTO</label>
        <input name="fecha_nac" type="date" value="<?= (new DateTime($registro->fecha_nac))->format('Y-m-d') ?>">

        <br><br>
        <button type="input">ACTUALIZAR</button>
    </form>
</body>

</html>