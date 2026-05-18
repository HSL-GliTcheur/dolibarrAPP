<div class="container mt-5">
    <div class="d-flex align-items-center gap-2">
        <h3><a href="/Dolibarrapp/banque"><i class="bi bi-arrow-left"></i></a></h3>
        <h1>Choisissez un ID de compte à visualiser</h1>
    </div>
    <p>Saisissez l'ID et appuyez sur <strong>Entrée</strong>.</p>
    <input type="number" id="rechercheId" placeholder="ID du Compte" class="form-control w-100 w-sm-50 w-md-25 mt-5">

    <script>
        document.getElementById('rechercheId').addEventListener('keypress', function (e) {
            if (e.key === 'Enter' && this.value) {
                window.location.href = './voirid/' + this.value;
            }
        });
    </script>
</div>