<?php

namespace Mow\Datos\Sistema\Excepciones\Imprimir;

use Mow\Interfaz\Sistema\Excepciones\Imprimible;
use Throwable;

class ImprimirNada implements Imprimible
{

    public function imprimir(Throwable $excepcion)
    {
    }

}
