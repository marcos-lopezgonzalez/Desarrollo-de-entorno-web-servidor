<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        $a = 5;
        $b = 10;

        echo("Antes del intercambio a=$a, b=$b<br>");

        $temp = $a;
        $a = $b;
        $b = $temp;

        echo('Despues del intercambio a=' . $a . ' b=' . $b . '<br>');
    ?>
</body>
</html>