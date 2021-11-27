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

    public function muestraResumen() : void {
        parent::muestraResumen();
        echo "Duración: " . $this->duracion . " minutos<br>";
    }


}