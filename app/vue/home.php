<div class="container">
    <h1>Bienvenue sur DolibarrAPP</h1>

    <div style="margin-top: 20px; display: flex; gap: 20px; font-family: sans-serif;">

        <!-- CARTE BANQUE -->
        <div style="background: #f8f9fa; border: 2px solid #007bff; padding: 20px; border-radius: 10px; flex: 1;">
            <h2 style="margin-top: 0; color: #007bff;">Banque</h2>
            <?php if (!empty($comptes)): ?>
                <p style="font-size: 1.5em; margin: 10px 0;">
                    <strong><?php echo number_format($comptes[0]['balance'], 2, ',', ' '); ?> €</strong>
                </p>
                <span style="color: #666;"><?php echo $comptes[0]['label']; ?></span>
            <?php else: ?>
                <p>Aucun compte trouvé.</p>
            <?php endif; ?>
            <br><br>
            <a href="index.php?route=banque" style="text-decoration: none; color: #007bff; font-weight: bold;">→ Détails
                du compte</a>
        </div>

        <!-- CARTE FACTURES -->
        <div style="background: #f8f9fa; border: 2px solid #28a745; padding: 20px; border-radius: 10px; flex: 1;">
            <h2 style="margin-top: 0; color: #28a745;">Factures</h2>
            <p style="font-size: 1.5em; margin: 10px 0;">
                <strong><?php echo is_array($factures) ? count($factures) : 0; ?></strong>
            </p>
            <span style="color: #666;">Factures enregistrées</span>
            <br><br>
            <a href="index.php?route=facture" style="text-decoration: none; color: #28a745; font-weight: bold;">→ Gérer
                les factures</a>
        </div>

    </div>

    <div style="margin-top: 30px; padding: 15px; background: #fff3cd; border-left: 5px solid #ffc107;">
        <strong>Action rapide :</strong> Vous avez une nouvelle dépense ?
        <a href="index.php?route=depense">Cliquez ici pour l'ajouter.</a>
    </div>
</div>