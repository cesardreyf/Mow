<?php

namespace Mow\Interfaz\Marcas;

interface Marcas
{
    public function activar(int $marcas): int;
    public function desactivar(int $marcas): int;
    public function obtener(int $marcas): bool;
    public function definir(int $marcas): int;
}
