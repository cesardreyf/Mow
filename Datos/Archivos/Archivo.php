<?php

namespace Mow\Datos\Archivos;

use Mow\Interfaz\Archivos\Archivo as IArchivo;

class Archivo implements IArchivo
{
    private $archivo_ruta;

    public function __construct(string $archivo_ruta)
    {
        $this->archivo_ruta = $archivo_ruta;

        if( !file_exists($archivo_ruta) ) {
            trigger_error("El archivo $archivo_ruta no existe", E_USER_ERROR);
        }
    }

    public function ruta(): string
    {
        return $this->archivo_ruta;
    }

}
