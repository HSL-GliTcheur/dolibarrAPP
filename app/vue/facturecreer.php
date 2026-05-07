<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-secondary text-white">
            <h3 class="mb-0">Créer une nouvelle facture (Brouillon)</h3>
        </div>
        <div class="card-body">
            <form action="/Dolibarrapp/facture/store" method="POST">

                <div class="mb-3">
                    <label for="socid" class="form-label">Client (Tiers)</label>

                    <?php if (!empty($tiers) && !isset($tiers['error'])): ?>
                        <select name="socid" id="socid" class="form-select" required>
                            <option value="">Menu déroulant</option>
                            <?php foreach ($tiers as $t): ?>

                                <option value="<?php echo htmlspecialchars($t['id']); ?>">
                                        <?php echo htmlspecialchars($t['name']); ?>
                                    (ID: <?php echo htmlspecialchars($t['id']); ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                       <?php else: ?>
                        <!-- Fallback si l'API ne renvoie pas de tiers (ex: erreur de connexion) -->
                        <div class="alert alert-warning">
                            Impossible de charger la liste des clients. Veuillez entrer l'ID manuellement.
                        </div>
                        <input type="number" name="socid" id="socid" class="form-control" placeholder="ID du client"
                            required>
                    <?php endif; ?>

                </div>

                <div class="mb-3">
                    <label for="type" class="form-label">Type de facture</label>
                    <select name="type" id="type" class="form-select">
                        <option value="0">Facture standard</option>
                        <option value="1">Facture de remplacement</option>
                        <option value="2">Facture d'avoir</option>
                        <option value="3">Facture d'acompte</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Créer la facture</button>
                <a href="/Dolibarrapp/facture" class="btn btn-secondary">Annuler</a>
            </form>
        </div>
    </div>
</div>