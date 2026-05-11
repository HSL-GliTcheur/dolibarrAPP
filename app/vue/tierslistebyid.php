<div class="container mt-5">
    <div class="d-flex align-items-center gap-2 justify-content-between">
        <div class="d-flex align-items-center gap-2">
            <h3><a href="/Dolibarrapp/tiers/voirid"><i class="bi bi-arrow-left"></i></a></h3>
            <h1>Détails du Tiers :
                <?= htmlspecialchars($unTiers['name']) ?>
            </h1>
        </div>
        <a href="/Dolibarrapp/tiers/modifier/<?= $unTiers['id'] ?>" class="btn btn-warning"><i class="bi bi-pencil"></i>
            Modifier</a>
    </div>

    <ul class="list-group mt-5 w-50">
        <li class="list-group-item"><strong>ID :</strong>
            <?= $unTiers['id'] ?>
        </li>
        <li class="list-group-item"><strong>Nom :</strong>
            <?= htmlspecialchars($unTiers['name']) ?>
        </li>
        <li class="list-group-item"><strong>Email :</strong>
            <?= htmlspecialchars($unTiers['email'] ?? '-') ?>
        </li>
        <li class="list-group-item"><strong>Téléphone :</strong>
            <?= htmlspecialchars($unTiers['phone'] ?? '-') ?>
        </li>
        <li class="list-group-item"><strong>Adresse :</strong>
            <?= htmlspecialchars($unTiers['address'] ?? '-') ?>
        </li>
        <li class="list-group-item"><strong>Code Postal :</strong>
            <?= htmlspecialchars($unTiers['zip'] ?? '-') ?>
        </li>
    </ul>
</div>