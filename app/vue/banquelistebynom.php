<div class="container mt-5">
    <div class="d-flex align-items-center gap-2">
        <h3><a href="/Dolibarrapp/banque/voirnom"><i class="bi bi-arrow-left"></i></a></h3>
        <h1>Résultats de la recherche par nom</h1>
    </div>
    <div class="table-responsive mt-4">
        <table class="table mt-4">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nom du Compte</th>
                    <th>Banque</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($comptesTrouves)): ?>
                    <?php foreach ($comptesTrouves as $compte): ?>
                        <tr>
                            <td>
                                <?= $compte['id'] ?>
                            </td>
                            <td>
                                <?= htmlspecialchars($compte['label']) ?>
                            </td>
                            <td>
                                <?= htmlspecialchars($compte['bank'] ?? '-') ?>
                            </td>
                            <td><a href="/Dolibarrapp/banque/voirid/<?= $compte['id'] ?>"
                                    class="btn btn-primary btn-sm">Voir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center text-muted">Aucun compte ne correspond à votre recherche.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>