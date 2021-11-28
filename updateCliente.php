<?php

include "./vendor/autoload.php";

if (!isset($_SESSION)) {
    session_start();
}

$nombre = $_POST["nombre"];
$user = $_POST["user"];
$password = $_POST["password"];
$selectedUser = $_POST["selectedUser"];


$isAdmin = $_SESSION["user"] == "admin";
//Si es el propio usuario podrá cambiar sus datos
$isUser = $_SESSION["user"] == $selectedUser;

if ($isAdmin) {
    //Actualizamos los datos del clientes
    foreach ($_SESSION["clientes"] as $id => $cliente) {
        if ($cliente->getUser() == $selectedUser) {
            //Si no ha puesto ningún valor no actualizamos esos datos
            if (!empty($nombre)) {
                $_SESSION["clientes"][$id]->setNombre($nombre);                
            }
            if(!empty($user)) {
                $_SESSION["clientes"][$id]->setUser($user);
            }
            if(!empty($password)) {
                $_SESSION["clientes"][$id]->setPassword($password);
            }
            $cliente->getLogger()->info("El cliente " . $cliente->getNombre() . " ha sido actualizado.");
        }
    }

    // echo "<pre>";
    // echo print_r($_SESSION["clientes"]);
    // echo "<pre>";
    header("Location: mainAdmin.php");   
}else if ($isUser) {
    if (!empty($nombre)) {
        $_SESSION["cliente"]->setNombre($nombre);
    }
    if(!empty($user)) {
        $_SESSION["cliente"]->setUser($user);
        $_SESSION["user"] = $user;
    }
    if(!empty($password)) {
        $_SESSION["cliente"]->setPassword($password);
    }
    $_SESSION["cliente"]->getLogger()->info("El cliente " . $_SESSION["user"] . " ha actualizado sus datos");
    header("Location: mainCliente.php");
}else {
    die("Sin autorización <a href='inicio.php'>Iniciar sesión</a>");
}

