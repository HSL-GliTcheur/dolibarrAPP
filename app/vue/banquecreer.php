<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-secondary text-white">
            <h3 class="mb-0">Ajouter un nouveau compte bancaire complet</h3>
        </div>
        <div class="card-body">
            <form action="/Dolibarrapp/banque/store" method="POST">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="label" class="form-label">Nom du compte *</label>
                        <input type="text" name="label" id="label" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="bank" class="form-label">Nom de l'établissement bancaire *</label>
                        <input type="text" name="bank" id="bank" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="type_compte" class="form-label">Type de compte *</label>
                        <select name="type_compte" id="type_compte" class="form-select">
                            <option value="1">Compte Courant / Carte</option>
                            <option value="2">Compte Épargne</option>
                            <option value="3">Caisse / Cash</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="devise" class="form-label">Devise</label>
                        <input type="text" name="devise" id="devise" class="form-control" value="EUR">
                    </div>
                    <div class="col-md-12 mb-3">
                        <hr>
                        <h5>Coordonnées Bancaires (Facultatif)</h5>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="numero_compte" class="form-label">Numéro de compte</label>
                        <input type="text" name="numero_compte" id="numero_compte" class="form-control">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="iban" class="form-label">IBAN</label>
                        <input type="text" name="iban" id="iban" class="form-control" placeholder="FR76...">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="bic" class="form-label">BIC / SWIFT</label>
                        <input type="text" name="bic" id="bic" class="form-control">
                    </div>
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-success">Créer le compte</button>
                    <a href="/Dolibarrapp/banque" class="btn btn-secondary">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</div>