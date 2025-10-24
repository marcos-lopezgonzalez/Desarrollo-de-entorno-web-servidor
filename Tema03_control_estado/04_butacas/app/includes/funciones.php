<?php
function calcularPrecio($butacas)
{
    $precioTotal = 0;

    for ($fila = 0; $fila < count($butacas); $fila++) {
        for ($columna = 0; $columna < count($butacas[$fila]); $columna++) {
            if ($butacas[$fila][$columna] == 1)
                $precioTotal += 10;
        }
    }

    return $precioTotal;
}
