<?php

namespace Mow\Datos\Sistema\Excepciones\Guardar;

use Mow\Interfaz\Archivos\Archivo;
use Mow\Interfaz\Sistema\Excepciones\Guardable;
use Throwable;

class GuardarTexto implements Guardable
{
    private $archivo;

    public function __construct(Archivo $archivo)
    {
        $this->archivo = $archivo;
    }

    public function guardar(Throwable $excepcion)
    {
        $texto  = date('(d/m/Y) [G:i:s]') . "\n\n\t"
        .   'Tipo      ' . get_class($excepcion) . "\n\t"
        .   'Mensaje   ' . $excepcion->getMessage() . "\n\t"
        .   'Archivo   ' . $excepcion->getFile() . "\n\t"
        .   'Linea     ' . $excepcion->getLine() . "\n\t"
        .   'Codigo    ' . $excepcion->getCode() . "\n\t"
        .   'Trace     ' . str_replace("\n", "\n\t          ", $excepcion->getTraceAsString()) . "\n\n";
        file_put_contents($this->archivo->ruta(), $texto, FILE_APPEND);
    }

}
