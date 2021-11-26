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

    }

    public function incluirProducto (Soporte $p) {
        //Añadimos el producto como array asociativo
        $this->productos[$p->getIdentificador()] = $p;

    }
}