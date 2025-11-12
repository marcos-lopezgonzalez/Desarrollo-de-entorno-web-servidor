<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta Usuario</title>
</head>

<body>
    <h1>ALTA DE USUARIO</h1>
    <form action="../controllers/procesar-alta.php" method="post">
        <label for="nombre">NOMBRE</label>
        <input name="nombre" type="text" value="nombre">

        <br><br>

        <label for="apellidos">APELLIDOS</label>
        <input name="apellidos" type="text" value="apellidos">

        <br><br>

        <label for="usuario">USUARIO</label>
        <input name="usuario" type="text" value="usuario">

        <br><br>

        <label for="password">CONTRASEÑA</label>
        <input name="password" type="password" value="123">

        <br><br>

        <label for="">FECHA DE NACIMIENTO</label>
        <input name="fecha_nac" type="date" value="2000-01-01">

        <br><br>
        <button type="input">ALTA</button>
    </form>
</body>

</html>