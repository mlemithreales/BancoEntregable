<?php

namespace App\Modelos;

class Usuario
{
    public function __construct(
        public readonly int $id,
        public readonly int $cuentaId,
        public readonly string $claveHash,
    ) {
    }

    public static function desdeFila(array $fila): self
    {
        return new self(
            (int) $fila['id'],
            (int) $fila['cuenta_id'],
            $fila['clave_hash']
        );
    }
}
