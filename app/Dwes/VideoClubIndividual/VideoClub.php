<?php
declare(strict_types=1);
namespace Dwes\VideoClubIndividual;
use Monolog\Logger;
use Monolog\Handler\RotatingFileHandler;

class VideoClub {
    private string $nombre;
    private array $productos;
    private int $numeroProductos;
    private array $socios;
    private int $numeroSocios;
    private Logger $videoClubLog;

    public function __construct($nombre) {
        $this->nombre = $nombre;
        //Inicializamos las variables y el logger al crear un nuevo videoculub
        //mirar teoría del logger
        $this->productos = [];
        $this->socios = [];
        $this->numeroProductos = 0;
        $this->numeroSocios = 0;
        $this->videoClubLog = new Logger("VideoClubLog");
        $this->videoClubLog->pushHandler(new RotatingFileHandler("logs/videoClub.log",0,Logger::DEBUG));

    }

    public function getNombre() : string {
        return $this->nombre;
    }


    private function incluirProducto (Soporte $p) {
        //Añadimos el producto como array asociativo
        $this->productos[$p->getIdentificador()] = $p;
        $this->numeroProductos++;
        $this->videoClubLog->info("Añadido soporte " . $p->getTitulo() . ".");
        //Mirar después
    }

    public function incluirCinta (string $titulo, float $precio, int $duracion) {
        $identificador = random_bytes(5);
        //Creamos una cinta de vídeo
        $cv = new CintaVideo($identificador, $titulo, $precio, $duracion);
        //LLamamos a la función privada incluirProducto para añadir el soporte
        $this->incluirProducto($cv);

    }

    public function incluirDvd(string $titulo, float $precio, string $idiomas, string $pantalla) {
        $identificador = random_bytes(5);
        $arrayIdiomas = explode(", " , $idiomas);
        $dvd = new Dvd($identificador, $titulo, $precio, $arrayIdiomas, $pantalla);
        $this->incluirProducto($dvd);
    }

    public function incluirJuego(string $titulo, float $precio, string $consola, int $minJ, int $maxJ) {
        $identificador = random_bytes(5);
        $juego = new Juego($identificador, $titulo, $precio, $consola, $minJ, $maxJ);
        $this->incluirProducto($juego);

    }

    public function incluirSocio(string $nombre, int $maxAlquileresConcurrentes = 3) {
        $identificador = random_bytes(5); //Esto estaría mejor meterlo en el contructor original
        $cliente = new Cliente($identificador, $nombre, $maxAlquileresConcurrentes);
        $this->socios[$identificador] = $cliente;
        $this->numeroSocios++;
        $this->videoClubLog->info("Se ha añadido el Socio " . $cliente->getNumero() . " " .  $nombre . " a socios.");
    }

    public function listarProductos() {
        foreach ($this->productos as $identificador => $producto) {
            echo "<br>";
            $producto->muestraResumen();
            echo "<br>";
        }
    }

    public function listarSocios() {
        foreach ($this->socios as $identificador => $socio) {
            echo "<br>";
            $socio->muestraResumen();
            echo "<br>";
        }
    }

    public function alquilarSocioProducto(string $idCliente, string $idSoporte) {
        $this->socios[$idCliente]->alquilar($this->productos[$idSoporte]);
        //Quedan por añadir los casos de fallo, se añadirán con la excepciones
    }

}