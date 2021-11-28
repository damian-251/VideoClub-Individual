<?php

include_once __DIR__ . "/vendor/autoload.php"; //Haría un include de las clases correspondientes
use Dwes\VideoClubIndividual\VideoClub;

//Generamos un nuevo videoclub

$videoclub = new VideoClub("SuperVHS");

$videoclub->incluirJuego("mdread", "Metroid Dread", 49.55, "Nintendo Switch", 1, 1);
$videoclub->incluirJuego("pkdbri", "Pokémon Diamante Brillante", 49.55, "Nintendo Switch", 1, 4);
$videoclub->incluirJuego("tgatch", "The Great Ace Attorney Chronicles", 28.93, "Nintendo Switch", 1, 1);
$videoclub->incluirCinta("lczfts", "Los cazafantasmas", 15, 105);

$videoclub->incluirSocio("admin", "admin", "Administrador");
$videoclub->incluirSocio("shin", "shin", "Shin Chan");
$videoclub->incluirSocio("misa", "misa", "Misae Nohara");
$videoclub->incluirSocio("hiro", "hiro", "Hiroshi Nohara");
$videoclub->incluirSocio("matsu", "matsu", "Ume Matsuzaka");
$videoclub->incluirSocio("yosi", "yosi" ,"Midori Ishizaka");

$videoclub->alquilarSocioProducto("shin" , "mdread");
// echo "Número de alquileres: " . $videoclub->getNumeroTotalAlquileres() . "<br>";
// echo "Número de productos alquilados: " .  $videoclub->getNumeroProductosAlquilados() . "<br>";
$videoclub->alquilarSocioProductos("shin", ["pkdbri", "tgatch"]);
$videoclub->devolverSocioProductos("shin", ["tgatch", "pkdbri"]);

// $videoclub->listarSocios();
// $videoclub->listarProductos();

// echo "<br>";
// echo "Número de alquileres: " . $videoclub->getNumeroTotalAlquileres() . "<br>";
// echo "Número de productos alquilados: " .  $videoclub->getNumeroProductosAlquilados() . "<br>";
