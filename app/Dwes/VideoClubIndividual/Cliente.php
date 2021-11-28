<?php

namespace Dwes\VideoClubIndividual;

use Dwes\VideoClubIndividual\Util\CupoSuperadoException;
use Dwes\VideoClubIndividual\Util\LogFactory;
use Dwes\VideoClubIndividual\Util\SoporteNoEncontradoException;
use Dwes\VideoClubIndividual\Util\SoporteYaAlquiladoException;
use Dwes\VideoClubIndividual\Util\VideoClubException;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class Cliente {

    private static int $numClientes = 0;
    private string $numero;
    private string $nombre;
    private int $maxAlquilerConcurrente;
    /**
     * Número total de soportes alquilados
     *
     * @var integer
     */
    private int $numSoportesAlquilados;
    private array $SoportesAlquilados;
    private Logger $clienteLog;
    private string $usuario;
    private string $password;



    public function __construct(string $usuario, string $password, string $nombre, 
    int $maxAlquilerConcurrente = 3) {
        self::$numClientes++;
        $this->numero = intval(self::$numClientes);
        $this->nombre = $nombre;
        $this->usuario = $usuario;
        $this->password = $password;
        $this->maxAlquilerConcurrente = $maxAlquilerConcurrente;
        $this->numSoportesAlquilados = 0;
        $this->SoportesAlquilados = [];
        $this->clienteLog = LogFactory::getLogger("ClienteLogger");
    }

    public function getNombre() : string {
        return $this->nombre;
    }

    public function getNumero() : string {
        return $this->numero;
    }

    public function getUser() : string {
        return $this->usuario;
    }

    public function getPassword() : string {
        return $this->password;
    }

    public function getLogger() : Logger {
        return $this->clienteLog;
    }

    public function setNombre(string $nombre) {
        $this->nombre = $nombre;
    }

    public function setUser(string $user) {
        $this->usuario = $user;
    }

    public function setPassword(string $password) {
        $this->password = $password;
    }

    public function getNumSoportesAlquilados(): int {
        return $this->numSoportesAlquilados;
    }

    public function tieneAlquilado(Soporte $s): bool {
        //El array de soportes será un array clave-valor
        return (isset($this->SoportesAlquilados[$s->getIdentificador()]));
    }

    public function getSoportesAlquilados() : array {
        return $this->SoportesAlquilados;
    }

    /**
     * Debe comprobar si el soporte está alquilado y si no ha superado el cupo de
     *  alquileres. Al alquilar, incrementará el numSoportesAlquilados y
     *  almacenará el soporte en el array. Para cada caso debe mostrar un mensaje informando de lo ocurrido.
     */
    public function alquilar(Soporte $s): void {
        //Comprobamos si ha superado el máximo de alquileres disponibles
        if (count($this->SoportesAlquilados) >= $this->maxAlquilerConcurrente) {
            throw new CupoSuperadoException("Has superado el máximo de alquileres");
        }
        //Comprobamos que el soporte esté alquilado
        if ($s->getAlquilado() == false) {
            //Asignamos el soporte al array de soportes del cliente
            $this->SoportesAlquilados[$s->getIdentificador()] = $s; //Array asociativo
            $s->setAlquilado(true);
            $this->numSoportesAlquilados++;
            $this->clienteLog->info("Alquilado soporte " . $s->getTitulo() . "a " . $this->nombre);
        }else {
            throw new SoporteYaAlquiladoException("El soporte " . $s->getTitulo() . " ya está alquilado.");
        }
    }
    
    public function devolver(Soporte $s) : void {
        //La existencia del soporte o el cliente vienen filtrados por el método de videoclub,
        //se supone que aquí ya viene el soporte existiendo
        if (!isset($this->getSoportesAlquilados()[$s->getIdentificador()])) {
            throw new SoporteNoEncontradoException("El cliente no tiene alquilado este soporte");
        }
        if ($s->getAlquilado() == true) {
            //Eliminamos del array de soportes el soporte introducido
            unset($this->SoportesAlquilados[$s->getIdentificador()]);
            //Le volvemos a dar el valor de alquilado a falso
            $s->setAlquilado(false);
            //Escribimos en el log el alquilar
            $this->clienteLog->info("El soporte " . $s->getTitulo() . " ha sido devuelto por " . $this->getNombre());
            //Devolvemos true si todo se ha realizado con éxito
        }else {
            throw new VideoClubException("Error al devolver el soporte, no aparecía como alquilado");
        }
    }

    /**
     * Invocamos el array de alquileres con objetos soporte y llamamos al 
     * método de mostrar resumen
     *
     * @return void Escribe por pantalla el resumen de cada soporte alquilado
     */
    public function listarAlquileres() : void {
        foreach ($this->SoportesAlquilados as $Identificador => $soporte) {
            echo "<br>";
            $soporte->muestraResumen();
            echo "<br>";
        }
    }

    public function muestraResumen() : void {
        echo "Nombre: " . $this->nombre . "<br>";
        echo "Nombre de usuario: " . $this->usuario . ".<br>";
        echo "Número de soportes alquilados: " .  $this->numSoportesAlquilados . "<br>";
        echo "Soportes alquilados: " . count($this->SoportesAlquilados) . "<br>";
    }
}
