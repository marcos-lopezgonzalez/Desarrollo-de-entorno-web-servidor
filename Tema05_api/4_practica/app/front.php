<?php
$apiUrl = "http://localhost/dwes/Tema05_api/4_practica/app/empleados";

$empleados = [];

if (isset($_GET['id']) && $_GET['id'] !== '') {
    $json = file_get_contents($apiUrl . "/" . $_GET['id']);
} else {
    $json = file_get_contents($apiUrl);
}
$empleados = json_decode($json, true);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Empleados - Frontend PHP</title>
    <style>
        body {
            background-color: gray;
        }

        table {
            border-collapse: collapse;
            width: 60%;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 6px;
        }

        th {
            background-color: gray;
        }
    </style>
</head>

<body>

    <h1>Listado de empleados</h1>

    <form method="GET">
        <label>ID empleado:</label>
        <input type="number" name="id">
        <button type="submit">Buscar</button>
        <a href="<?= $_SERVER["PHP_SELF"] ?>">Ver todos</a>
    </form>

    <br>

    <table>
        <tr>
            <th>Nombre</th>
            <th>Dirección</th>
            <th>Salario</th>
        </tr>

        <?php foreach ($empleados as $emp): ?>
            <?php if ($emp): ?>
                <tr>
                    <td><?= $emp['nombre'] ?></td>
                    <td><?= $emp['direccion'] ?></td>
                    <td><?= $emp['salario'] ?></td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
    </table>

</body>

</html>