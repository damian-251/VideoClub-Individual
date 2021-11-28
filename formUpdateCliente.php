<?php 
include_once "./vendor/autoload.php";

if (!isset($_SESSION)) {
    session_start();
}

//Comprobamos que es administrador
$isAdmin = $_SESSION["user"] == "admin";

if ($isAdmin) {
    $clientes = $_SESSION["clientes"];
}else {
    $clientes[] = $_SESSION["cliente"];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de actualización de cliente</title>
    <style> 
        div {margin: 1rem 0 1rem 1.5rem; }
    </style>
</head>
<body>
    <h1>Formulario de actualización de cliente</h1>
    <form action="UpdateCliente.php" method="POST">
        <div>
        <label for="user">Seleccione un cliente</label>
        <select name="selectedUser">
        <?php foreach($clientes as $cliente) { ?>
            <option value="<?=$cliente->getUser() ?>"><?=$cliente->getNombre() ?></option>
        <?php } ?>
        </select>
        </div>
        <div>
            <label for="nombre">Nombre: </label>
            <input type="text" name="nombre">
        </div>
        <div>
            <label for="user">Usuario: </label>
            <input type="text" name="user"> 
        </div>
        <div>
            <label for="password">Contraseña: </label>
            <input type="password" name="password"> 
        </div>
        <div>
            <input type="submit" name="submit" value="Actualizar cliente">
        </div>
    </form>
</body>
</html>