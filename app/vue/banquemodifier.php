<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-secondary text-light fw-bold">
            <h3 class="mb-0">Modifier le compte : <?= htmlspecialchars($unCompte['label']); ?></h3>
        </div>
        <div class="card-body">
            <form action="/Dolibarrapp/banque/update" method="POST">
                <input type="hidden" name="id" value="<?= $unCompte['id']; ?>">

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="label" class="form-label">Nom du compte</label>
                        <input type="text" name="label" id="label" class="form-control"
                            value="<?= htmlspecialchars($unCompte['label']); ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="bank" class="form-label">Nom de la banque</label>
                        <input type="text" name="bank" id="bank" class="form-control"
                            value="<?= htmlspecialchars($unCompte['bank'] ?? ''); ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="type_compte" class="form-label">Type de compte</label>
                        <select name="type_compte" id="type_compte" class="form-select">
                            <option value="1" <?= $unCompte['type'] == 1 ? 'selected' : '' ?>>Compte Courant / Carte
                            </option>
                            <option value="2" <?= $unCompte['type'] == 2 ? 'selected' : '' ?>>Compte Épargne</option>
                            <option value="3" <?= $unCompte['type'] == 3 ? 'selected' : '' ?>>Caisse / Cash</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="devise" class="form-label">Devise</label>
                        <input type="text" name="devise" id="devise" class="form-control"
                            value="<?= htmlspecialchars($unCompte['currency_code'] ?? 'EUR'); ?>">
                    </div>
                    <div class="col-md-12 mb-3">
                        <hr>
                        <h5>Coordonnées Bancaires</h5>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="numero_compte" class="form-label">Numéro de compte</label>
                        <input type="text" name="numero_compte" id="numero_compte" class="form-control"
                            value="<?= htmlspecialchars($unCompte['number'] ?? ''); ?>">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="iban" class="form-label">IBAN</label>
                        <input type="text" name="iban" id="iban" class="form-control"
                            value="<?= htmlspecialchars($unCompte['iban'] ?? ''); ?>">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="bic" class="form-label">BIC / SWIFT</label>
                        <input type="text" name="bic" id="bic" class="form-control"
                            value="<?= htmlspecialchars($unCompte['bic'] ?? ''); ?>">
                    </div>
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-success">Enregistrer les modifications</button>
                    <a href="/Dolibarrapp/banque/voirid/<?= $unCompte['id'] ?>" class="btn btn-secondary">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</div>