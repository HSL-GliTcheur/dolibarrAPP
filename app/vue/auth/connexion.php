<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card shadow border-0">
                <div class="card-header bg-dark-subtle text-black text-center py-3">
                    <h4 class="mb-0">Connexion Dolibarr</h4>
                </div>
                <div class="card-body p-4">
                    <?php if (isset($erreur)): ?>
                        <div class="alert alert-danger"><?= htmlspecialchars($erreur) ?></div>
                    <?php endif; ?>

                    <form action="/Dolibarrapp/auth/tenterConnexion" method="POST">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Identifiant</label>
                            <input type="text" name="email" class="form-control" placeholder="exemple : admin" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-bold">Mot de passe</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 fw-bold shadow-sm">
                            Connexion
                        </button>

                        <hr class="my-4">

                        <div class="text-center mt-3">
                            <p class="small mb-0">
                                Pas encore de compte ? Seul un administrateur Dolibarr peut créer un compte pour vous.
                            </p>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-muted text-center small py-3">
                    Les identifiants correspondent à ceux de l'application Dolibarr.
                </div>
            </div>
        </div>
    </div>
</div>