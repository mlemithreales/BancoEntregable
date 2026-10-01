<section>
    <div class="cabecera-pagina">
        <div>
            <h1>Mi cuenta</h1>
            <p>Bienvenido, <?= htmlspecialchars($cuenta->clienteNombre, ENT_QUOTES, 'UTF-8') ?>.</p>
        </div>
        <div class="saldo">$<?= number_format($cuenta->saldo, 2, ',', '.') ?></div>
    </div>
    <div class="grid">
        <article class="tarjeta"><h2>Cuenta</h2><p><?= htmlspecialchars($cuenta->numeroCuenta, ENT_QUOTES, 'UTF-8') ?></p></article>
        <article class="tarjeta"><h2>Cliente</h2><p><?= htmlspecialchars($cuenta->clienteNombre, ENT_QUOTES, 'UTF-8') ?></p></article>
        <article class="tarjeta"><h2>Saldo actual</h2><p>$<?= number_format($cuenta->saldo, 2, ',', '.') ?></p></article>
    </div>
    <div class="acciones">
        <a class="boton" href="retiro">Realizar retiro</a>
        <a class="boton" href="transferencia">Realizar transferencia</a>
        <a class="boton secundario" href="retiros">Ver retiros</a>
        <a class="boton secundario" href="transferencias">Ver transferencias</a>
    </div>
</section>
