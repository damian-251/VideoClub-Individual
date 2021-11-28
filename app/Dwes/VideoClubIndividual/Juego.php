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

    public function muestraJugadoresPosibles() : string {
        $cadena = "";
        if ($this->minJugadores == $this->maxJugadores) {
            if ($this->minJugadores == 1) {
                $cadena .= "Para 1 jugador";
            }else {
                $cadena .= "Para " . $this->minJugadores . " jugadores.";
            }
        }else {
            $cadena.= "De " . $this->minJugadores . " a " . $this->maxJugadores . " jugadores.<br>";
        }
        return $cadena;
    }

    public function muestraResumen() : string {
        $cadena = "Juego para: " . $this->consola . ".<br>" .
        parent::muestraResumen() .
        $this->muestraJugadoresPosibles();
        return $cadena;
    }

}