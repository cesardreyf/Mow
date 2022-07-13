<?php

namespace Mow\Datos\Memoria;

use Mow\Interfaz\Memoria\Memoria as IMemoria;

class Memoria extends MemoriaSoloLectura implements IMemoria
{

    public function definir(string $direccion, $valor)
    {
        return $this->memoria_v[$direccion] = $valor;
    }

}
