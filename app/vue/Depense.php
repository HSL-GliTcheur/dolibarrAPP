<div class="container mt-4">
    <h1><i class="bi bi-wallet2"></i> Mes Notes de Frais</h1>

    <?php if (!empty($depenses) && is_array($depenses) && !isset($depenses['error'])): ?>
        <table style="width:100%; border-collapse: collapse; margin-top: 20px;">
            <thead>
                <tr style="background-color: #f2f2f2; text-align: left;">
                    <th style="padding: 10px; border-bottom: 2px solid #ddd;">Référence</th>
                    <th style="padding: 10px; border-bottom: 2px solid #ddd;">Description</th>
                    <th style="padding: 10px; border-bottom: 2px solid #ddd;">Montant TTC</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($depenses as $d): ?>
                    <tr>
                        <td style="padding: 10px; border-bottom: 1px solid #ddd;">
                            <strong><?php echo htmlspecialchars($d['ref']); ?></strong>
                        </td>
                        <td style="padding: 10px; border-bottom: 1px solid #ddd;">
                            <?php echo htmlspecialchars($d['note_public'] ?? $d['description'] ?? 'Pas de description'); ?>
                        </td>
                        <td style="padding: 10px; border-bottom: 1px solid #ddd;">
                            <strong><?php echo number_format($d['total_ttc'], 2, ',', ' '); ?> €</strong>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div style="padding: 20px; background: #e9ecef; border-radius: 5px; margin-top: 20px;">
            <i class="bi bi-info-circle"></i> Aucune note de frais trouvée ou erreur de connexion à l'API.
        </div>
    <?php endif; ?>
</div>