<?php

class Usuario implements JsonSerializable
{
    //Propiedades
    private int | null $id;
    private string $nombre;
    private string $apellidos;
    private string $usuario;
    private string $password;
    private DateTime $fecha_nac;

    //Constructor
    public function __construct(int $id, string $nombre, string $apellidos, string $usuario, string $password, DateTime $fecha_nac)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->usuario = $usuario;
        $this->password = $password;
        $this->fecha_nac = $fecha_nac;
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

    public function verificarPassword($passwordPlana)
    {
        return password_verify($passwordPlana, $this->password);
    }

    public function getEdad(): int
    {
        $hoy = new DateTime();
        return $hoy->diff($this->fecha_nac)->y;
    }

    public function jsonSerialize(): mixed
    {
        return [
            "id" => $this->id,
            "nombre" => $this->nombre,
            "apellidos" => $this->apellidos,
            "usuario" => $this->usuario,
            "fecha_nac" => $this->fecha_nac
        ];
    }
}
