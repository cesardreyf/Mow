<?php

namespace Mow\Datos;

use Mow\Interfaz\Lista as ILista;

class Lista implements ILista
{
    private $lista;

    public function __construct(array $vector)
    {
        $this->lista = $vector;
    }

    public function lista(): array
    {
        return $this->lista;
    }

}

?>
