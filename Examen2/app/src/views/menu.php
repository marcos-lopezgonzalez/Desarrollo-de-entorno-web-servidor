<?php
session_start();

require __DIR__ . "/../../vendor/autoload.php";

$id = $_SESSION["id"];
$nombre = nombre_dado_id($id);
?>

<nav>
  <ul>

    <li><span style="color:red">Hola, <?= $nombre ?> (<?= $_SESSION["rol"] ?>)<span></li>
    <li><a class="menu" href="./../controllers/logout.php">Logout</a></li>

    <?php
    if ($_SESSION["rol"] === "admin") {
      echo ("<li><a class='menu' href='./../controllers/crear_db.php'>RESETEAR BBDD</a></li>");
    }
    ?>

  </ul>
  <br>
</nav>