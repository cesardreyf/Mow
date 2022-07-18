<?php

namespace Mow\Interfaz\Sesion;

interface Sesion
{
    public function iniciar(): bool;
    public function finalizar(): bool;
    public function estado(): int;
    public function destruir(): bool;
    public function obtener(string $clave);
    public function definir(string $clave, $valor);
    public function existe(string $clave): bool;
    public function nombre(string $nombre): string;
    public function eliminar(string $clave);
}
