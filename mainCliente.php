<?php 
//Añadir filtros para que solo pueda acceder el cliente
include_once "./vendor/autoload.php";
if (!isset($_SESSION)) {
    session_start();
}
$cliente = $_SESSION["cliente"];
$nombre = $cliente->getNombre();
$user = $cliente->getUser();

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
    <h1>Bienvenido/a <?=$nombre?></h1>
    <nav>
        <ul>
            <li><a href="formUpdateCliente.php">Actualizar datos</a></li>
        </ul>
    </nav>
    <p><a href="logout.php">Cerrar sesión</a></p>
    <h2>Listado de alquileres</h2>
    <p>
        <?=$cliente->listarAlquileres();?>
    </p>
</body>
</html>