<?php

namespace App\models;

require __DIR__ . "/../../vendor/autoload.php";

use JsonSerializable;
use DateTime;

class Usuario implements JsonSerializable
{
    //Propiedades
    public int | null $id;
    public string $nombre;
    public string $apellidos;
    public string $usuario;
    public string | null $password;
    public DateTime $fecha_nac;
    public bool $es_admin;



    //Constructor
    public function __construct(int | null $id, string $nombre, string $apellidos, string $usuario, string | null $password, DateTime $fecha_nac, bool $es_admin)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->usuario = $usuario;
        $this->password = $password;
        $this->fecha_nac = $fecha_nac;
        $this->es_admin = $es_admin;
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

    // Método para verificar una contraseña introducida


    // Método adicional: calcular edad


    // Implementación de JsonSerializable
    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'apellidos' => $this->apellidos,
            'usuario' => $this->usuario,
            'fecha_nac' => $this->fecha_nac->format('d/m/Y')
            //'edad' => $this->getEdad()
            //Tampoco metemos el password por seguridad
        ];
    }
} //fin clase Usuario
