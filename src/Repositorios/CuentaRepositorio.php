<?php

namespace App\Repositorios;

use App\Nucleo\Conexion;
use App\Modelos\Cuenta;
use PDO;

class CuentaRepositorio
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Conexion::obtener();
    }

    public function buscarPorNumero(string $numero): ?Cuenta
    {
        $stmt = $this->pdo->prepare(
            'SELECT c.id, c.numero_cuenta, c.saldo, c.cliente_id, cl.nombre AS cliente_nombre
             FROM cuentas c
             INNER JOIN clientes cl ON cl.id = c.cliente_id
             WHERE c.numero_cuenta = ?'
        );
        $stmt->execute([$numero]);
        $fila = $stmt->fetch();

        return $fila ? Cuenta::desdeFila($fila) : null;
    }

    public function buscarPorId(int $id): ?Cuenta
    {
        $stmt = $this->pdo->prepare(
            'SELECT c.id, c.numero_cuenta, c.saldo, c.cliente_id, cl.nombre AS cliente_nombre
             FROM cuentas c
             INNER JOIN clientes cl ON cl.id = c.cliente_id
             WHERE c.id = ?'
        );
        $stmt->execute([$id]);
        $fila = $stmt->fetch();

        return $fila ? Cuenta::desdeFila($fila) : null;
    }

    public function actualizarSaldo(int $cuentaId, float $saldo): void
    {
        $stmt = $this->pdo->prepare('UPDATE cuentas SET saldo = ? WHERE id = ?');
        $stmt->execute([$saldo, $cuentaId]);
    }

    public function descontarSaldo(int $cuentaId, float $valor): void
    {
        $stmt = $this->pdo->prepare('UPDATE cuentas SET saldo = saldo - ? WHERE id = ?');
        $stmt->execute([$valor, $cuentaId]);
    }

    public function aumentarSaldo(int $cuentaId, float $valor): void
    {
        $stmt = $this->pdo->prepare('UPDATE cuentas SET saldo = saldo + ? WHERE id = ?');
        $stmt->execute([$valor, $cuentaId]);
    }
}
