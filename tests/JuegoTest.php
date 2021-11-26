<?php

use PHPUnit\Framework\TestCase;
use Dwes\VideoClubIndividual\Juego;

class JuegoTest extends TestCase {
    public function testJugadores() {
        $juego = new Juego("TESTGAME", "Test Title", 50.25, "Nintendo DS", 1,4);
        $resultado = "De 1 a 4 jugadores.<br>";
        $this->expectOutputString($resultado);
        $juego->muestraJugadoresPosibles();
    }
}
