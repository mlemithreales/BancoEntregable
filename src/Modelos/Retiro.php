<?php

namespace App\Modelos;

class Retiro
{
    public function __construct(
        public readonly int $id,
        public readonly int $cuentaId,
        public readonly float $valor,
        public readonly string $fecha,
    ) {
    }

    public static function desdeFila(array $fila): self
    {
        return new self(
            (int) $fila['id'],
            (int) $fila['cuenta_id'],
            (float) $fila['valor'],
            $fila['fecha']
        );
    }
}
