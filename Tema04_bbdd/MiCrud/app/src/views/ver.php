<?php
require __DIR__ . "/../../vendor/autoload.php";

use App\models\BBDD;
use Mpdf\Mpdf;

$id = $_GET["id"];

$db = new BBDD();

$sql = "SELECT * FROM usuarios WHERE id = :id";
$parametros = [
    "id" => $id
];

$sentencia = $db->getData($sql, $parametros);
$registro = $sentencia->fetch(PDO::FETCH_OBJ);


$mpdf = new Mpdf();
$html = '
<h2>Detalles del usuario</h2>
<p><b>ID:</b> ' . $registro->id . '</p>
<p><b>Nombre:</b> ' . $registro->nombre . '</p>
<p><b>Apellidos:</b> ' . $registro->apellidos . '</p>
<p><b>Usuario:</b> ' . $registro->usuario . '</p>
<p><b>Fecha nacimiento:</b> ' . $registro->fecha_nac . '</p>
';

$mpdf->WriteHTML($html);
// $mpdf->Output('usuario_' . $registro->id . '.pdf', 'D');
// $mpdf->Output();




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD usuarios</title>
</head>

<body>

    <h2>Detalles del usuario</h2>
    <p><b>ID: <?= $registro->id ?></b></p>
    <p><b>Nombre: <?= $registro->nombre ?></b></p>
    <p><b>Apellidos: <?= $registro->apellidos ?></b></p>
    <p><b>Usuario: <?= $registro->usuario ?></b></p>
    <p><b>Fecha nacimiento: <?= $registro->fecha_nac ?></b></p>
    <!-- <p><b>Edad:</b></p> -->



</body>

</html>