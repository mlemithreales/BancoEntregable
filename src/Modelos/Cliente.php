<?php

namespace App\Modelos;

class Cliente
{
    public function __construct(
        public readonly int $id,
        public readonly string $nombre,
    ) {
    }

    public static function desdeFila(array $fila): self
    {
        return new self((int) $fila['id'], $fila['nombre']);
    }
}
