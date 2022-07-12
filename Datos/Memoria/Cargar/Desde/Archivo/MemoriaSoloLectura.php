<?php

namespace Mow\Datos\Memoria\Cargar\Desde\Archivo;

use Exception;
use Mow\Interfaz\Archivos\Archivo;
use Mow\Interfaz\Memoria\MemoriaSoloLectura as MSL;

class MemoriaSoloLectura implements MSL
{
    protected $archivo;
    protected $vector;

    public function __construct(Archivo $archivo)
    {
        $this->archivo = $archivo;
        $this->vector = require $archivo->ruta();

        if( !is_array($this->vector) ) {
            $archivo_ruta = $archivo->ruta();
            throw new Exception("El archivo '$archivo_ruta' no devuelve un array");
        }
    }

    public function obtener(string $direccion)
    {
        if( isset($this->vector[$direccion]) ) {
            return $this->vector[$direccion];
        }

        $ruta_archivo = $this->archivo->ruta();
        throw new Exception("El array del archivo '$ruta_archivo' no contiene el índice '$direccion'");
    }

}

?>
