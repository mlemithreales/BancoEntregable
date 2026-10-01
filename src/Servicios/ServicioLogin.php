<?php

namespace App\Servicios;

use App\Repositorios\UsuarioRepositorio;

class ServicioLogin
{
    public function autenticar(string $numeroCuenta, string $clave): ?int
    {
        $usuarios = new UsuarioRepositorio();
        $usuario = $usuarios->buscarPorNumeroCuenta($numeroCuenta);

        if (!$usuario || !password_verify($clave, $usuario->claveHash)) {
            return null;
        }

        return $usuario->cuentaId;
    }
}
