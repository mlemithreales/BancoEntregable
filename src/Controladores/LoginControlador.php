<?php

namespace App\Controladores;

use App\Nucleo\ControladorBase;
use App\Servicios\ServicioLogin;

class LoginControlador extends ControladorBase
{
    public function mostrar(): void
    {
        if (isset($_SESSION['cuenta_id'])) {
            $this->redirigir('/cuenta');
        }

        $this->vista('login/formulario');
    }

    public function entrar(): void
    {
        $numero = trim($_POST['numero_cuenta'] ?? '');
        $clave = $_POST['clave'] ?? '';
        $servicio = new ServicioLogin();
        $cuentaId = $servicio->autenticar($numero, $clave);

        if ($cuentaId === null) {
            $this->vista('login/formulario', [
                'error' => 'Número de cuenta o contraseña incorrectos',
                'numeroCuenta' => $numero,
            ]);
            return;
        }

        session_regenerate_id(true);
        $_SESSION['cuenta_id'] = $cuentaId;
        $this->redirigir('/cuenta');
    }

    public function salir(): void
    {
        $_SESSION = [];
        if (ini_get('session.use_cookies')) {
            $parametros = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $parametros['path'],
                $parametros['domain'],
                $parametros['secure'],
                $parametros['httponly']
            );
        }
        session_destroy();
        $this->redirigir('/');
    }
}
