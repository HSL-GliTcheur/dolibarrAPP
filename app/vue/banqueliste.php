<div class="container mt-5">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div class="d-flex align-items-center gap-2">
            <h3><a href="/Dolibarrapp/banque"><i class="bi bi-arrow-left"></i></a></h3>
            <h1 class="mb-0">Liste des Comptes Bancaires</h1>
        </div>
        <a href="/Dolibarrapp/banque/ajouter" class="btn btn-success">Nouveau Compte</a>
    </div>

    <div class="table-responsive mt-4">
        <table class="table mt-5">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Référence</th>
                    <th>Nom du compte</th>
                    <th>Banque</th>
                    <th>Solde actuel</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($lesComptes) && !isset($lesComptes['error'])): ?>
                    <?php foreach ($lesComptes as $compte): ?>
                        <tr>
                            <td><?= $compte['id'] ?></td>
                            <td><strong><?= htmlspecialchars($compte['ref']) ?></strong></td>
                            <td><a
                                    href="/Dolibarrapp/banque/voirid/<?= $compte['id'] ?>"><?= htmlspecialchars($compte['label']) ?></a>
                            </td>
                            <td><?= htmlspecialchars($compte['bank'] ?? '-') ?></td>
                            <td class="text-success fw-bold"><?= number_format($compte['balance'], 2, ',', ' ') ?> €</td>
                            <td>
                                <a href="/Dolibarrapp/banque/modifier/<?= $compte['id'] ?>"
                                    class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil"></i></a>
                                <a href="/Dolibarrapp/banque/supprimer/<?= $compte['id'] ?>"
                                    class="btn btn-sm btn-outline-danger"
                                    onclick="return confirm('Supprimer ce compte bancaire ?');"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted">Aucun compte trouvé ou erreur API.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>