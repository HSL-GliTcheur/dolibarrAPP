<div class="container mt-4">
    <h3><a href="/Dolibarrapp/tiers"><i class="bi bi-arrow-left"></i></a></h3>
    <div class="card shadow">
        <div class="card-header bg-secondary text-white">
            <h3>Ajouter un Tiers</h3>
        </div>
        <div class="card-body">
            <form action="/Dolibarrapp/tiers/store" method="POST">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Nom du Tiers *</label>
                        <input type="text" name="nom" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Type *</label>
                        <select name="type_client" class="form-select" required>
                            <option value="1">Client</option>
                            <option value="2">Prospect</option>
                            <option value="3">Client & Prospect</option>
                            <option value="0">Ni Client ni Prospect (Fournisseur)</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Adresse (Facultatif)</label>
                        <input type="text" name="adresse" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Code Postal (Facultatif)</label>
                        <input type="text" name="code_postal" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>ID Pays (Facultatif - ex: 1 pour France)</label>
                        <input type="number" name="pays" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>ID Département (Facultatif)</label>
                        <input type="number" name="departement" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Téléphone (Facultatif)</label>
                        <input type="text" name="telephone" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Email (Facultatif)</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Enregistrer</button>
            </form>
        </div>
    </div>
</div>