<?php

namespace App\Nucleo;

class Vista
{
    public static function renderizar(string $vista, array $datos = []): void
    {
        extract($datos);
        $contenidoVista = __DIR__ . '/../../vistas/' . $vista . '.php';

        require __DIR__ . '/../../vistas/layout.php';
    }
}
