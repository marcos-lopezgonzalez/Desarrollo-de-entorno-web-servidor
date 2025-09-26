<?php
// Funciones que serán llamadas desde otros archivos
function mayorNum($array)
{
    $numMax = $array[0];

    foreach ($array as $num) {
        if (!is_numeric($num)) {
            throw new Exception("$num no es un número");
        }
        else if ($num > $numMax) {
            $numMax = $num;
        }
    }

    return $numMax;
}

function division($num1, $num2)
{
    if ($num2 == 0) {
        throw new Exception("No se puede dividir entre 0", 1);
    }
    
    // number_format para limitar el numero de decimales que queremos mostrar
    return number_format($num1 / $num2, 2);
}

function matriz_a_tabla_html($matriz)
{
    $tabla = "<table border='1'>";

    foreach ($matriz as $valor) {
        $tabla .= "<tr>";
        $tabla .= "<td>$valor</td>";
    }

    $tabla .= "</table>";
    return $tabla;
}
