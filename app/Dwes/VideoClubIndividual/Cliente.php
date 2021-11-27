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
    private string $identificador;



    public function __construct(string $identificador, string $nombre, int $maxAlquilerConcurrente = 3)
    {
        self::$numClientes++;
        $this->numero = intval(self::$numClientes);
        $this->nombre = $nombre;
        $this->maxAlquilerConcurrente = $maxAlquilerConcurrente;
        $this->identificador = $identificador;
        $this->numSoportesAlquilados = 0;
        $this->SoportesAlquilados = [];
        $this->clienteLog = new Logger("ClienteLogger");
        $this->clienteLog->pushHandler(new RotatingFileHandler("logs/cliente.log"), 0, Logger::DEBUG);

    }

    public function getNombre() : string {
        return $this->nombre;
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

    public function getSoportesAlquilados() : array {
        return $this->SoportesAlquilados;
    }

    /**
     * Debe comprobar si el soporte está alquilado y si no ha superado el cupo de
     *  alquileres. Al alquilar, incrementará el numSoportesAlquilados y
     *  almacenará el soporte en el array. Para cada caso debe mostrar un mensaje informando de lo ocurrido.
     */
    public function alquilar(Soporte $s): bool
    {
        //Comprobamos que el soporte esté alquilado
        if ($s->getAlquilado() == false) {
            //Asignamos el soporte al array de soportes del cliente
            $this->SoportesAlquilados[$s->getIdentificador()] = $s; //Array asociativo
            $s->setAlquilado(true);
            $this->clienteLog->info("Alquilado soporte " . $s->getTitulo() . "a " . $this->nombre);
            return true;
        }else {
            return false;
        }
    }

    public function devolver(Soporte $s) : bool {
        //Podríamos añadir una condición que solo se haga si el soporte introducido existe
        if ($s->getAlquilado() == true) {
            //Eliminamos del array de soportes el soporte introducido
            unset($this->SoportesAlquilados[$s->getIdentificador()]);
            //Le volvemos a dar el valor de alquilado a falso
            $s->setAlquilado(false);
            //Escribimos en el log el alquilar
            $this->clienteLog->info("El soporte " . $s->getTitulo() . " ha sido devuelto por " . $this->getNombre());
            //Devolvemos true si todo se ha realizado con éxito
            return true;

        }else {
            //Aquí podríamos lanzar un mensaje en log o una excepción
            return false;
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
        echo "Número de soportes alquilados: " .  $this->numSoportesAlquilados . "<br>";
        echo "Soportes alquilados: " . count($this->SoportesAlquilados) . "<br>";
    }
}
