<div class="container mt-5">
    <div class="d-flex align-items-center gap-2">
        <h3><a href="/Dolibarrapp/tiers/voirnom"><i class="bi bi-arrow-left"></i></a></h3>
        <h1>Résultats de recherche</h1>
    </div>
    <table class="table mt-4">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($tiersTrouves)): ?>
                <?php foreach ($tiersTrouves as $t): ?>
                    <tr>
                        <td>
                            <?= $t['id'] ?>
                        </td>
                        <td>
                            <?= htmlspecialchars($t['name']) ?>
                        </td>
                        <td><a href="/Dolibarrapp/tiers/voirid/<?= $t['id'] ?>" class="btn btn-primary btn-sm">Voir</a></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">Aucun résultat.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>