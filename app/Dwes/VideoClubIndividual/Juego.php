<?php 

namespace Dwes\VideoClubIndividual;

class Juego extends Soporte {
    private string $consola;
    private int $minJugadores;
    private int $maxJugadores;

    public function __construct(string $identificador,  string $titulo, float $precio, string $consola,
    int $minJugadores, int $maxJugadores)
    {
        parent::__construct($identificador, $titulo, $precio);
        $this->consola = $consola;
        $this->minJugadores = $minJugadores;
        $this->maxJugadores = $maxJugadores;
    }

    public function muestraJugadoresPosibles() {
        if ($this->minJugadores == $this->maxJugadores) {
            if ($this->minJugadores == 1) {
                echo "Para 1 jugador";
            }else {
                echo "Para " . $this->minJugadores . " jugadores.";
            }
        }else {
            echo "De " . $this->minJugadores . " a " . $this->maxJugadores . " jugadores.<br>";
        }
    }

    public function muestraResumen() : void {
        echo "Juego para: " . $this->consola . ".<br>";
        parent::muestraResumen();
        echo $this->muestraJugadoresPosibles();
    }

}