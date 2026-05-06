<?php /** @var array $comptes Provient de ControleurBanque */ ?>

<div class="container mt-4">

    <!-- En-tête -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Mes Comptes Bancaires</h1>
        <a href="/Dolibarrapp/banque/ajouter" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Ajouter un compte
        </a>
    </div>

    <?php if (!empty($comptes) && is_array($comptes)): ?>
        <div class="row g-4">
            <?php foreach ($comptes as $compte): ?>
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body">

                            <!-- Banque -->
                            <h6 class="text-muted text-uppercase small mb-1">
                                <?php echo htmlspecialchars($compte['bank'] ?? 'Banque'); ?>
                            </h6>

                            <!-- Nom du compte -->
                            <h5 class="card-title mb-2">
                                <?php echo htmlspecialchars($compte['label']); ?>
                            </h5>

                            <!-- Solde -->
                            <p class="h4 text-success mb-3">
                                <?php echo number_format($compte['balance'], 2, ',', ' '); ?> €
                            </p>

                            <hr>

                            <!-- Actions -->
                            <div class="d-flex justify-content-between">
                                <a href="/Dolibarrapp/banque/modifier/<?php echo $compte['id']; ?>"
                                    class="btn btn-sm btn-outline-warning">
                                    <i class="bi bi-pencil-square me-1"></i> Modifier
                                </a>

                                <a href="/Dolibarrapp/banque/supprimer/<?php echo $compte['id']; ?>"
                                    class="btn btn-sm btn-outline-danger"
                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce compte (<?php echo addslashes($compte['label']); ?>) ?');">
                                    <i class="bi bi-trash me-1"></i> Supprimer
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    <?php else: ?>

        <!-- Aucun compte -->
        <div class="alert alert-info d-flex align-items-center">
            <i class="bi bi-info-circle me-2"></i>
            Aucun compte bancaire trouvé ou erreur de connexion à l'API Dolibarr.
        </div>

    <?php endif; ?>

</div>