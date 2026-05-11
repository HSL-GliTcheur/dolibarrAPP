<div class="container mt-5">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div class="d-flex align-items-center gap-2">
            <h3><a href="/Dolibarrapp/tiers"><i class="bi bi-arrow-left"></i></a></h3>
            <h1 class="mb-0">Liste des Tiers</h1>
        </div>
        <a href="/Dolibarrapp/tiers/ajouter" class="btn btn-success">Nouveau Tiers</a>
    </div>

    <table class="table mt-5">
        <thead class="">
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Type</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($lesTiers) && !isset($lesTiers['error'])): ?>
                <?php foreach ($lesTiers as $t): ?>
                    <tr>
                        <td><?= $t['id'] ?></td>
                        <td><a href="/Dolibarrapp/tiers/voirid/<?= $t['id'] ?>"><?= htmlspecialchars($t['name']) ?></a></td>
                                <td>
                                    <?php
                                    if ($t['client'] == 1)
                                        echo "Client";
                                    elseif ($t['client'] == 2)
                                        echo "Prospect";
                                    elseif ($t['client'] == 3)
                                        echo "Client & Prospect";
                                    else
                                        echo "Autre";
                                    ?>
                                </td>
                                <td><?= htmlspecialchars($t['email'] ?? '-') ?></td>
                                <td><?= htmlspecialchars($t['phone'] ?? '-') ?></td>
                                <td>
                                    <a href=" /Dolibarrapp/tiers/supprimer/<?= $t['id'] ?>"
                                class="btn btn-sm btn-outline-danger"
                                onclick="return confirm('Voulez-vous supprimer ce tiers ?');"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center">Aucun tiers trouvé.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>