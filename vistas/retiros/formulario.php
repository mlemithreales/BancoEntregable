<section class="tarjeta">
    <h1>Realizar retiro</h1>
    <?php if (!empty($error)): ?><div class="mensaje error"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></div><?php endif; ?>
    <form method="post" action="retiro">
        <label>Valor a retirar
            <input type="number" name="valor" min="0.01" step="0.01" value="<?= htmlspecialchars($valor ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
        </label>
        <label>Contraseña
            <input type="password" name="clave" required>
        </label>
        <button type="submit">Retirar</button>
    </form>
</section>
