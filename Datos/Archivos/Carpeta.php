<?php

namespace Mow\Datos\Archivos;

use Mow\Interfaz\Archivos\Carpeta as ICarpeta;

class Carpeta implements ICarpeta
{
    private $ruta;

    public function __construct(string $carpeta_ruta)
    {
        $this->ruta = rtrim($carpeta_ruta, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;

        if( !file_exists($carpeta_ruta) || !is_dir($carpeta_ruta) ) {
            trigger_error("La carpeta $carpeta_ruta no existe o no es una carpeta", E_USER_ERROR);
        }
    }

    public function ruta(): string
    {
        return $this->ruta;
    }

}

?>
