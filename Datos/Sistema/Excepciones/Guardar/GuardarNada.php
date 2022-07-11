<?php

namespace Mow\Datos\Sistema\Excepciones\Guardar;

use Mow\Interfaz\Archivos\Archivo;
use Mow\Interfaz\Sistema\Excepciones\Guardable;
use Throwable;

class GuardarNada implements Guardable
{

    public function guardar(Throwable $excepcion)
    {
    }

}

?>
