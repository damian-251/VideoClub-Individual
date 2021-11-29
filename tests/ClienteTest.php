<?php 

use PHPUnit\Framework\TestCase;
use Dwes\VideoClubIndividual\Cliente;
use Dwes\VideoClubIndividual\Soporte;

class ClienteTest extends TestCase {
    

    public function testConstructor() {
        $cliente = new Cliente("idTest", "Cliente");
        $this->assertSame($cliente->getNombre(), "Cliente");
    }

    public function testAlquilarDevolver() {
        $soporte = new Soporte("TEST", "Soporte Test", 59.95);
        $cliente = new Cliente("idTest", "Cliente Test");
        $this->assertFalse($cliente->tieneAlquilado($soporte));
        $cliente->alquilar($soporte);
        $this->assertTrue($soporte->getAlquilado());
        $this->assertTrue($cliente->tieneAlquilado($soporte));

        $cliente->devolver($soporte);
        $this->assertFalse($soporte->getAlquilado());
        $this->assertFalse($cliente->tieneAlquilado($soporte));
        $this->assertSame(0, count($cliente->getSoportesAlquilados()));

    }

}
