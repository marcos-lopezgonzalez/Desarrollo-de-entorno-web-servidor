<?php

class Tarea
{
    private int | null $id;
    private string $descripcion;
    private bool $completada;
    private DateTime $fecha_creacion;

    public function __construct(int | null $id, string $descripcion, bool $completada, Datetime $fecha_creacion)
    {
        $this->id = $id;
        $this->descripcion = $descripcion;
        $this->completada = $completada;
        $this->fecha_creacion = $fecha_creacion;
    }

    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function __set($property, $value)
    {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    }
}
