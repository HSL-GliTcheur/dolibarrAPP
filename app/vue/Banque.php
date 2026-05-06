<?php /** @var array $comptes Provient de ControleurBanque */ ?>

<div class="container mt-4">
    <!-- En-tête avec bouton d'ajout -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Mes Comptes Bancaires</h1>
        <a href="/Dolibarrapp/banque/ajouter" class="btn btn-primary shadow-sm">
            <i class="bi bi-plus-circle"></i> + Ajouter un compte
        </a>
    </div>

    <?php if (!empty($comptes) && is_array($comptes)): ?>
        <div class="row">
            <?php foreach ($comptes as $compte): ?>
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <!-- Affichage du nom de la banque en petit -->
                            <h6 class="text-muted text-uppercase small mb-1">
                                <?php echo htmlspecialchars($compte['bank'] ?? 'Banque'); ?>
                            </h6>
                            
                            <!-- Nom du compte -->
                            <h5 class="card-title font-weight-bold">
                                <?php echo htmlspecialchars($compte['label']); ?>
                            </h5>
                            
                            <!-- Solde -->
                            <p class="card-text h4 text-success my-3">
                                <?php echo number_format($compte['balance'], 2, ',', ' '); ?> €
                            </p>

                            <hr>

                            <!-- Actions : Modifier et Supprimer -->
                            <div class="d-flex justify-content-between">
                                <a href="/Dolibarrapp/banque/modifier/<?php echo $compte['id']; ?>" 
                                   class="btn btn-sm btn-outline-warning">
                                    Modifier
                                </a>
                                
                                <a href="/Dolibarrapp/banque/supprimer/<?php echo $compte['id']; ?>" 
                                   class="btn btn-sm btn-outline-danger" 
                                   onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce compte (<?php echo addslashes($compte['label']); ?>) ?');">
                                    Supprimer
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <!-- Message si aucun compte n'est trouvé -->
        <div class="alert alert-info shadow-sm">
            <i class="bi bi-info-circle"></i> Aucun compte bancaire trouvé ou erreur de connexion à l'API Dolibarr.
        </div>
    <?php endif; ?>
</div>