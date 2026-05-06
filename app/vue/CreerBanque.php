<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Ajouter un nouveau compte bancaire</h3>
        </div>
        <div class="card-body">
            <form action="/Dolibarrapp/banque/store" method="POST">
                <div class="mb-3">
                    <label for="label" class="form-label">Nom du compte (ex: Compte Pro)</label>
                    <input type="text" name="label" id="label" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="bank" class="form-label">Nom de la banque</label>
                    <input type="text" name="bank" id="bank" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="type" class="form-label">Type de compte</label>
                    <select name="type" id="type" class="form-select">
                        <option value="1">Compte Courant / Carte</option>
                        <option value="2">Compte Épargne</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Créer le compte</button>
                <a href="index.php?route=banque" class="btn btn-secondary">Annuler</a>
            </form>
        </div>
    </div>
</div>