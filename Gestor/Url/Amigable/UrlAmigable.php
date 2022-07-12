<?php

namespace Mow\Gestor\Url\Amigable;

use Mow\Datos\Lista;
use Mow\Interfaz\Memoria\MemoriaSoloLectura as MSL;

class UrlAmigable
{
    private $lista;

    public function __construct(MSL $memoria)
    {
        $cfg_url_divisor = $memoria->obtener('url_amigable_divisor');
        $cfg_url_clave = $_GET[$memoria->obtener('url_amigable_clave')] ?? '';

        // Obtiene la lista en forma de cadena de texto y la limpia
        $url_limpia = trim($cfg_url_clave, '/');

        // Elimina todos los caracteres excepto letras, dígitos y $-_.+!*'(),{}|\\^~[]`<>#%";/?:@&=.
        $url_filtrada = filter_var($url_limpia, FILTER_SANITIZE_URL);

        // Divide la cadena de texto usando como criterio el 'cfg_url_divisor'
        $url_vector = explode($cfg_url_divisor, $url_filtrada, empty($url_filtrada) ? -1 : PHP_INT_MAX);

        // Crea la lista con el vector
        $this->lista = new Lista($url_vector);
    }

    public function lista(): Lista
    {
        return $this->lista;
    }

}
