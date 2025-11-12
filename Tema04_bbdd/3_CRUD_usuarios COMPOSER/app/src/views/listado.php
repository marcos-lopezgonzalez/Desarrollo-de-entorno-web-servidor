<?php
session_start();

// require_once "../models/bbdd.php";
// require_once "../models/usuario.php";
require __DIR__ . "/../../vendor/autoload.php";

use App\models\BBDD;
use App\models\Usuario;


if (!$_SESSION["conectado"] || !isset($_SESSION["conectado"])) {
    //Lo mandamos a index para que inicie la conexion
    header("Location: ../../public/index.php");
    die;
}

//Singletone
$dbInstancia = BBDD::getInstance();
$sql = "SELECT * FROM usuarios";
$sentencia = $dbInstancia->getData($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado Usuarios</title>
</head>

<body>
    <?php
    include "menu.php";
    ?>
    <h1>LISTADO DE USUARIOS</h1>
    <table class="tabla" border="1">
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
            <?php while ($registroPDO = $sentencia->fetch(PDO::FETCH_OBJ)):
                $usuario = new Usuario(
                    $registroPDO->id,
                    $registroPDO->nombre,
                    $registroPDO->apellidos,
                    $registroPDO->usuario,
                    $registroPDO->password,
                    new DateTime($registroPDO->fecha_nac)
                )
            ?>
                <tr>
                    <td><?= $usuario->nombre ?></td>
                    <td><?= $usuario->apellidos ?></td>
                    <td><?= $usuario->usuario ?></td>
                    <td><?= $usuario->fecha_nac->format("d/m/Y") ?></td>
                    <td><?= $usuario->getEdad() ?></td>

                    <td>
                        <a href="ver.php?id=<?= $usuario->id ?>"><button>VER</button></a>
                        <form action="../controllers/procesar-baja.php" method="post">
                            <input type="hidden" name="id" value="<?= $usuario->id ?>">
                            <button type="submit">BORRAR</button>
                        </form>
                        <form action="actualizar-usuario.php" method="post">
                            <input type="hidden" name="id" value="<?= $usuario->id ?>">
                            <button type="submit">ACTUALIZAR</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>

</html>