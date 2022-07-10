<?php

namespace Mow\Interfaz\Sistema\Excepciones;

use Throwable;

interface Guardable
{
    public function guardar(Throwable $e);
}

?>
