<?php

namespace App\models;

use DateTime;

class Tarea
{
    public int | null $id;
    public string $descripcion;
    public bool $completada;
    public DateTime $fecha_creacion;

    public function __construct(int | null $id, string $descripcion, bool $completada = false)
    {
        $this->id = $id;
        $this->descripcion = $descripcion;
        $this->completada = $completada;
        $this->fecha_creacion = new DateTime();
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    // public function __get($property)
    // {
    //     if (property_exists($this, $property)) {
    //         return $this->$property;
    //     }
    // }

    // public function __set($property, $value)
    // {
    //     if (property_exists($this, $property)) {
    //         $this->$property = $value;
    //     }
    // }
}
