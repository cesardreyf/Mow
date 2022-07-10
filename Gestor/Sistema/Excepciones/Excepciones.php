<?php

namespace Mow\Gestor\Sistema\Excepciones;

use Mow\Interfaz\Sistema\Excepciones\Guardable;
use Mow\Interfaz\Sistema\Excepciones\Imprimible;
use Throwable;

class Excepciones
{
    private $g_guardado;
    private $g_impresion;

    public function __construct(Guardable $g_guardado, Imprimible $g_impresion)
    {
        $this->cambiarGestorDeGuardado($g_guardado);
        $this->cambiarGestorDeImpresion($g_impresion);

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
