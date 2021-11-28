<?php
declare(strict_types=1);
namespace Dwes\VideoClubIndividual;

use Dwes\VideoClubIndividual\Util\ClienteNoEncontradoException;
use Dwes\VideoClubIndividual\Util\LogFactory;
use Dwes\VideoClubIndividual\Util\SoporteNoEncontradoException;
use Dwes\VideoClubIndividual\Util\VideoClubException;
use Monolog\Logger;

class VideoClub {
    private string $nombre;
    private array $productos;
    private int $numeroProductos;
    private array $socios;
    private int $numeroSocios;
    private int $numeroProductosAlquilados;
    private int $numeroTotalAlquileres;
    private Logger $videoClubLog;

    public function __construct($nombre) {
        $this->nombre = $nombre;
        //Inicializamos las variables y el logger al crear un nuevo videoculub
        //mirar teoría del logger
        $this->productos = [];
        $this->socios = [];
        $this->numeroProductos = 0;
        $this->numeroSocios = 0;
        $this->numeroProductosAlquilados = 0;
        $this->numeroTotalAlquileres = 0;
        $this->videoClubLog=LogFactory::getLogger("VideoClubLogger");
    }

    public function getNombre() : string {
        return $this->nombre;
    }

    public function getSoportes() : array {
        return $this->productos;
    }

    public function getClientes() : array {
        return $this->socios;
    }

    public function getNumeroProductosAlquilados() : int {
        return $this->numeroProductosAlquilados;
    }

    public function getNumeroTotalAlquileres() : int {
        return $this->numeroTotalAlquileres;
    }

    private function incluirProducto (Soporte $p) {
        //Añadimos el producto como array asociativo
        $this->productos[$p->getIdentificador()] = $p;
        $this->numeroProductos++;
        $this->videoClubLog->info("Añadido soporte " . $p->getTitulo() . ".");
        //Mirar después
    }

    public function incluirCinta (string $identificador, string $titulo, float $precio, int $duracion) {
        //$identificador = bin2hex(random_bytes(5));
        //Creamos una cinta de vídeo
        $cv = new CintaVideo($identificador, $titulo, $precio, $duracion);
        //LLamamos a la función privada incluirProducto para añadir el soporte
        $this->incluirProducto($cv);

    }

    public function incluirDvd(string $identificador, string $titulo, float $precio, string $idiomas, string $pantalla) {
        //$identificador = bin2hex(random_bytes(5));
        $arrayIdiomas = explode(", " , $idiomas);
        $dvd = new Dvd($identificador, $titulo, $precio, $arrayIdiomas, $pantalla);
        $this->incluirProducto($dvd);
    }

    public function incluirJuego(string $identificador, string $titulo, float $precio, string $consola, int $minJ, int $maxJ) {
        //$identificador = bin2hex(random_bytes(5));
        $juego = new Juego($identificador, $titulo, $precio, $consola, $minJ, $maxJ);
        $this->incluirProducto($juego);

    }

    public function incluirSocio(string $usuario, string $password, string $nombre, int $maxAlquileresConcurrentes = 3) : Cliente {
        //$identificador =  bin2hex(random_bytes(5)) ; //Esto estaría mejor meterlo en el contructor original
        $cliente = new Cliente($usuario, $password, $nombre, $maxAlquileresConcurrentes);
        $this->socios[$usuario] = $cliente;
        $this->numeroSocios++;
        $this->videoClubLog->info("Se ha añadido el Socio " . $cliente->getNumero() . " " .  $nombre . " a socios.", [$cliente]);
        return $cliente;
    }

    public function listarProductos() {
        foreach ($this->productos as $identificador => $producto) {
            echo "<br>";
            $producto->muestraResumen();
            echo "<br>";
        }
    }

    public function listarSocios() {
        foreach ($this->socios as $usuario => $socio) {
            echo "<br>";
            $socio->muestraResumen();
            echo "<br>";
        }
    }

    public function alquilarSocioProducto(string $idCliente, string $idSoporte) {
        try {
            if (!isset($this->socios[$idCliente])) {
                throw new ClienteNoEncontradoException("El cliente " . $idCliente . " no existe");
            }
            if (!isset($this->productos[$idSoporte])) {
                throw new SoporteNoEncontradoException("El soporte " . $idSoporte . " no existe.");
            }
            $this->socios[$idCliente]->alquilar($this->productos[$idSoporte]);
            $this->numeroProductosAlquilados++;
            $this->numeroTotalAlquileres++;

        }catch (ClienteNoEncontradoException $e) {
            $this->videoClubLog->warning($e);
            echo $e->getMessage();            
        }catch (SoporteNoEncontradoException $e) {
            $this->videoClubLog->warning($e); 
            echo $e->getMessage();
        }catch (VideoClubException $e) {
            $this->videoClubLog->warning($e);
            echo $e->getMessage();
        }        
    }

    public function devolverSocioProducto(string $idCliente, string $idSoporte) {
        try {
            if (!isset($this->socios[$idCliente])) {
                throw new ClienteNoEncontradoException("El cliente " . $idCliente . " no existe");
            }
            if (!isset($this->productos[$idSoporte])) {
                throw new SoporteNoEncontradoException("El soporte " . $idSoporte . " no existe.");
            }
            $this->socios[$idCliente]->devolver($this->productos[$idSoporte]);
            $this->numeroProductosAlquilados--;

        }catch (ClienteNoEncontradoException $e) {
            $this->videoClubLog->warning($e);
            echo $e->getMessage();            
        }catch (SoporteNoEncontradoException $e) {
            $this->videoClubLog->warning($e); 
            echo $e->getMessage();
        }catch (VideoClubException $e) {
            $this->videoClubLog->warning($e);
            echo $e->getMessage();
        }        
    }

    public function alquilarSocioProductos(string $idCliente, array $idProductos) : VideoClub {
        foreach ($idProductos as $idProducto) {
            $this->alquilarSocioProducto($idCliente, $idProducto);
        }
        return $this;
    }

    public function devolverSocioProductos(string $idCliente, array $idProductos) : VideoClub {
        foreach ($idProductos as $idProducto) {
            $this->devolverSocioProducto($idCliente, $idProducto);
        }
        return $this;
    }

}