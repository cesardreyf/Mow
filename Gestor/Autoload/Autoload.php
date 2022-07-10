<?php

namespace Mow\Gestor\Autoload;

define('_MOW_NAMESPACE', 'Mow');
define('_MOW_CARPETA', dirname(dirname(__DIR__)));

// Singleton (?)
class Autoload
{

    public function __construct(string $carpeta_base = _MOW_CARPETA, string $namespace = _MOW_NAMESPACE)
    {
        spl_autoload_register(function($clase_nombre) use ($carpeta_base, $namespace) {
            self::autoload($clase_nombre, $carpeta_base, $namespace);
        });
    }

    static function autoload(string $clase_nombre, string $carpeta_base, string $namespace)
    {
        // Obtiene solo el primer "namespace"
        $primer_backslash = strpos($clase_nombre, '\\');
        $espacio_nombre = substr($clase_nombre, 0, $primer_backslash);

        // Si coincide con lo esperado carga el archivo
        if( $espacio_nombre == $namespace ) {
            // Limpia la direccion de la ruta para que no hayan errores al incluir el archivo
            $carpeta_ruta_limpia = rtrim($carpeta_base, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;

            // Elimina el primer "namespace" y limpia la ruta
            $clase_archivo_ruta_limpia = trim(str_replace('\\', DIRECTORY_SEPARATOR, substr($clase_nombre, $primer_backslash)), DIRECTORY_SEPARATOR);

            require $carpeta_ruta_limpia . $clase_archivo_ruta_limpia . '.php';
        }
    }

}

?>
