<?php

namespace Mow\Gestor\Sistema\Errores;

use Mow\Interfaz\Sistema\Errores\Guardable;
use Mow\Interfaz\Sistema\Errores\Imprimible;

class Errores
{
    private $g_guardado;
    private $g_impresion;

    public function __construct(Guardable $g_guardado, Imprimible $g_impresion)
    {
        $this->cambiarGestorDeGuardado($g_guardado);
        $this->cambiarGestorDeImpresion($g_impresion);
        register_shutdown_function([$this, 'ultimoError']);
    }

    public function ultimoError()
    {
        // Obtiene el ultimo error
        $error = error_get_last();

        // Y lo manda a los gestores
        if( !empty($error) ) {
            $this->gestorDeGuardado()->guardar($error);
            $this->gestorDeImpresion()->imprimir($error);
        }
    }

    public function cambiarGestorDeGuardado(Guardable $gestor)
    {
        $this->g_guardado = $gestor;
    }

    public function cambiarGestorDeImpresion(Imprimible $gestor)
    {
        $this->g_impresion = $gestor;
    }

    public function gestorDeGuardado(): Guardable
    {
        return $this->g_guardado;
    }

    public function gestorDeImpresion(): Imprimible
    {
        return $this->g_impresion;
    }

}

?>
