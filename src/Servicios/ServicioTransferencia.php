<?php

namespace App\Servicios;

use App\Nucleo\Conexion;
use App\Repositorios\CuentaRepositorio;
use App\Repositorios\TransferenciaRepositorio;
use App\Repositorios\UsuarioRepositorio;
use DomainException;

class ServicioTransferencia
{
    public function transferir(
        int $origenId,
        string $numeroDestino,
        string $clave,
        string $valorTexto
    ): void {
        $usuarios = new UsuarioRepositorio();
        $cuentas = new CuentaRepositorio();
        $transferencias = new TransferenciaRepositorio();

        $usuario = $usuarios->buscarPorCuentaId($origenId);
        if (!$usuario || !password_verify($clave, $usuario->claveHash)) {
            throw new DomainException('La contraseña es incorrecta.');
        }

        $destino = $cuentas->buscarPorNumero($numeroDestino);
        if (!$destino) {
            throw new DomainException('La cuenta destino no existe.');
        }

        if ($valorTexto === '' || !is_numeric($valorTexto)) {
            throw new DomainException('El valor a transferir debe ser numérico.');
        }

        $valor = (float) $valorTexto;
        if ($valor <= 0) {
            throw new DomainException('El valor a transferir debe ser mayor que 0.');
        }

        $origen = $cuentas->buscarPorId($origenId);
        if (!$origen || $origen->saldo < $valor) {
            throw new DomainException('Saldo insuficiente para realizar la transferencia.');
        }

        if ($destino->id === $origenId) {
            throw new DomainException('La cuenta destino debe ser diferente a la cuenta de origen.');
        }

        $pdo = Conexion::obtener();
        $pdo->beginTransaction();

        try {
            $cuentas->descontarSaldo($origenId, $valor);
            $cuentas->aumentarSaldo($destino->id, $valor);
            $transferencias->crear($origenId, $destino->id, $valor);
            $pdo->commit();
        } catch (\Throwable $e) {
            if ($pdo->inTransaction()) {
                $pdo->rollBack();
            }
            throw $e;
        }
    }
}
