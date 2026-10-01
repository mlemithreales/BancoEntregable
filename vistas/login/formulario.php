<section class="tarjeta login">
    <h1>Banco ADSO</h1>
    <p>Inicia sesión con tu número de cuenta.</p>
    <?php if (!empty($error)): ?><div class="mensaje error"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></div><?php endif; ?>
    <form method="post" action="login">
        <label>Número de cuenta
            <input type="text" name="numero_cuenta" value="<?= htmlspecialchars($numeroCuenta ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
        </label>
        <label>Contraseña
            <input type="password" name="clave" required>
        </label>
        <button type="submit">Ingresar</button>
    </form>
   
</section>
