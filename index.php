<?php
if (!isset($error)) {
    $error = "";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VideoClub - Iniciar sesión</title>
    <style>
    div, input[type="submit"] {
        margin: .5rem;
    }
    </style>
</head>
<body>
    <h1>VideoClub - Inicio de Sesión</h1>
    <p><?=$error?></p>
    <form action="login.php" method="post">
        <div class="div-user">
        <label for="usuario">Usuario</label>
        <input type="text" name="user">
        </div>
        <div class="div-password">
        <label for="password">Constraseña</label>
        <input type="password" name="password">
        </div>
        <input type="submit" name="submit" value="Enviar">
    </form>
</body>
</html>