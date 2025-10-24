<?php
//######## FUNCION RECOGER
//Recoge los datos de los formularios y los depura para no meter código malicioso
//Esta finción no comprueba errores.
//ENTRADA: el nombre del campo a recoger, indicado por el atributo 'name' del formulario
//SALIDA: el valor del campo o null si está vacio
function recoge($var)
{
    if (!isset($_REQUEST[$var])) {
        return null;
    }

    $valor = $_REQUEST[$var];

    // Si es un array
    if (is_array($valor)) {
        $result = [];
        foreach ($valor as $v) {
            if ($v !== "") {
                $tmp = trim(htmlspecialchars(strip_tags($v)));
                $result[] = $tmp;
            }
        }
        return count($result) ? $result : null;
    }

    // Si es una cadena
    if ($valor != "") {
        return trim(htmlspecialchars(strip_tags($valor)));
    }

    return null;
}