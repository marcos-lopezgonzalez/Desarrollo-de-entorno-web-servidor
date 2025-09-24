<?php
    require_once("funciones/utilidades.php");

    try {
        $resultado = division(10, 2);
        echo $resultado . "<br>";
        $resultado = division(10, 0);
        echo $resultado;
    } catch (Exception $e) {
        echo $e->getMessage();
    }
?>