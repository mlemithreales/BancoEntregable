<section>
    <h1>Historial de retiros</h1>
    <div class="resumen">
        <div class="tarjeta"><strong><?= $resumen['cantidad'] ?></strong><span>Retiros</span></div>
        <div class="tarjeta"><strong>$<?= number_format($resumen['total'], 2, ',', '.') ?></strong><span>Total retirado</span></div>
    </div>
    <div class="tarjeta tabla-wrap">
        <table>
            <thead><tr><th>Fecha</th><th>Valor</th></tr></thead>
            <tbody>
            <?php foreach ($retiros as $retiro): ?>
                <tr><td><?= htmlspecialchars($retiro->fecha, ENT_QUOTES, 'UTF-8') ?></td><td>$<?= number_format($retiro->valor, 2, ',', '.') ?></td></tr>
            <?php endforeach; ?>
            <?php if (!$retiros): ?><tr><td colspan="2">No hay retiros registrados.</td></tr><?php endif; ?>
            </tbody>
        </table>
    </div>
</section>
