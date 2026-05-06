<?php /** @var array $compte */ ?>

<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Modifier le compte : <?php echo htmlspecialchars($compte['label']); ?></h3>
        </div>
        <div class="card-body">
            <form action="/Dolibarrapp/banque/update" method="POST">
                <!-- On cache l'ID pour savoir quel compte modifier -->
                <input type="hidden" name="id" value="<?php echo $compte['id']; ?>">

                <div class="mb-3">
                    <label for="label" class="form-label">Nom du compte</label>
                    <input type="text" name="label" id="label" class="form-control"
                        value="<?php echo htmlspecialchars($compte['label']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="bank" class="form-label">Nom de la banque</label>
                    <input type="text" name="bank" id="bank" class="form-control"
                        value="<?php echo htmlspecialchars($compte['bank']); ?>" required>
                </div>

                <button type="submit" class="btn btn-success">Enregistrer les modifications</button>
                <a href="/Dolibarrapp/banque" class="btn btn-secondary">Annuler</a>
            </form>
        </div>
    </div>
</div>