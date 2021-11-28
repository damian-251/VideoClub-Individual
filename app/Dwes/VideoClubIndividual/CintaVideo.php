<?php
declare(strict_types=1);
namespace Dwes\VideoClubIndividual;


class CintaVideo extends Soporte {

    private int $duracion;

    public function __construct(string $identificador,  string $titulo, float $precio, int $duracion)
    {
        parent::__construct($identificador, $titulo, $precio);
        $this->duracion = $duracion;
    }

    public function muestraResumen() : string {
        $cadena = parent::muestraResumen() .
        "Duración: " . $this->duracion . " minutos<br>";
        return $cadena;
    }

}