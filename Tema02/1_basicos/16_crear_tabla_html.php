<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $lista = [2, 6, 6, 5, 1, 0, 3, 4, 5];
        require_once("funciones/utilidades.php");
        print(matriz_a_tabla_html($lista));
    ?>
</body>
</html>