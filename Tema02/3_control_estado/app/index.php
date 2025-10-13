<?php
if(isset($_COOKIE["usuario"])) {
    $nombreGuardado = $_COOKIE["usuario"];
} else {
    $nombreGuardado = "";
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Login con Cookies y Sesiones</title>
</head>

<body>
    <h2>Iniciar sesión</h2>
    <form method="post" action="procesar-login.php">
        <label>Usuario:</label>
        <input type="text" name="usuario" value="<?= $nombreGuardado ?>" required><br><br>

        <label>Contraseña:</label>
        <input type="password" name="clave" required><br><br>

        <label>
            <input type="checkbox" name="recordar">
            Recordarme
        </label><br><br>

        <button href="procesar-login.php" type="submit">Entrar</button>
    </form>
</body>

</html>