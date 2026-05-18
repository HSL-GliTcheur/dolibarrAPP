<div class="container mt-5">
    <div class="d-flex align-items-center gap-2">
        <h3><a href="/Dolibarrapp/banque"><i class="bi bi-arrow-left"></i></a></h3>
        <h1>Entrez le nom ou libellé d'un compte à rechercher</h1>
    </div>
    <p>Saisissez votre texte et appuyez sur <strong>Entrée</strong>.</p>
    <input type="text" id="rechercheNom" placeholder="Ex: Pro, Épargne..."
        class="form-control w-100 w-sm-50 w-md-25 mt-5">

    <script>
        document.getElementById('rechercheNom').addEventListener('keypress', function (e) {
            if (e.key === 'Enter' && this.value) {
                window.location.href = './voirnom/' + encodeURIComponent(this.value);
            }
        });
    </script>
</div>