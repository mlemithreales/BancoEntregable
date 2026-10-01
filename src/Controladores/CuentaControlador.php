<?php

namespace App\Controladores;

use App\Nucleo\ControladorBase;
use App\Repositorios\CuentaRepositorio;

class CuentaControlador extends ControladorBase
{
    public function panel(): void
    {
        $cuentaId = $this->requiereSesion();
        $cuenta = (new CuentaRepositorio())->buscarPorId($cuentaId);

        if (!$cuenta) {
            $this->redirigir('/logout');
        }

        $this->vista('cuenta/panel', ['cuenta' => $cuenta]);
    }
}
