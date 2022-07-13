<?php

namespace Mow\Datos\Memoria\Cargar\Desde\Archivo;

use Mow\Interfaz\Memoria\Memoria as IMemoria;

class Memoria extends MemoriaSoloLectura implements IMemoria
{

    public function definir(string $direccion, $valor)
    {
        return $this->vector[$direccion] = $valor;
    }

}
