<div class="container my-4">

    <h1 class="mb-4">Bienvenue sur DolibarrAPP</h1>

    <div class="row g-4">

        <!-- CARTE BANQUE -->
        <div class="col-md-6">
            <div class="card border-primary h-100">
                <div class="card-body">
                    <h5 class="card-title text-primary d-flex align-items-center gap-2">
                        <i class="bi bi-bank"></i> Banque
                    </h5>

                    <?php if (!empty($comptes)): ?>
                        <p class="display-6 fw-bold mb-1">
                            <?php echo number_format($comptes[0]['balance'], 2, ',', ' '); ?> €
                        </p>
                        <p class="text-muted mb-3"><?php echo $comptes[0]['label']; ?></p>
                    <?php else: ?>
                        <p class="text-muted">Aucun compte trouvé.</p>
                    <?php endif; ?>

                    <a href="/Dolibarrapp/banque/index" class="btn btn-outline-primary">
                        <i class="bi bi-arrow-right-circle"></i> Détails du compte
                    </a>
                </div>
            </div>
        </div>

        <!-- CARTE FACTURES -->
        <div class="col-md-6">
            <div class="card border-success h-100">
                <div class="card-body">
                    <h5 class="card-title text-success d-flex align-items-center gap-2">
                        <i class="bi bi-receipt"></i> Factures
                    </h5>

                    <p class="display-6 fw-bold mb-1">
                        <?php echo is_array($factures) ? count($factures) : 0; ?>
                    </p>
                    <p class="text-muted mb-3">Factures enregistrées</p>

                    <a href="/Dolibarrapp/facture" class="btn btn-outline-success">
                        <i class="bi bi-arrow-right-circle"></i> Gérer les factures
                    </a>
                </div>
            </div>
        </div>

    </div>

    <!-- ACTION RAPIDE -->
    <div class="alert alert-warning mt-4">
        <strong><i class="bi bi-lightning-charge"></i> Action rapide :</strong>
        Vous avez une nouvelle dépense ?
        <a href="/Dolibarrapp/depense/index" class="alert-link">Cliquez ici pour l'ajouter.</a>
    </div>

</div>