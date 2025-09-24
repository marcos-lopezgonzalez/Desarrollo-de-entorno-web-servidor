<?php
    $palabra = "ojo";

    print esPalindromo($palabra);

    function esPalindromo($palabra) {
        for($i=0; $i<(strlen($palabra)/2); $i++) {
            if ($palabra[$i] == $palabra[strlen($palabra)-$i-1]) {
                continue;
            } else {
                return false;
            }
        }
        
        return true;
    }
?>