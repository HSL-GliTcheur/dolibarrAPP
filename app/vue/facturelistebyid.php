<div class="container mt-5">
    <div class="d-flex align-items-center gap-2">
        <h3><a href="../voirid"><i class="bi bi-arrow-left"></i></a></h3>
        <h1>Liste de la facture :
            <?= $invoice['ref'] ?>
        </h1>
    </div>


    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Ref</th>
                <th scope="col">HT</th>
                <th scope="col">TTC</th>
                <th scope="col">Condition de réglement</th>
                <th scope="col">Mode de payement</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
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
                <td>
                    <a href="/Dolibarr/facture/modifier/<?= $invoice['id'] ?>" class="btn btn-success">Modifier</a>
                </td>
            </tr>
            <?php //endforeach; ?>
        </tbody>
    </table>
</div>