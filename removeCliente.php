<?php 
include "./vendor/autoload.php";

if(!isset($_SESSION)) {
    session_start();
}

if($_SESSION["user"]!="admin") {
    die("Acceso no autorizado");
}

if (isset($_POST["submit"])){
    $user = $_POST["selectedUser"];

    foreach($_SESSION["clientes"] as $arrayKey => $cliente) {
        if($user == $cliente->getUser()) {
            unset($_SESSION["clientes"][$arrayKey]);
        }
    }
    header("Location: mainAdmin.php");

}else {
    die("Acceso no autorizado");
}


