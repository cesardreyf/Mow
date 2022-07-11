<?php

namespace Mow\Datos\Memoria;

use Exception;
use Mow\Interfaz\Memoria\MemoriaSoloLectura as MSL;;

class MemoriaSoloLectura implements MSL
{
    protected $memoria_v; //< Vector
    protected $memoria_i; //< Identificador

    public function __construct(string $id, array $buffer)
    {
        $this->memoria_v = $buffer;
        $this->memoria_i = $id;
    }

    public function obtener(string $direccion)
    {
        if( isset($this->memoria_v[$direccion]) ) {
            return $this->memoria_v[$direccion];
        }

        throw new Exception("La memoria '$this->memoria_i' no contiene el índice '$direccion'");
    }

}

?>
