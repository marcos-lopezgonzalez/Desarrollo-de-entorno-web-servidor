<?php

class Libro implements JsonSerializable
{
    private $titulo;
    private $autor;
    private $genero;
    private $ano;
    private $portada;

    public function __construct($titulo, $autor, $genero, $ano, $portada)
    {
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->genero = $genero;
        $this->ano = $ano;
        $this->portada = $portada;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function getAutor()
    {
        return $this->autor;
    }

    public function getGenero()
    {
        return $this->genero;
    }

    public function getAno()
    {
        return $this->ano;
    }

    public function getPortada()
    {
        return $this->portada;
    }

    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    public function setAutor($autor)
    {
        $this->autor = $autor;
    }

    public function setGenero($genero)
    {
        $this->genero = $genero;
    }

    public function setAno($ano)
    {
        $this->ano = $ano;
    }

    public function setPortada($portada)
    {
        $this->portada = $portada;
    }

    public function jsonSerialize(): mixed
    {
        return [
            "titulo" => $this->titulo,
            "autor" => $this->autor,
            "genero" => $this->genero,
            "ano" => $this->ano,
            "portada" => $this->portada
        ];
    }
}
