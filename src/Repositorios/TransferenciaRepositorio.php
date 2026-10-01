<?php

namespace App\Repositorios;

use App\Nucleo\Conexion;
use App\Modelos\Transferencia;
use PDO;

class TransferenciaRepositorio
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Conexion::obtener();
    }

    public function crear(int $origenId, int $destinoId, float $valor): void
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO transferencias (cuenta_origen_id, cuenta_destino_id, valor)
             VALUES (?, ?, ?)'
        );
        $stmt->execute([$origenId, $destinoId, $valor]);
    }

    public function todosEnviadosPorCuenta(int $cuentaId): array
    {
        $stmt = $this->pdo->prepare(
            'SELECT t.id, t.cuenta_origen_id, t.cuenta_destino_id,
                    origen.numero_cuenta AS cuenta_origen,
                    destino.numero_cuenta AS cuenta_destino,
                    t.valor, t.fecha
             FROM transferencias t
             INNER JOIN cuentas origen ON origen.id = t.cuenta_origen_id
             INNER JOIN cuentas destino ON destino.id = t.cuenta_destino_id
             WHERE t.cuenta_origen_id = ?
             ORDER BY fecha DESC, id DESC'
        );
        $stmt->execute([$cuentaId]);

        return array_map(
            fn(array $fila) => Transferencia::desdeFila($fila),
            $stmt->fetchAll()
        );
    }

    public function resumenEnviadasPorCuenta(int $cuentaId): array
    {
        $stmt = $this->pdo->prepare(
            'SELECT COUNT(*) AS cantidad, COALESCE(SUM(valor), 0) AS total
             FROM transferencias WHERE cuenta_origen_id = ?'
        );
        $stmt->execute([$cuentaId]);
        $fila = $stmt->fetch();

        return [
            'cantidad' => (int) $fila['cantidad'],
            'total' => (float) $fila['total'],
        ];
    }
}
