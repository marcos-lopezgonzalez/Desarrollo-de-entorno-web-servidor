<?php
session_start();

require __DIR__ . "/../../vendor/autoload.php";

use App\models\BBDD;
use App\models\Usuario;

$db = new BBDD();

$sql = "SELECT * FROM usuarios";
$sentencia = $db->getData($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD usuarios</title>
    <link rel="stylesheet" href="../../public/css/style.css">
</head>

<body>

    <h2>Listado de usuarios</h2>

    <table border="1" class="tabla">
        <thead>
            <tr>
                <th>NOMBRE</th>
                <th>APELLIDOS</th>
                <th>USUARIO</th>
                <th>FECHA_NAC</th>
                <th>EDAD</th>
                <th>ACCION</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($registro = $sentencia->fetch(PDO::FETCH_OBJ)):
                $usuario = new Usuario(
                    $registro->id,
                    $registro->nombre,
                    $registro->apellidos,
                    $registro->usuario,
                    $registro->password,
                    new DateTime($registro->fecha_nac),
                    $registro->es_admin
                )
            ?>

                <tr>
                    <td><?= $usuario->nombre ?></td>
                    <td><?= $usuario->apellidos ?></td>
                    <td><?= $usuario->usuario ?></td>
                    <td><?= $usuario->password ?></td>
                    <td><?= $usuario->fecha_nac->format("d/m/Y") ?></td>
                    <td>
                        <a href="./ver.php?id=<?= $usuario->id ?>">VER</a>
                        <?php if (isset($_SESSION["admin"]) && $_SESSION["admin"]): ?>
                            <form action="./../controllers/procesar-baja.php" method="post">
                                <input type="hidden" name="id" value="<?= $usuario->id ?>">
                                <button type="submit">BORRAR</button>
                            </form>
                            <form action="./actualiza.php" method="post">
                                <input type="hidden" name="id" value="<?= $usuario->id ?>">
                                <button type="submit">ACTUALIZAR</button>
                            </form>
                        <?php endif; ?>
                    </td>
                </tr>

            <?php endwhile; ?>
        </tbody>






    </table>




</body>

</html>