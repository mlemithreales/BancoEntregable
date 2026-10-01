<?php

namespace App\Servicios;

use App\Nucleo\Conexion;
use App\Repositorios\CuentaRepositorio;
use App\Repositorios\RetiroRepositorio;
use App\Repositorios\UsuarioRepositorio;
use DomainException;

class ServicioRetiro
{
    public function retirar(int $cuentaId, string $clave, string $valorTexto): void
    {
        $usuarios = new UsuarioRepositorio();
        $cuentas = new CuentaRepositorio();
        $retiros = new RetiroRepositorio();

        $usuario = $usuarios->buscarPorCuentaId($cuentaId);
        if (!$usuario || !password_verify($clave, $usuario->claveHash)) {
            throw new DomainException('La contraseña es incorrecta.');
        }

        if ($valorTexto === '' || !is_numeric($valorTexto)) {
            throw new DomainException('El valor a retirar debe ser numérico.');
        }

        $valor = (float) $valorTexto;
        if ($valor <= 0) {
            throw new DomainException('El valor a retirar debe ser mayor que 0.');
        }

        $cuenta = $cuentas->buscarPorId($cuentaId);
        if (!$cuenta || $cuenta->saldo < $valor) {
            throw new DomainException('Saldo insuficiente para realizar el retiro.');
        }

        $pdo = Conexion::obtener();
        $pdo->beginTransaction();

        try {
            $cuentas->descontarSaldo($cuentaId, $valor);
            $retiros->crear($cuentaId, $valor);
            $pdo->commit();
        } catch (\Throwable $e) {
            if ($pdo->inTransaction()) {
                $pdo->rollBack();
            }
            throw $e;
        }
    }
}
