<div class="container mt-5">
    <div class="d-flex align-items-center gap-2 justify-content-between">
        <div class="d-flex align-items-center gap-2">
            <h3><a href="/Dolibarrapp/banque/voirid"><i class="bi bi-arrow-left"></i></a></h3>
            <h1>Détails du Compte :
                <?= htmlspecialchars($unCompte['label']) ?>
            </h1>
        </div>
        <div class="d-flex gap-2">
            <a href="/Dolibarrapp/banque/modifier/<?= $unCompte['id'] ?>" class="btn btn-warning"><i
                    class="bi bi-pencil"></i> Modifier</a>
            <a href="/Dolibarrapp/banque/supprimer/<?= $unCompte['id'] ?>" class="btn btn-danger"
                onclick="return confirm('Voulez-vous supprimer ce compte ?');"><i class="bi bi-trash"></i> Supprimer</a>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-6">
            <ul class="list-group shadow-sm">
                <li class="list-group-item"><strong>ID interne :</strong>
                    <?= $unCompte['id'] ?>
                </li>
                <li class="list-group-item"><strong>Référence Dolibarr :</strong>
                    <?= htmlspecialchars($unCompte['ref']) ?>
                </li>
                <li class="list-group-item"><strong>Nom de la Banque :</strong>
                    <?= htmlspecialchars($unCompte['bank'] ?? '-') ?>
                </li>
                <li class="list-group-item"><strong>Solde comptable :</strong> <span class="text-success fw-bold">
                        <?= number_format($unCompte['balance'], 2, ',', ' ') ?> €
                    </span></li>
                <li class="list-group-item"><strong>Devise de tenue de compte :</strong>
                    <?= htmlspecialchars($unCompte['currency_code'] ?? 'EUR') ?>
                </li>
            </ul>
        </div>
        <div class="col-md-6 mt-md-0 mt-5">
            <ul class="list-group shadow-sm">
                <li class="list-group-item"><strong>Type de Compte :</strong>
                    <?php
                    if ($unCompte['type'] == 1)
                        echo "Compte Courant / Carte";
                    elseif ($unCompte['type'] == 2)
                        echo "Compte Épargne / Placement";
                    else
                        echo "Autre / Caisse";
                    ?>
                </li>
                <li class="list-group-item"><strong>Numéro de compte :</strong>
                    <?= htmlspecialchars($unCompte['number'] ?? '-') ?>
                </li>
                <li class="list-group-item"><strong>Code IBAN :</strong>
                    <?= htmlspecialchars($unCompte['iban'] ?? '-') ?>
                </li>
                <li class="list-group-item"><strong>Code BIC / SWIFT :</strong>
                    <?= htmlspecialchars($unCompte['bic'] ?? '-') ?>
                </li>
            </ul>
        </div>
    </div>
</div>