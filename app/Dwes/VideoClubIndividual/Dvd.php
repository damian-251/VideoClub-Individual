<?php
declare(strict_types=1);
namespace Dwes\VideoClubIndividual;


class Dvd extends Soporte {
    private array $idiomas;
    private string $formatoPantalla;

    public function __construct(string $identificador,  string $titulo, float $precio, array $idiomas, string $formatoPantalla)
    {
        parent::__construct($identificador, $titulo, $precio);
        $this->idiomas = $idiomas;
        $this->formatoPantalla = $formatoPantalla;    
    }

    public function muestraResumen() : string {
        $cadena = parent::muestraResumen()
        . "Idiomas: "
        . implode(", ", $this->idiomas) . ".<br>"
        . $this->formatoPantalla;
        return $cadena;
    }

}