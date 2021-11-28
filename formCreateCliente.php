<?php

if (!isset($_SESSION)) {
    session_start();
}

if ($_SESSION["user"] != "admin") {
    die("Acceso no autorizado");
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de creación de cliente</title>
    <style>
        div {
            margin: .5rem;
        }
    </style>
</head>

<body>
    <h1>Formulario de creación de cliente</h1>
    <form action="createCliente.php" method="post">
        <div>
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre">
        </div>
        <div>
        <label for="user">Usuario: </label>
        <input type="text" name="user">
        </div>
        <div>
        <label for="password">Contraseña</label>
        <input type="password" name="password">
        </div>
        <div><input type="submit" name="submit" value="Enviar"></div>
    </form>
</body>

</html>