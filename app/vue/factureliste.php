<div class="container mt-5">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div class="d-flex align-items-center gap-2">
            <h3><a href="../facture"><i class="bi bi-arrow-left"></i></a></h3>
            <h1 class="mb-0">Liste des factures</h1>
        </div>
        <a href="/Dolibarrapp/facture/ajouter" class="btn btn-success">
            <i class="bi bi-plus-circle me-1"></i> Nouvelle Facture
        </a>
    </div>

    <table class="table mt-5">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Ref</th>
                <th scope="col">HT</th>
                <th scope="col">TTC</th>
                <th scope="col">Condition de réglement</th>
                <th scope="col">Status</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($invoices) && !isset($invoices['error'])): ?>
                <?php foreach ($invoices as $invoice): ?>
                    <tr>
                        <td scope="row">
                            <?= $invoice['id'] ?>
                        </td>
                        <td>
                            <a href="./voirid/<?= $invoice['id'] ?>"><?= $invoice['ref'] ?></a>
                        </td>
                        <td>
                            <?= round($invoice['total_ht'], 2) ?> €
                        </td>
                        <td>
                            <?= round($invoice['total_ttc'], 2) ?> €
                        </td>
                        <td>
                            <?= $traductionReglement[$invoice['cond_reglement_doc']] ?? $invoice['cond_reglement_doc'] ?>
                        </td>
                        <td>
                            <?php
                            switch ($invoice['status']) {
                                case '0':
                                    echo '<span class="badge bg-secondary">Brouillon</span>';
                                    break;
                                case '1':
                                    echo '<span class="badge bg-warning text-dark">En attente</span>';
                                    break;
                                case '2':
                                    echo '<span class="badge bg-success">Payée</span>';
                                    break;
                                default:
                                    echo '<span class="badge bg-dark">Inconnu</span>';
                                    break;
                            } ?>
                        </td>
                        <td>
                            <!-- BOUTON DE SUPPRESSION -->
                            <a href="/Dolibarrapp/facture/supprimer/<?= $invoice['id'] ?>" 
                               class="btn btn-sm btn-outline-danger" 
                               onclick="return confirm('Attention: Voulez-vous vraiment supprimer la facture <?= $invoice['ref'] ?> ?');">
                               <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center text-muted">Aucune facture trouvée.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>