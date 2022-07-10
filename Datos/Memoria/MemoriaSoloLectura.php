<?php

namespace Mow\Datos\Memoria;

use Mow\Interfaz\Memoria\MemoriaSoloLectura as MSL;;

class MemoriaSoloLectura implements MSL
{

    public function __construct(array $buffer)
    {
        $this->buffer = $buffer;
    }

    public function obtener(string $direccion): string
    {
        return $this->buffer[$direccion];
    }

}

?>
