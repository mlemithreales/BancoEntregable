<?php

namespace App\Modelos;

class Cuenta
{
    public function __construct(
        public readonly int $id,
        public readonly string $numeroCuenta,
        public readonly float $saldo,
        public readonly int $clienteId,
        public readonly string $clienteNombre = '',
    ) {
    }

    public static function desdeFila(array $fila): self
    {
        return new self(
            (int) $fila['id'],
            $fila['numero_cuenta'],
            (float) $fila['saldo'],
            (int) $fila['cliente_id'],
            $fila['cliente_nombre'] ?? ''
        );
    }
}
