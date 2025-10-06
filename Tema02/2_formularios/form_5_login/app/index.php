<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css">
    <title>Form05</title>
</head>

<body>

    <!-- BEGIN menu.php INCLUDE -->
    <?php include('menu.php'); ?>
    <!-- END menu.php INCLUDE -->

    <main>
        <?php
        $listaUsuarios = [];
        $file = "bbdd/data.json";

        $jsonData = file_get_contents("$file");
        $listaUsarios = json_decode($jsonData);
        // print_r($listaUsarios);

        echo ("<h2> Usuarios en la bbdd: " . count($listaUsarios) . "</h2>");
        ?>
    </main>

    <!-- BEGIN FOOTER INCLUDE -->
    <?php include('footer.php'); ?>
    <!-- END FOOTER INCLUDE -->


</body>

</html>