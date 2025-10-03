<?php
$edades = array(
    "Peter" => 35,
    "Zaida" => 38,
    "Joe" => 30
);

$jsonEdades = json_encode($edades);
echo $jsonEdades;

echo "<hr>";

$productos = [
    ["id" => 1, "nombre" => "Laptop", "precio" => 1200],
    ["id" => 2, "nombre" => "Mouse", "precio" => 20],
    ["id" => 3, "nombre" => "Teclado", "precio" => 50]
];

$jsonProductos = json_encode($productos, JSON_PRETTY_PRINT);
echo $jsonProductos;

class Persona {
    public $nombre;
    public $apellidos;

    public function __construct($nombre, $apellidos)
    {
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
    }
}

$persona1 = new Persona("Juan", "Marcos Rubio");

$json = json_encode($persona1);
echo $json;