<?php

declare(strict_types=1);
namespace Dwes\VideoClubIndividual;

abstract class Soporte implements Resumible {
    public static float $IVA = 21;
    protected string $titulo;
    protected string $identificador;
    private float $precio;
    protected bool $alquilado;

    public function __construct(string $identificador, string $titulo, float $precio)
    {
        $this->identificador = $identificador;
        $this->titulo = $titulo;
        $this->precio = $precio;
        $this->alquilado = false;
    }

    public function getPrecio() {
        return $this->precio;
    }

    public function getPrecioConIva() {
        return $this->precio * (1+ self::$IVA/100);
    }

    public function getIdentificador() {
        return $this->identificador;
    }

    public function getTitulo() : string {
        return $this->titulo;
    }

    public function getAlquilado() : bool {
        return $this->alquilado;
    }

    public function setAlquilado(bool $alquilado) {
        $this->alquilado = $alquilado;
    }

    public function muestraResumen() : string {
        $cadena = $this->identificador . "<br>" .
        "<i>" . $this->titulo . "</i><br>" .
         $this->precio . "€ (IVA no incluido)<br>";
        if ($this->alquilado) {
            $cadena .= "Alquilado";
        }else {
            $cadena .= "NO Alquilado";
        }
        $cadena.= "<br>";
        return $cadena;
    }

}