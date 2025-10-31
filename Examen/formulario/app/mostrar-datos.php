<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($_POST["accion"] === "volver") {
        header("Location: formulario1.php");
    } else if ($_POST["accion"] === "mostrar") {
        $asignaturas = $_POST["asignaturas"] ?? [];
        if (count($asignaturas) < 3) {
            $_SESSION["asignaturas"] = $asignaturas;
            $_SESSION["error"]["asignaturas"] = "Elige al menos 3 asignaturas";
            header("Location: formulario2.php");
            die;
        } else {
            $nombre = $_SESSION["nombre"];
            $curso = $_SESSION["curso"];

            echo ("<h1>FORMULARIO DE MATRICULA</h1>");
            echo ("<h2>Datos finales de la matricula</h2>");
            echo ("<p>Nombre: $nombre</p>");
            echo ("<p>Curso: $curso</p>");
            echo ("<p>Lista de materias: </p>");
            // var_dump($asignaturas);
            echo ("<ul>");
            for ($i = 0; $i < count($asignaturas); $i++) {
                echo ("<li>$asignaturas[$i]</li>");
            }
            echo ("</ul>");

            echo ("<a href='formulario1.php'>Volver al formulario index</a>");
            session_destroy();
        }
    }
} else {
    header("Location: formulario1.php");
    die;
}
