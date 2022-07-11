<?php

namespace Mow\Gestor\Sistema\Errores;

use Mow\Datos\Sistema\Errores\Guardar\GuardarNada;
use Mow\Datos\Sistema\Errores\Imprimir\ImprimirNada;
use Mow\Interfaz\Memoria\MemoriaSoloLectura as MSL;
use Mow\Interfaz\Sistema\Errores\Guardable;
use Mow\Interfaz\Sistema\Errores\Imprimible;

class Errores
{
    private $g_guardado;
    private $g_impresion;

    public function __construct(MSL $config, ?Guardable $g_guardado = null, ?Imprimible $g_impresion = null)
    {
        if( $config->obtener('guardar') == true && $g_guardado !== null ) {
            $this->cambiarGestorDeGuardado($g_guardado);
        } else {
            $this->cambiarGestorDeGuardado(new GuardarNada());
        }

        if( $config->obtener('imprimir') == true && $g_impresion !== null ) {
            $this->cambiarGestorDeImpresion($g_impresion);
        } else {
            $this->cambiarGestorDeImpresion(new ImprimirNada());
        }

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
