<?php

namespace App\Repositorios;

use App\Nucleo\Conexion;
use App\Modelos\Retiro;
use PDO;

class RetiroRepositorio
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Conexion::obtener();
    }

    public function crear(int $cuentaId, float $valor): void
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO retiros (cuenta_id, valor) VALUES (?, ?)'
        );
        $stmt->execute([$cuentaId, $valor]);
    }

    public function todosPorCuenta(int $cuentaId): array
    {
        $stmt = $this->pdo->prepare(
            'SELECT id, cuenta_id, valor, fecha
             FROM retiros WHERE cuenta_id = ? ORDER BY fecha DESC, id DESC'
        );
        $stmt->execute([$cuentaId]);

        return array_map(
            fn(array $fila) => Retiro::desdeFila($fila),
            $stmt->fetchAll()
        );
    }

    public function resumenPorCuenta(int $cuentaId): array
    {
        $stmt = $this->pdo->prepare(
            'SELECT COUNT(*) AS cantidad, COALESCE(SUM(valor), 0) AS total
             FROM retiros WHERE cuenta_id = ?'
        );
        $stmt->execute([$cuentaId]);
        $fila = $stmt->fetch();

        return [
            'cantidad' => (int) $fila['cantidad'],
            'total' => (float) $fila['total'],
        ];
    }
}
