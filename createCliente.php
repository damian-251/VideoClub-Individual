<?php 

if (!isset($_SESSION)) {
    session_start();
}

function validar(string $campo) {
    return (isset($campo) && !empty($campo));
}

include_once "baseDatos.php";


if (isset($_POST["submit"])) {
    if (validar($_POST["nombre"]) && validar($_POST["user"]) && validar($_POST["password"])) {
        $nombre = $_POST["nombre"];
        $user = $_POST["user"];
        $password = $_POST["password"];
        $cliente = $videoclub->incluirSocio($user, $password, $nombre);
        $_SESSION["clientes"][] = $cliente;
        header("Location: mainAdmin.php");
    }
}
