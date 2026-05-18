<div class="container mt-4 mb-5">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div class="d-flex align-items-center gap-3">
            <a href="/Dolibarrapp/facture/voirid/<?= $invoice['id'] ?>" class="text-dark"><i
                    class="bi bi-arrow-left fs-3"></i></a>
            <h2 class="mb-0">Gestion de la facture : <?= htmlspecialchars($invoice['ref'] ?: 'Brouillon') ?></h2>
        </div>
        <div>
            <?php if ($invoice['status'] == 0): ?>
                <span class="badge bg-secondary fs-6">Statut : Brouillon</span>
            <?php elseif ($invoice['status'] == 1): ?>
                <span class="badge bg-warning text-dark fs-6">Statut : Impayée / En attente</span>
            <?php elseif ($invoice['status'] == 2): ?>
                <span class="badge bg-success fs-6">Statut : Payée</span>
            <?php endif; ?>
        </div>
    </div>



    <div class="row g-4">

        <!-- COLONNE GAUCHE : INFOS GENERALES ET ACTIONS SUR LE STATUT -->

        <div class="col-md-5">

            <!-- ------------------------ -->
            <!-- Formulaire Condition & Mode de règlement -->
            <!-- ------------------------ -->

            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Informations de règlement</h5>
                </div>
                <div class="card-body">
                    <form action="/Dolibarrapp/facture/updateGeneral/<?= $invoice['id'] ?>" method="POST">

                        <div class="mb-3">
                            <label class="form-label">Condition de règlement</label>
                            <select name="cond_reglement_id" class="form-select">
                                <option value="">-- Sélectionner --</option>
                                <?php if (isset($paymentConditions) && is_array($paymentConditions)): ?>
                                    <?php foreach ($paymentConditions as $cond): ?>
                                        <option value="<?= $cond['id'] ?>" <?= ($invoice['cond_reglement_id'] == $cond['id']) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($traductionCReglement[$cond['label']] ?? $cond['label']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Mode de règlement</label>
                            <select name="mode_reglement_id" class="form-select">
                                <option value="">-- Sélectionner --</option>
                                <?php if (isset($paymentTypes) && is_array($paymentTypes)): ?>
                                    <?php foreach ($paymentTypes as $type): ?>
                                        <option value="<?= $type['id'] ?>" <?= ($invoice['mode_reglement_id'] == $type['id']) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($traductionMReglement[$type['label']] ?? $type['label']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Mettre à jour les
                            infos</button>
                    </form>
                </div>
            </div>

            <!-- ------------------------ -->
            <!-- Actions sur le statut -->
            <!-- ------------------------ -->

            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">Actions sur le statut</h5>
                </div>
                <div class="card-body text-center">
                    <form action="/Dolibarrapp/facture/changerStatut/<?= $invoice['id'] ?>" method="POST">
                        <?php if ($invoice['status'] == 0): ?>
                            <!-- Si Brouillon, on peut valider -->
                            <input type="hidden" name="action_statut" value="valider">
                            <p class="text-muted small">Validez la facture pour obtenir une référence non provisoire et la
                                rendre immodifiable.</p>
                            <button type="submit" class="btn btn-success w-100 fw-bold"
                                onclick="return confirm('Êtes-vous sûr de vouloir valider cette facture ?');">
                                Valider la facture
                            </button>

                        <?php elseif ($invoice['status'] == 1): ?>
                            <!-- Si Impayée, on peut repasser en brouillon -->
                            <input type="hidden" name="action_statut" value="brouillon">
                            <p class="text-muted small">La facture est en attente. Vous pouvez la remettre en brouillon pour
                                la modifier (Lignes).</p>
                            <button type="submit" class="btn btn-warning w-100 fw-bold"
                                onclick="return confirm('Attention: Remettre en brouillon supprimera temporairement la référence officielle.');">
                                <i class="bi bi-arrow-counterclockwise"></i> Remettre en Brouillon
                            </button>

                        <?php else: ?>
                            <div class="alert alert-info mb-0">La facture est payée. Aucune action de statut possible.</div>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </div>

        <!-- ------------------------ -->
        <!-- COLONNE DROITE : LIGNES DE FACTURE -->
        <!-- ------------------------ -->

        <div class="col-md-7">

            <?php if ($invoice['status'] == 0): ?>
                <div class="card shadow-sm mb-4 border-success">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0"><i class="bi bi-plus-lg"></i> Ajouter un bien / service</h5>
                    </div>
                    <div class="card-body">
                        <form action="/Dolibarrapp/facture/ajouterLigne/<?= $invoice['id'] ?>" method="POST">
                            <div class="row g-2">
                                <div class="col-md-12">
                                    <label class="form-label small mb-1">Description / Nom</label>
                                    <textarea name="desc" class="form-control" rows="2" required></textarea>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label small mb-1">Type</label>
                                    <select name="product_type" class="form-select" required>
                                        <option value="0">Produit</option>
                                        <option value="1">Service</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label small mb-1">Prix U. (HT)</label>
                                    <div class="input-group">
                                        <input type="number" step="0.01" name="subprice" class="form-control" required>
                                        <span class="input-group-text">€</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label small mb-1">Quantité</label>
                                    <input type="number" step="1" min="1" name="qty" class="form-control" value="1"
                                        required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label small mb-1">TVA (%)</label>
                                    <input type="number" step="0.1" name="tva_tx" class="form-control" value="20" required>
                                </div>
                                <div class="col-12 mt-3 text-end">
                                    <button type="submit" class="btn btn-success">Ajouter la
                                        ligne</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            <?php else: ?>
                <div class="alert alert-secondary">
                    <i class="bi bi-info-circle"></i> Repassez la facture en <strong>Brouillon</strong> pour pouvoir ajouter
                    ou modifier des biens/services.
                </div>
            <?php endif; ?>

            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Détails de la facturation</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <div class="table-responsive mt-4">
                            <table class="table table-hover table-striped mb-0">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Type</th>
                                        <th>Description</th>
                                        <th class="text-center">Qté</th>
                                        <th class="text-end">PU HT</th>
                                        <th class="text-end">TVA</th>
                                        <th class="text-end">Total TTC</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (isset($invoice['lines']) && count($invoice['lines']) > 0): ?>
                                        <?php foreach ($invoice['lines'] as $ligne): ?>
                                            <tr>
                                                <td>
                                                    <?php if (isset($ligne['product_type']) && $ligne['product_type'] == 1): ?>
                                                        <span class="badge bg-secondary">Service</span>
                                                    <?php else: ?>
                                                        <span class="badge bg-info text-dark">Produit</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?= nl2br(htmlspecialchars($ligne['desc'] ?? 'Sans description')) ?>
                                                </td>
                                                <td class="text-center"><?= $ligne['qty'] ?></td>
                                                <td class="text-end"><?= number_format($ligne['subprice'], 2) ?> €</td>
                                                <td class="text-end"><?= number_format($ligne['tva_tx'], 1) ?> %</td>
                                                <td class="text-end fw-bold"><?= number_format($ligne['total_ttc'], 2) ?> €</td>
                                                <td class="text-center">
                                                    <?php if ($invoice['status'] == 0): ?>
                                                        <button type="button" class="btn btn-sm btn-outline-danger"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modalSupprimerLigne_<?= $ligne['id'] ?>">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>

                                            <?php if ($invoice['status'] == 0): ?>
                                                <div class="modal fade" id="modalSupprimerLigne_<?= $ligne['id'] ?>" tabindex="-1"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-danger text-white">
                                                                <h5 class="modal-title"><i class="bi bi-exclamation-triangle"></i>
                                                                    Confirmer la suppression</h5>
                                                                <button type="button" class="btn-close btn-close-white"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form action="/Dolibarrapp/facture/supprimerLigne/<?= $invoice['id'] ?>"
                                                                method="POST">
                                                                <div class="modal-body">
                                                                    <p>Êtes-vous sûr de vouloir supprimer définitivement cet élément
                                                                        de
                                                                        la facture ?</p>
                                                                    <p class="text-center fs-5">
                                                                        <strong><?= htmlspecialchars($ligne['desc']) ?></strong>
                                                                    </p>

                                                                    <input type="hidden" name="lineid" value="<?= $ligne['id'] ?>">
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Annuler</button>
                                                                    <button type="submit" class="btn btn-danger">Oui,
                                                                        supprimer</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="7" class="text-center text-muted py-4">Aucune ligne facturée pour
                                                le
                                                moment.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                                <?php if (isset($invoice['lines']) && count($invoice['lines']) > 0): ?>
                                    <tfoot class="table-light">
                                        <tr>
                                            <td colspan="5" class="text-end fw-bold">TOTAL HT :</td>
                                            <td class="text-end fw-bold" colspan="2">
                                                <?= number_format($invoice['total_ht'], 2) ?> €
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="5" class="text-end fw-bold">TOTAL TTC :</td>
                                            <td class="text-end fw-bold fs-5 text-primary" colspan="2">
                                                <?= number_format($invoice['total_ttc'], 2) ?> €
                                            </td>
                                        </tr>
                                    </tfoot>
                                <?php endif; ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>