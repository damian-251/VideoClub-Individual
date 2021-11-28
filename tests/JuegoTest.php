<?php 
namespace Dwes\VideoClubIndividual\Model;
use PHPUnit\Framework\TestCase;
use Dwes\VideoClubIndividual\Juego;
use Dwes\VideoClubIndividual\Soporte;

class JuegoTest extends TestCase {

    public function testMuestraResumen(){
        $juego = new Juego("testid","Test Game", 0.56, "TestConsole",1,3);
        $this->expectOutputString("Juego para: " . "TestConsole" . ".<br>" .
        $juego->Soporte::muestraResumen() .
        $juego->muestraJugadoresPosibles());
        echo $juego->muestraResumen();

    }
}