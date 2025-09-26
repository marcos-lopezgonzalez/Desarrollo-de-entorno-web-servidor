<?php
$data = [
    [
        'Nombre' => 'Mauro',
        'Apellido' => 'Chojrin',
        'Correo' => 'mauro.chojrin@leewayweb.com',
    ],

    [
        'Nombre' => 'Alberto',
        'Apellido' => 'Loffatti',
        'Correo' => 'aloffatti@hotmail.com',
    ],

    [
        'Nombre' => 'Foo',
        'Apellido' => 'Bar',
        'Correo' => 'foo_bar@example.com',
    ]
];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table border="1">
        <thead>
            <tr>
                <!--
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Correo</th>                
            </tr>
            -->

                <?php
                foreach ($data[0] as $campo => $valor) {
                    echo "<th>$campo</th>";
                }
                ?>
            </tr>
        </thead>

        <tbody>
            <?php
            foreach ($data as $fila) {
                echo "<tr>";
                foreach ($fila as $valor) {
                    echo "<td>$valor</td>";
                }
                echo "</tr>";
            }
            ?>
        </tbody>

        <tfoot>
        </tfoot>
    </table>
</body>

</html>