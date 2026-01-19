<?php

namespace App\models;

require __DIR__ . "/../../vendor/autoload.php";

class Empleado
{
    public int | null $id;
    public string | null $nombre;
    public string | null $direccion;
    public int | null $salario;

    public function __construct($id, $nombre, $direccion, $salario)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->direccion = $direccion;
        $this->salario = $salario;
    }
}
