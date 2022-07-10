<?php

namespace Mow\Gestor\Invocador;

use Mow\Interfaz\Archivos\Carpeta;

class Invocador
{
    // Carpeta donde va a buscar si no se especifica ningun namespace
    private $carpeta_principal;

    // Lista de namespace's
    private $namespace_reservados;

    public function __construct(Carpeta $carpeta_principal)
    {
        $this->carpeta_principal = $carpeta_principal;
        $this->namespace_reservados = array();
    }

    public function registrarAutoload()
    {
        $carpeta_principal = $this->carpeta_principal;
        $namespace_reservados = $this->namespace_reservados;

        spl_autoload_register(function($clase_nombre) use ($carpeta_principal, $namespace_reservados) {
            $clase_namespace_strpos = strpos($clase_nombre, '\\');
            $clase_namespace = substr($clase_nombre, 0, $clase_namespace_strpos);
            $archivo_nombre = trim(str_replace('\\', DIRECTORY_SEPARATOR, substr($clase_nombre, $clase_namespace_strpos)), DIRECTORY_SEPARATOR);

            if( isset($namespace_reservados[$clase_namespace]) ) {
                $archivo_ruta = $namespace_reservados[$clase_namespace]->ruta() . $archivo_nombre . '.php';
            } else {
                $clase_namespace = empty($clase_namespace) ? '' : $clase_namespace . DIRECTORY_SEPARATOR;
                $archivo_ruta = $carpeta_principal->ruta() . $clase_namespace . $archivo_nombre . '.php';
            }

            // TAREA: Validar si el archivo existe (?)
            require $archivo_ruta;

            if( !class_exists($clase_nombre) || !interface_exists($clase_nombre, false) ) {
                trigger_error("No se encontró '$clase_nombre' en '$archivo_ruta'", E_USER_ERROR);
            }
        });
    }

    public function reservarNamespace(string $namespace, Carpeta $carpeta)
    {
        $this->namespace_reservados[$namespace] = $carpeta;
    }

}

?>
