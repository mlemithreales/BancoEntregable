<?php

namespace App\Nucleo;

class ControladorBase
{
    protected function vista(string $vista, array $datos = []): void
    {
        Vista::renderizar($vista, $datos);
    }

    protected function redirigir(string $ruta): never //indica nunca va a terminar de ejecutarse de forma normal, ya que el exit corta el programa
    {
        // Obtiene la ruta base del script y construye la URL completa para redirigir
        $base = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/')), '/');
        header('Location: ' . $base . '/' . ltrim($ruta, '/'));
        exit;
    }

    protected function requiereSesion(): int
    {
        if (!isset($_SESSION['cuenta_id'])) {
            $this->redirigir('/');
        }

        return (int) $_SESSION['cuenta_id'];
    }
}
