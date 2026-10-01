<?php

namespace App\Modelos;

class Transferencia
{
    public function __construct(
        public readonly int $id,
        public readonly int $cuentaOrigenId,
        public readonly int $cuentaDestinoId,
        public readonly string $cuentaOrigen,
        public readonly string $cuentaDestino,
        public readonly float $valor,
        public readonly string $fecha,
    ) {
    }

    public static function desdeFila(array $fila): self
    {
        return new self(
            (int) $fila['id'],
            (int) $fila['cuenta_origen_id'],
            (int) $fila['cuenta_destino_id'],
            $fila['cuenta_origen'],
            $fila['cuenta_destino'],
            (float) $fila['valor'],
            $fila['fecha']
        );
    }
}
