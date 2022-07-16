<?php

namespace Mow\Gestor\Marcas;

use Mow\Interfaz\Marcas\Marcas as IMarcas;

class Marcas implements IMarcas
{
    // Mascara de bits
    private $marcas;

    public function __construct(int $marcas = 0)
    {
        $this->marcas = $marcas;
    }

    public function activar(int $marcas): int
    {
        return $this->marcas |= $marcas;
    }

    public function desactivar(int $marcas): int
    {
        return $this->marcas &= ~$marcas;
    }

    public function obtener(int $marcas): bool
    {
        return $this->marcas & $marcas;
    }

    public function definir(int $marcas): int
    {
        return $this->marcas = $marcas;
    }

}
