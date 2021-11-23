<?php

namespace Dwes\VideoClubIndividual;

use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class Cliente
{

    private static int $numClientes = 0;
    private string $numero;
    private string $nombre;
    private int $maxAlquilerConcurrente;
    private int $numSoportesAlquilados;
    private array $SoportesAlquilados;
    private Logger $clienteLog;



    public function __construct(string $nombre, int $maxAlquilerConcurrente = 3)
    {
        self::$numClientes++;
        $this->numero = intval(self::$numClientes);
        $this->nombre = $nombre;
        $this->maxAlquilerConcurrente = $maxAlquilerConcurrente;
        $this->numSoportesAlquilados = 0;
        $this->SoportesAlquilados = [];
        $this->clienteLog = new Logger("ClienteLogger");
        $this->clienteLog->pushHandler(new RotatingFileHandler("logs/cliente.log"), 0, Logger::DEBUG);

    }

    public function getNumero(): string
    {
        return $this->numero;
    }

    public function getNumSoportesAlquilados(): int
    {
        return $this->numSoportesAlquilados;
    }

    public function tieneAlquilado(Soporte $s): bool
    {
        //El array de soportes será un array clave-valor
        return (isset($this->SoportesAlquilados[$s->getIdentificador()]));
    }

    /**
     * Debe comprobar si el soporte está alquilado y si no ha superado el cupo de
     *  alquileres. Al alquilar, incrementará el numSoportesAlquilados y
     *  almacenará el soporte en el array. Para cada caso debe mostrar un mensaje informando de lo ocurrido.
     */
    public function alquilar(Soporte $s): bool
    {
        //Comprobamos que el soporte esté alquilado
        if ($s->alquilado == false) {
            //Asignamos el soporte al array de soportes del cliente
            $SoportesAlquilados[$s->getIdentificador()] = $s; //Array asociativo
            $s->alquilado = true;
            $this->clienteLog->info("Alquilado soporte " . $s->titulo . "a " . $this->nombre);
            return true;
        }else {
            return false;
        }
    }

    public function muestraResumen()
    {
        echo "Nombre: " . $this->nombre . "<br>";
        echo "Número de soportes alquilados: " .  $this->numSoportesAlquilados . "<br>";
        echo "Soportes alquilados: " . count($this->SoportesAlquilados) . "<br>";
    }
}
