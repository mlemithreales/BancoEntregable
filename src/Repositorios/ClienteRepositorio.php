<?php

namespace App\Repositorios;

use App\Nucleo\Conexion;
use App\Modelos\Cliente;
use PDO;

class ClienteRepositorio
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Conexion::obtener();
    }

    public function todos(): array
    {
        $stmt = $this->pdo->prepare('SELECT id, nombre FROM clientes ORDER BY nombre');
        $stmt->execute();

        return array_map(
            fn(array $fila) => Cliente::desdeFila($fila),
            $stmt->fetchAll()
        );
    }

    public function buscar(int $id): ?Cliente
    {
        $stmt = $this->pdo->prepare('SELECT id, nombre FROM clientes WHERE id = ?');
        $stmt->execute([$id]);
        $fila = $stmt->fetch();

        return $fila ? Cliente::desdeFila($fila) : null;
    }
}
