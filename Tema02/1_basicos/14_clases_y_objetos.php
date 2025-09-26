<?php
    require_once("objetos/persona.php");
    $persona = new Persona("Alicia", "Camacho", "12345678A");
    print $persona;
    print "<br>";
    $persona2 = new Persona("Marcos", "Lopez Gonzalez", "48129456R");
    print $persona2->__getApellidos();
    print "<br>";
    $persona2->__setApellidos("López González");
    print $persona2;
?>