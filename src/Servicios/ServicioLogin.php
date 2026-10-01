<?php

namespace App\Servicios;

use App\Nucleo\Conexion;

class ServicioLogin
{
    public function autenticar(string $numeroCuenta, string $clave): ?int
    {
        $pdo = Conexion::obtener();
        
        // Buscamos directamente en la base de datos sin pasar por el Repositorio ni el Modelo
        $stmt = $pdo->prepare(
            'SELECT u.cuenta_id, u.clave_hash 
             FROM usuarios u
             INNER JOIN cuentas c ON c.id = u.cuenta_id
             WHERE c.numero_cuenta = ?'
        );
        $stmt->execute([$numeroCuenta]);
        $usuario = $stmt->fetch();

        // Verificamos si existe el registro y si la clave coincide
        if (!$usuario || !password_verify($clave, $usuario['clave_hash'])) {
            return null;
        }

        return (int)$usuario['cuenta_id'];
    }
}
