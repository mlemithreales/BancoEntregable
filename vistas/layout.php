<?php
$mensaje = $_SESSION['mensaje'] ?? null;
unset($_SESSION['mensaje']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($titulo ?? 'Banco ADSO', ENT_QUOTES, 'UTF-8') ?></title>
</head>
<body>
<header class="encabezado">
    <div class="contenedor barra">
        <a class="marca" href="cuenta">Banco ADSO</a>
        <?php if (isset($_SESSION['cuenta_id'])): ?>
            <nav>
                <a href="cuenta">Cuenta</a>
                <a href="retiro">Retiro</a>
                <a href="retiros">Retiros</a>
                <a href="transferencia">Transferir</a>
                <a href="transferencias">Transferencias</a>
                <a href="logout">Salir</a>
            </nav>
        <?php endif; ?>
    </div>
</header>
<main class="contenedor">
    <?php if ($mensaje): ?><div class="mensaje exito"><?= htmlspecialchars($mensaje, ENT_QUOTES, 'UTF-8') ?></div><?php endif; ?>
    <?php /** @var string $contenidoVista Definida por Vista::renderizar(). */ ?>
    <?php require $contenidoVista; ?>
</main>
</body>
</html>
