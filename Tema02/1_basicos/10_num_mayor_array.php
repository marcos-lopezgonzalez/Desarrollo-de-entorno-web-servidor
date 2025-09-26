<?php
    require_once("funciones/utilidades.php");
    $array = [1, 20, 2, 12, 41, 4, 24];
    try {
        $mayorNum = mayorNum($array);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    
    print $mayorNum;
?>