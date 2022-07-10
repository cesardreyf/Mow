<?php

namespace Mow\Datos\Sistema\Errores\Imprimir;

use Mow\Interfaz\Sistema\Errores\Imprimible;

class ImprimirTexto implements Imprimible
{

    public function imprimir(array $error)
    {
        echo '<pre>', print_r($error), '<pre>';
    }

}

?>
