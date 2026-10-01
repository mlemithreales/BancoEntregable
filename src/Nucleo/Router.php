<?php

namespace App\Nucleo;

class Router
{
    private array $rutas = [];

    public function get(string $ruta, callable $accion): void
    {
        $this->rutas['GET'][$ruta] = $accion;
    }

    public function post(string $ruta, callable $accion): void
    {
        $this->rutas['POST'][$ruta] = $accion;
    }

    public function ejecutar(string $metodo, string $ruta): void
    {
        $accion = $this->rutas[$metodo][$ruta] ?? null;

        if ($accion === null) {
            http_response_code(404);
            echo 'Página no encontrada';
            return;
        }

        $accion();
    }
}
