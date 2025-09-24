<?php
class Persona {
    public $nombre;
    public $apellidos;
    public $dni;

    public function __construct($nombre, $apellidos, $dni) {
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->dni = $dni;
    }
}
?>