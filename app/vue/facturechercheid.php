<div class="container mt-5">
    <div class="d-flex align-items-center gap-2">
        <h3><a href="/Dolibarrapp/facture"><i class="bi bi-arrow-left"></i></a></h3>
        <h1>Choisissez un id de facture pour la visualiser</h1>
    </div>

    <p>Appuyez sur <strong>Entrée</strong> après avoir saisi l'ID de la facture.</p>

    <input type="number" name="" id="numero" placeholder="ID de la facture" class="form-control w-25 mt-5">

    <script>
        document.getElementById('numero').addEventListener('keypress', function (event) {
            var id = this.value;
            if (id && event.key === 'Enter') {
                window.location.href = './voirid/' + id;
            }
        });
    </script>