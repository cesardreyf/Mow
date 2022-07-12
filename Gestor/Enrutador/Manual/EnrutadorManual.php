<?php

namespace Mow\Gestor\Enrutador\Manual;

use Mow\Interfaz\Lista;
use Mow\Interfaz\Memoria\MemoriaSoloLectura as MSL;

class EnrutadorManual
{
    private $clase_nombre;
    private $clase_namespace;

    public function __construct(Lista $lista, MSL $memoria)
    {
        $pagina_principal = $memoria->obtener('pagina_principal');
        $pagina_error_404 = $memoria->obtener('pagina_error_404');
        $paginas_disponibles = $memoria->obtener('paginas_disponibles');
        $paginas_objetivos = $lista->lista();

        $this->clase_namespace = '';
        $this->clase_nombre = ucfirst($pagina_principal);

        if( !empty($paginas_objetivos) ) {
            while( $objetivo = array_shift($paginas_objetivos) ) {
                // if( !is_string($objetivo) ) {
                //     // TAREA: Lanzar una excepcion
                // }

                // Si el objetivo concuerda con alguna página final
                if( in_array($objetivo, $paginas_disponibles) ) {
                    $this->clase_nombre = ucfirst($objetivo);
                    break;
                }

                // Si el objetivo no es un array, osea, una página que cotiene
                // otras páginas, entonces se considera que dicha pagina no existe
                if( !isset($paginas_disponibles[$objetivo]) || !is_array($paginas_disponibles[$objetivo]) ) {
                    $this->clase_nombre = ucfirst($pagina_error_404);
                    $this->clase_namespace = '';
                    break;
                }

                // Por cada pagina que contiene otras paginas (array)
                // se asume que tiene un $pagina_principal dentro
                $this->clase_nombre = ucfirst($pagina_principal);
                $this->clase_namespace .= ucfirst($objetivo) . '\\';
                $paginas_disponibles = $paginas_disponibles[$objetivo];
            }
        }
    }

    public function clase(): string
    {
        return $this->clase_namespace . $this->clase_nombre;
    }

}

?>
