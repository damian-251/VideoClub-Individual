<?php 

include_once "./vendor/autoload.php";
if (!isset($_SESSION)) {
    session_start();
}

if ($_SESSION["user"]!= "admin") {
    die("Vista solo disponible para el administrador <a href='index.php'>Iniciar sesión</a>");
}

if(!isset($_COOKIE["visita"])) {
    $contador = 1;
    setcookie("visita", $contador);
}else {
    $contador = $_COOKIE["visita"];
    $contador++;
    setcookie("visita", $contador);
}

include_once "baseDatos.php"; //Incluimos los clientes y los soportes
//Añadir filtros para que solo pueda acceder el admin

// echo "<pre>";
// echo print_r($_SESSION["clientes"]);
// echo "<pre>";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
</head>
<body>
    <h1>Bienvenido admin</h1>
    <nav>
        <ul>
            <li><a href="formCreateCliente.php">Añadir Cliente</a></li>
            <li><a href="formUpdateCliente.php">Actualizar Cliente</a></li>
        </ul>
    </nav>
    <p>Pulsa <a href="logout.php">aquí</a> para salir</p>
    <div>
    <form action="removeCliente.php" method="POST">
        <select name="selectedUser">
            <?php foreach($_SESSION["clientes"] as $cliente) { ?>
                <option value="<?=$cliente->getUser()?>"><?=$cliente->getNombre()?></option>
            <?php } ?>
        </select>
        <input type="submit" name="submit" value="Eliminar cliente">
    </form>
    </div>
    <p>Es tu visita número <?=$contador?></p>
    <h2>Listado de clientes</h2>
    <?php
    foreach ($_SESSION["clientes"] as $cliente) {
        $cliente->muestraResumen();
        echo "<br>";
    }
    ?>
    <h2>Listado de soportes</h2>
    <?php 
    echo $videoclub->listarProductos();
    ?>
</body>
</html>