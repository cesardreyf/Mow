<?php

namespace Mow\Datos\Sistema\Excepciones\Imprimir;

use Mow\Interfaz\Sistema\Excepciones\Imprimible;
use Throwable;

class ImprimirTexto implements Imprimible
{

    public function imprimir(Throwable $excepcion)
    {
        echo '<pre>', print_r($excepcion), '</pre>';
    }

}

?>
