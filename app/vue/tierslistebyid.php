<div class="container mt-5">
    <div class="d-flex align-items-center gap-2 justify-content-between">
        <div class="d-flex align-items-center gap-2">
            <h3><a href="/Dolibarrapp/tiers/voirid"><i class="bi bi-arrow-left"></i></a></h3>
            <h1>Détails du Tiers :
                <?= htmlspecialchars($unTiers['name']) ?>
            </h1>
        </div>
        <div class="d-flex gap-2">
            <a href="/Dolibarrapp/tiers/modifier/<?= $unTiers['id'] ?>" class="btn btn-warning"><i
                    class="bi bi-pencil"></i>
                Modifier</a>
            <a onclick="return confirm('Voulez-vous supprimer ce tiers ?') ;"
                href="/Dolibarrapp/tiers/supprimer/<?= $unTiers['id'] ?>" class="btn btn-danger"><i
                    class="bi bi-trash"></i>
                Supprimer</a>
        </div>
    </div>

    <ul class="list-group mt-5 w-100 w-md-75 w-lg-50">
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