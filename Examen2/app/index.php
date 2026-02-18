<?php

require __DIR__ . "/vendor/autoload.php";

use App\models\Basedatos;

$db = new Basedatos();
if ($db->isConectado())
    $mensaje = "Conexión a BBDD correcta";
else
    $mensaje = "ERROR al conectarse a BBDD";

header("Location: ./src/views/login.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Gestor Incidencias</title>
    <link rel="stylesheet" href="public/css/estilos.css">
</head>

<body class="centrado">
    <h2><?= $mensaje ?></h2>
    <div>
        <!-- boton para generar la bbdd -->
         <button>CREAR BBDD</button>
    </div>
</body>

</html>