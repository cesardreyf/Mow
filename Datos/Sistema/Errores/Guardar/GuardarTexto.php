<?php

namespace Mow\Datos\Sistema\Errores\Guardar;

use Mow\Datos\Archivos\Archivo;
use Mow\Interfaz\Sistema\Errores\Guardable;

class GuardarTexto implements Guardable
{
    protected $tipoDeErrores = [
            E_ERROR             => 'E_ERROR'
        ,   E_WARNING           => 'E_WARNING'
        ,   E_PARSE             => 'E_PARSE'
        ,   E_NOTICE            => 'E_NOTICE'
        ,   E_CORE_ERROR        => 'E_CORE_ERROR'
        ,   E_CORE_WARNING      => 'E_CORE_WARNING'
        ,   E_COMPILE_ERROR     => 'E_COMPILE_ERROR'
        ,   E_COMPILE_WARNING   => 'E_COMPILE_WARNING'
        ,   E_USER_ERROR        => 'E_USER_ERROR'
        ,   E_USER_WARNING      => 'E_USER_WARNING'
        ,   E_USER_NOTICE       => 'E_USER_NOTICE'
        ,   E_STRICT            => 'E_STRICT'
        ,   E_RECOVERABLE_ERROR => 'E_RECOVERABLE_ERROR'
        ,   E_DEPRECATED        => 'E_DEPRECATED'
        ,   E_USER_DEPRECATED   => 'E_USER_DEPRECATED'
    ];

    private $archivo;

    public function __construct(Archivo $archivo)
    {
        $this->archivo = $archivo;
    }

    public function guardar(array $error)
    {
        $texto  = date('(d/m/Y) [G:i:s]')                                      . "\n\n\t"
        .   'Tipo    ' . $this->tipoDeErrores[$error['type']]                   . "\n\t"
        .   'Linea   ' . $error['line']                                         . "\n\t"
        .   'Archivo ' . $error['file']                                         . "\n\t"
        .   'Mensaje ' . str_replace("\n",   "\n\t        ", $error['message']) . "\n\n";

        file_put_contents($this->archivo->ruta(), $texto, FILE_APPEND);
    }

}
