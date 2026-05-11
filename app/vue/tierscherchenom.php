<div class="container mt-5">
    <div class="d-flex align-items-center gap-2">
        <h3><a href="/Dolibarrapp/tiers"><i class="bi bi-arrow-left"></i></a></h3>
        <h1>Rechercher un Tiers par Nom</h1>
    </div>
    <input type="text" id="rechercheNom" placeholder="Ex: Dupont" class="form-control w-25 mt-5">
    <script>
        document.getElementById('rechercheNom').addEventListener('keypress', function (e) {
            if (e.key === 'Enter' && this.value) {
                window.location.href = './voirnom/' + encodeURIComponent(this.value);
            }
        });
    </script>
</div>