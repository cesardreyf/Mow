<?php

namespace Mow\Gestor\Sistema\Excepciones;

use Mow\Datos\Sistema\Excepciones\Guardar\GuardarNada;
use Mow\Datos\Sistema\Excepciones\Guardar\ImprimirNada;
use Mow\Interfaz\Memoria\MemoriaSoloLectura as MSL;
use Mow\Interfaz\Sistema\Excepciones\Guardable;
use Mow\Interfaz\Sistema\Excepciones\Imprimible;
use Throwable;

class Excepciones
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

        set_exception_handler([$this, 'guardarExcepcion']);
    }

    public function guardarExcepcion(Throwable $excepcion)
    {
        $this->gestorDeGuardado()->guardar($excepcion);
        $this->gestorDeImpresion()->imprimir($excepcion);
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
