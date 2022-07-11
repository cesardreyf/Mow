<?php

namespace Mow\Interfaz\Memoria;

interface Memoria extends MemoriaSoloLectura
{
    public function definir(string $direccion, $valor);
}

?>
