<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="alta.php" method="post">
        <label for="titulo">Titulo</label>
        <input type="text" name="titulo" required>
        <br><br>

        <label for="autor">Autor</label>
        <input type="text" name="autor">
        <br><br>

        <label for="editorial">Editorial</label>
        <input type="text" name="editorial">
        <br><br>

        <label for="isbn">ISBN</label>
        <input type="text" name="isbn">
        <br><br>

        <input type="submit" value="Alta">
        <input type="reset">
    </form>
    <form action="mostrar.php" method="post">
        <br><br><br><br>
        <input type="submit" value="Ver libros">
    </form>
</body>

</html>