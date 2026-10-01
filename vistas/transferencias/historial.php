<section>
    <h1>Historial de transferencias enviadas</h1>
    <div class="resumen">
        <div class="tarjeta"><strong><?= $resumen['cantidad'] ?></strong><span>Transferencias</span></div>
        <div class="tarjeta"><strong>$<?= number_format($resumen['total'], 2, ',', '.') ?></strong><span>Total transferido</span></div>
    </div>
    <div class="tarjeta tabla-wrap">
        <table>
            <thead><tr><th>Fecha</th><th>Destino</th><th>Valor</th></tr></thead>
            <tbody>
            <?php foreach ($transferencias as $transferencia): ?>
                <tr>
                    <td><?= htmlspecialchars($transferencia->fecha, ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars((string) $transferencia->cuentaDestinoId, ENT_QUOTES, 'UTF-8') ?></td>
                    <td>$<?= number_format($transferencia->valor, 2, ',', '.') ?></td>
                </tr>
            <?php endforeach; ?>
            <?php if (!$transferencias): ?><tr><td colspan="3">No hay transferencias registradas.</td></tr><?php endif; ?>
            </tbody>
        </table>
    </div>
</section>
