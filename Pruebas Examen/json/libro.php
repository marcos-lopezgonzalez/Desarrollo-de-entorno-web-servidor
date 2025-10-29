<?php

class Libro implements JsonSerializable
{
    private $titulo;
    private $autor;
    private $editorial;
    private $isbn;

    public function __construct($titulo, $autor, $editorial, $isbn)
    {
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->editorial = $editorial;
        $this->isbn = $isbn;
    }

    // GETTERS
    public function getTitulo()
    {
        return $this->titulo;
    }

    public function getAutor()
    {
        return $this->autor;
    }

    public function getEditorial()
    {
        return $this->editorial;
    }

    public function getIsbn()
    {
        return $this->isbn;
    }

    // SETTERS
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    public function setAutor($autor)
    {
        $this->autor = $autor;
    }

    public function setEditorial($editorial)
    {
        $this->editorial = $editorial;
    }

    public function setIsbn($isbn)
    {
        $this->isbn = $isbn;
    }

    public function jsonSerialize(): mixed
    {
        return [
            "titulo" => $this->titulo,
            "autor" => $this->autor,
            "editorial" => $this->editorial,
            "isbn" => $this->isbn
        ];
    }
}
