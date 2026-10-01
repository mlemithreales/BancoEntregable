<?php

namespace App\Controladores;

use App\Nucleo\ControladorBase;
use App\Repositorios\TransferenciaRepositorio;
use App\Servicios\ServicioTransferencia;
use DomainException;

class TransferenciaControlador extends ControladorBase
{
    public function formulario(): void
    {
        $this->requiereSesion();
        $this->vista('transferencias/formulario');
    }

    public function guardar(): void
    {
        $cuentaId = $this->requiereSesion();
        $numeroDestino = trim($_POST['numero_destino'] ?? '');
        $valor = $_POST['valor'] ?? '';
        $clave = $_POST['clave'] ?? '';

        try {
            (new ServicioTransferencia())->transferir($cuentaId, $numeroDestino, $clave, $valor);
            $_SESSION['mensaje'] = 'Transferencia realizada correctamente.';
            $this->redirigir('/transferencia');
        } catch (DomainException $e) {
            $this->vista('transferencias/formulario', [
                'error' => $e->getMessage(),
                'numeroDestino' => $numeroDestino,
                'valor' => $valor,
            ]);
        }
    }

    public function historial(): void
    {
        $cuentaId = $this->requiereSesion();
        $repo = new TransferenciaRepositorio();
        $transferencias = $repo->todosEnviadosPorCuenta($cuentaId);
        $resumen = $repo->resumenEnviadasPorCuenta($cuentaId);

        $this->vista('transferencias/historial', compact('transferencias', 'resumen'));
    }
}
