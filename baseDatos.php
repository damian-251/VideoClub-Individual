<?php

include __DIR__ . "/vendor/autoload.php"; //Haría un include de las clases correspondientes
use Dwes\VideoClubIndividual\Soporte;
use Dwes\VideoClubIndividual\CintaVideo;
use Dwes\VideoClubIndividual\Cliente;
use Dwes\VideoClubIndividual\Dvd;
use Dwes\VideoClubIndividual\Juego;


echo "<br>";

$miCinta = new CintaVideo("VHSCZFT", "Los cazafantasmas", 3.5, 107);
echo "<strong>" . $miCinta->getTitulo() . "</strong>";
echo "<br>Precio: " . $miCinta->getPrecio() . " euros";
echo "<br>Precio IVA incluido: " . $miCinta->getPrecioConIva() . " euros<br>";
$miCinta->muestraResumen();
echo "<br>";

$miDvd = new Dvd("DVDORIGN", "Origen", 15, ["en", "fr", "es"], "16:9"); 
echo "<strong>" . $miDvd->getTitulo() . "</strong>"; 
echo "<br>Precio: " . $miDvd->getPrecio() . " euros"; 
echo "<br>Precio IVA incluido: " . $miDvd->getPrecioConIva() . " euros<br>";
$miDvd->muestraResumen();
echo "<br>";
echo "<br>";

$miJuego = new Juego("PS4LOUP2", "The Last of Us - Part II", 50, "PS4", 1, 1); 
echo "<strong>" . $miJuego->getTitulo() . "</strong>"; 
echo "<br>Precio: " . $miJuego->getPrecio() . " euros"; 
echo "<br>Precio IVA incluido: " . $miJuego->getPrecioConIva() . " euros<br>";
$miJuego->muestraResumen();

echo "<br>";
echo "<br>";

$juego2 = new Juego("SWMEDR", "Metroid Dread", 41.3, "NSW", 1, 1);
echo "<strong>" . $juego2->getTitulo() . "</strong>"; 
echo "<br>Precio: " . $juego2->getPrecio() . " euros"; 
echo "<br>Precio IVA incluido: " . $juego2->getPrecioConIva() . " euros<br>";
$juego2->muestraResumen();
echo "<br>";
echo "<br>";
$juegoPokemon = new Juego("SWPKDB", "Pokémon Diamante Brillante", 49.54, "NSW", 1, 4);
echo "<strong>" . $juegoPokemon->getTitulo() . "</strong>"; 
echo "<br>Precio: " . $juegoPokemon->getPrecio() . " euros"; 
echo "<br>Precio IVA incluido: " . $juegoPokemon->getPrecioConIva() . " euros<br>";
$juegoPokemon->muestraResumen();
echo "<br>";

echo "<br>";
$cli1 = new Cliente("Diego Serrano");
echo "Número cliente: " .  $cli1->getNumero() . "<br>";
echo $cli1->muestraResumen();

echo "<br>";
$cli2 = new Cliente("Furctuoso Martínez");
echo "Número cliente: " . $cli2->getNumero() . "<br>";
echo $cli2->muestraResumen();

echo "<br>";

$cli3 = new Cliente("Santiago Serrano");
echo "Número cliente: " . $cli3->getNumero() . "<br>";
echo $cli3->muestraResumen();

$cli3->alquilar($juegoPokemon);

echo $juegoPokemon->muestraResumen();

echo "<pre>";
echo print_r($cli3->getSoportesAlquilados());
echo "</pre>";

$cli3->muestraResumen();
$cli3->listarAlquileres();

