<div class="container mt-5">
    <div class="d-flex align-items-center gap-2 justify-content-between">
        <div class="d-flex align-items-center gap-2">
            <h3><a href="/Dolibarrapp/facture/voirid"><i class="bi bi-arrow-left"></i></a></h3>
            <h1>Détails de la facture : <?= htmlspecialchars($invoice['ref']) ?></h1>
        </div>
        <div class="d-flex gap-2">
            <a href="/Dolibarrapp/facture/modifier/<?= $invoice['id'] ?>" class="btn btn-warning text-dark fw-bold">
                <i class="bi bi-pencil-square"></i> Modifier la facture
            </a>
            <a onclick="return confirm('Voulez vous vraiment supprimer cette facture');"
                href="/Dolibarrapp/facture/supprimer/<?= $invoice['id'] ?>" class="btn btn-danger text-dark fw-bold">
                <i class="bi bi-trash"></i> Supprimer la facture
            </a>
        </div>
    </div>


    <div class="table-responsive mt-4">
        <table class="table mt-5">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Ref</th>
                    <th scope="col">HT</th>
                    <th scope="col">TTC</th>
                    <th scope="col">Condition de réglement</th>
                    <th scope="col">Mode de payement</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php //foreach ($invoices as $invoice): ?>
                <tr>
                    <td scope="row">
                        <?= $invoice['id'] ?>
                    </td>
                    <td>
                        <?= $invoice['ref'] ?>

                    </td>
                    <td>
                        <?= round($invoice['total_ht'], 4) ?>
                    </td>
                    <td>
                        <?= round($invoice['total_ttc'], 4) ?>
                    </td>
                    <td>
                        <?= $traductionReglement[$invoice['cond_reglement_doc']] ?? $invoice['cond_reglement_doc'] ?>
                    </td>
                    <td>
                        <?= $invoice['mode_reglement_code'] ?>
                    </td>
                    <td>
                        <?php
                        switch ($invoice['status']) {
                            case '0':
                                echo 'Brouillon';
                                break;
                            case '1':
                                echo 'En attente de payement';
                                break;
                            case '2':
                                echo 'Payée';
                                break;
                            default:
                                echo 'Inconnu';
                                break;
                        } ?>
                    </td>
                </tr>
                <?php //endforeach; ?>
            </tbody>
        </table>
    </div>
</div>