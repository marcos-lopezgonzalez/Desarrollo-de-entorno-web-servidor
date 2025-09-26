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

    public function __setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function __setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }

    public function __setDni($dni) {
        $this->dni = $dni;
    }

    public function __getNombre() {
        return $this->nombre;
    }

    public function __getApellidos() {
        return $this->apellidos;
    }

    public function __getDni() {
        return $this->dni;
    }

    public function __toString() {
        return "Nombre: $this->nombre, Apellidos: $this->apellidos, DNI: $this->dni";
    }
}
?>