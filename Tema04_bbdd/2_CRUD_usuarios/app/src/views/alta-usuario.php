<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta Usuario</title>
</head>

<body>
    <h1>ALTA DE USUARIO</h1>
    <form action="procesar-alta-php" method="post">
        <label for="nombre">NOMBRE</label>
        <input name="nombre" type="text">

        <br><br>

        <label for="apellidos">APELLIDOS</label>
        <input name="apellidos" type="text">

        <br><br>

        <label for="usuario">USUARIO</label>
        <input name="usuario" type="text">

        <br><br>

        <label for="password">CONTRASEÑA</label>
        <input name="password" type="text">

        <br><br>

        <label for="">FECHA DE NACIMIENTO</label>
        <input name="fecha_nac" type="date">

        <br><br>
        <button type="input">ALTA</button>
    </form>
</body>

</html>