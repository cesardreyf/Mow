<?php

namespace Mow\Gestor\Invocador;

use Mow\Interfaz\Archivos\Carpeta;

class Invocador
{
    // Lista de namespace's
    private $namespace_reservados;

    private $namespace_general;

    public function __construct()
    {
        $this->namespace_general = null;
        $this->namespace_reservados = array();

        $namespace_general =& $this->namespace_general;
        $namespace_reservados =& $this->namespace_reservados;

        spl_autoload_register(function($clase_nombre) use (&$namespace_general, &$namespace_reservados) {
            $clase_namespace_strpos = strpos($clase_nombre, '\\');
            $clase_namespace = substr($clase_nombre, 0, $clase_namespace_strpos);
            $archivo_nombre = trim(str_replace('\\', DIRECTORY_SEPARATOR, substr($clase_nombre, $clase_namespace_strpos)), DIRECTORY_SEPARATOR);

            if( isset($namespace_reservados[$clase_namespace]) ) {
                $archivo_ruta = $namespace_reservados[$clase_namespace]->ruta() . $archivo_nombre . '.php';
            } else if( $namespace_general !== null ) {
                $clase_namespace = empty($clase_namespace) ? '' : $clase_namespace . DIRECTORY_SEPARATOR;
                $archivo_ruta = $namespace_general->ruta() . $clase_namespace . $archivo_nombre . '.php';
            } else {
                return;
            }

            // TAREA: Validar si el archivo existe (?)
            require $archivo_ruta;

            if( class_exists($clase_nombre, false) || interface_exists($clase_nombre, false) ) return;
            else trigger_error("No se encontró '$clase_nombre' en '$archivo_ruta'", E_USER_ERROR);
        });
    }

    public function reservarNamespace(string $namespace, Carpeta $carpeta)
    {
        if( !empty($namespace) ) {
            $this->namespace_reservados[$namespace] = $carpeta;
        } else {
            $this->namespace_general = $carpeta;
        }
    }

    public function invocar(string $clase, ...$argumentos): object
    {
        class_exists($clase, true);
        return new $clase(...$argumentos);
    }

}
