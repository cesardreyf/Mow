<?php

namespace Mow\Interfaz\Sistema\Excepciones;

use Throwable;

interface Imprimible
{
    public function imprimir(Throwable $e);
}

?>
