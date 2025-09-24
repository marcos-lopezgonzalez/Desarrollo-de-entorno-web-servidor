<?php
// Funciones que serán llamadas desde otros archivos
function mayorNum($array)
{
    $numMax = $array[0];

    foreach ($array as $num) {
        if ($num > $numMax) {
            $numMax = $num;
        }
    }

    return $numMax;
}

function division($num1, $num2)
{
    if ($num2 == 0) {
        throw new Exception("No se puede dividir entre 0");
    }
    return $num1 / $num2;
}
