<section class="tarjeta">
    <h1>Realizar transferencia</h1>
    <?php if (!empty($error)): ?><div class="mensaje error"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></div><?php endif; ?>
    <form method="post" action="transferencia">
        <label>Número de cuenta destino
            <input type="text" name="numero_destino" value="<?= htmlspecialchars($numeroDestino ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
        </label>
        <label>Valor a transferir
            <input type="number" name="valor" min="0.01" step="0.01" value="<?= htmlspecialchars($valor ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
        </label>
        <label>Contraseña
            <input type="password" name="clave" required>
        </label>
        <button type="submit">Transferir</button>
    </form>
</section>
