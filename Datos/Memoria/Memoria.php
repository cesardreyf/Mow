<?php

namespace Mow\Datos\Memoria;

use Mow\Interfaz\Memoria\Memoria as IMemoria;

class Memoria implements IMemoria extends MemoriaSoloLectura
{

    public function definir(string $direccion, string $valor)
    {
        return $this->memoria_v[$direccion] = $valor;
    }

}

?>
