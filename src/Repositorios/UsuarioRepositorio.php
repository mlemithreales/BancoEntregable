<?php

namespace App\Repositorios;

use App\Nucleo\Conexion;
use App\Modelos\Usuario;
use PDO;

class UsuarioRepositorio
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Conexion::obtener();
    }

    public function buscarPorNumeroCuenta(string $numeroCuenta): ?Usuario
    {
        $stmt = $this->pdo->prepare(
            'SELECT u.id, u.cuenta_id, u.clave_hash, u.clave_hash AS claveHash
             FROM usuarios u
             INNER JOIN cuentas c ON c.id = u.cuenta_id
             WHERE c.numero_cuenta = ?'
        );
        $stmt->execute([$numeroCuenta]);
        $fila = $stmt->fetch();

        return $fila ? Usuario::desdeFila($fila) : null;
    }


    public function buscarPorCuentaId(int $cuentaId): ?Usuario
    {
        $stmt = $this->pdo->prepare(
            'SELECT id, cuenta_id, clave_hash FROM usuarios WHERE cuenta_id = ?'
        );
        $stmt->execute([$cuentaId]);
        $fila = $stmt->fetch();

        return $fila ? Usuario::desdeFila($fila) : null;
    }
}
