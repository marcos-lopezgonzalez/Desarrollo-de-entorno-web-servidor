<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "Acceso no permitido";
    exit();
}

include_once "includes/funciones.php";
include_once "modelo/libro.php";

$titulo = $_POST['libro_seleccionado'] ?? null;
$titulo = $titulo !== null ? trim(htmlspecialchars(strip_tags($titulo))) : null;

if ($titulo === null || $titulo === '') {
    echo "<p>Título no proporcionado</p>";
    exit();
}

// echo "<p>" . $titulo . " (recibido)</p>";

$libro = obtenerLibro($titulo);
if (!$libro) {
    echo "<p>Libro no encontrado</p>";
    exit();
}

echo "<h1>" . $libro->titulo . "</h1>";
echo "<p>Autor: " . $libro->autor . "</p>";
echo "<p>Año: " . $libro->ano . "</p>";
echo "<ul>";
for ($i = 0; $i < count($libro->genero); $i++) {
    echo "<li>" . $libro->genero[$i] . "</li>";
}
echo "</ul>";
echo "<img src=" . $libro->portada . ">";
