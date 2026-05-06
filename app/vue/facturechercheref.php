<div class="container mt-5">
    <div class="d-flex align-items-center gap-2">
        <h3><a href="../facture"><i class="bi bi-arrow-left"></i></a></h3>
        <h1>Entrez la référence d'une facture pour la visualiser</h1>
    </div>

    <p>Appuyez sur <strong>Entrée</strong> après avoir saisi la référence de la facture.</p>

    <input type="text" name="" id="reference" placeholder="Référence de la facture" class="form-control w-25 mt-5">

    <script>
        document.getElementById('reference').addEventListener('keypress', function (event) {
            var ref = this.value;
            if (ref && event.key === 'Enter') {
                window.location.href = './voirref/' + ref;
            }
        });
    </script>