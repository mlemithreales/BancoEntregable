<?php

namespace App\Controladores;

use App\Nucleo\ControladorBase;
use App\Repositorios\RetiroRepositorio;
use App\Servicios\ServicioRetiro;
use DomainException;

class RetiroControlador extends ControladorBase
{
    public function formulario(): void
    {
        $this->requiereSesion();
        $this->vista('retiros/formulario');
    }

    public function guardar(): void
    {
        $cuentaId = $this->requiereSesion();
        $valor = $_POST['valor'] ?? '';
        $clave = $_POST['clave'] ?? '';

        try {
            (new ServicioRetiro())->retirar($cuentaId, $clave, $valor);
            $_SESSION['mensaje'] = 'Retiro realizado correctamente.';
            $this->redirigir('/retiro');
        } catch (DomainException $e) {
            $this->vista('retiros/formulario', ['error' => $e->getMessage(), 'valor' => $valor]);
        }
    }

    public function historial(): void
    {
        $cuentaId = $this->requiereSesion();
        $repo = new RetiroRepositorio();
        $retiros = $repo->todosPorCuenta($cuentaId);
        $resumen = $repo->resumenPorCuenta($cuentaId);

        $this->vista('retiros/historial', compact('retiros', 'resumen'));
    }
}
