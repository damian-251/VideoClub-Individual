<?php
//Primero comprobamos si ya se ha enviado el formulario
include_once "baseDatos.php";
//$arrayUserPass = ["admin" => "admin", "shinchan" => "shinchan", "misae"=>"misae", "matsu"=>"matsu", "hiro"=>"hiro"];

//Generamos array de usuarios y contraseñas


//Añadimos al administrador

$arrayUserPass["admin"] = "admin";


// echo "<pre>";
// echo print_r($arrayUserPass);
// echo "<pre>";


if (isset($_POST["submit"])) {
    $user = $_POST["user"];
    $password = $_POST["password"];
    //Validamos que hemos recibido ambos parámetros
    if (empty($user) || empty($password)) {
        $error = "Debes introducir un usuario y una contraseña";
        include "index.php";
    } else { //Si los campos tienen valores comprobamos que tenga el valor correcto
        //Comprobamos si el usuario y la contraseña son correctos
        if ($videoclub->getClientes()[$user]->getPassword() == $password) {
            //El inicio de sesión ha sido correcto
            session_start();
            $_SESSION["user"] = $user;
            $_SESSION["password"] = $password;
            //Miramos si es administrador o usuario para cargar la vista correspondiente
            if ($user == "admin") {
                $_SESSION["clientes"] = $videoclub->getClientes();
                //Array con los objetos de clientes
                header("Location: mainAdmin.php");
            } else {
                //Si somos usuario solo nos interesa tener al propio cliente en la sesión.
                $_SESSION["cliente"] = $videoclub->getClientes()[$user];
                header("Location: mainCliente.php");
            }
        } else {
            $error = "El usuario o la contraseña no son válidos";
            include "index.php";
        }
    }
}else {
    header("Location: index.php");
}
