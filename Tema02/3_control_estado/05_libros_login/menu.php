<?php
session_start();
?>
<header>
  <h1>ALTA DE LIBROS</h1>
</header>
<nav>
  <ul>
    <li class="izda"><a class="menu" href="listar_libros.php">Home</a></li>
    <li class="izda"><a class="menu" href="alta.php">Alta Libro</a></li>
    <li class="izda"><a class="menu" href="">Hola <?= $_SESSION["username"] ?></a></li>
    <li class="izda"><a class="menu" href="logout.php">Logout</a></li>
  </ul>
  <br>
</nav>