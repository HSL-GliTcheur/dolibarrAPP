<div class="container mt-4">
    <h3><a href="/Dolibarrapp/tiers"><i class="bi bi-arrow-left"></i></a></h3>
    <div class="card shadow">
        <div class="card-header bg-secondary text-white">
            <h3>Modifier le Tiers :
                <?= htmlspecialchars($unTiers['name']) ?>
            </h3>
        </div>
        <div class="card-body">
            <form action="/Dolibarrapp/tiers/update" method="POST">
                <input type="hidden" name="id" value="<?= $unTiers['id'] ?>">

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Nom du Tiers *</label>
                        <input type="text" name="nom" class="form-control"
                            value="<?= htmlspecialchars($unTiers['name']) ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Type *</label>
                        <select name="type_client" class="form-select" required>
                            <option value="1" <?= $unTiers['client'] == 1 ? 'selected' : '' ?>>Client</option>
                            <option value="2" <?= $unTiers['client'] == 2 ? 'selected' : '' ?>>Prospect</option>
                            <option value="3" <?= $unTiers['client'] == 3 ? 'selected' : '' ?>>Client & Prospect</option>
                            <option value="0" <?= $unTiers['client'] == 0 ? 'selected' : '' ?>>Autre</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Adresse</label>
                        <input type="text" name="adresse" class="form-control"
                            value="<?= htmlspecialchars($unTiers['address'] ?? '') ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Code Postal</label>
                        <input type="text" name="code_postal" class="form-control"
                            value="<?= htmlspecialchars($unTiers['zip'] ?? '') ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Téléphone</label>
                        <input type="text" name="telephone" class="form-control"
                            value="<?= htmlspecialchars($unTiers['phone'] ?? '') ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control"
                            value="<?= htmlspecialchars($unTiers['email'] ?? '') ?>">
                    </div>
                </div>
                <button type="submit" class="btn btn-warning text-dark fw-bold">Mettre à jour</button>
            </form>
        </div>
    </div>
</div>