<?php

require_once __DIR__ . "/../modele/DolibarrAPI.php";

class ControleurFacture
{
    private DolibarrAPI $api;

    public function __construct()
    {
        $this->api = new DolibarrAPI();
    }

    public function index()
    {
        require_once __DIR__ . "/../vue/base/entete.php";
        include __DIR__ . "/../vue/facture.php";
        require_once __DIR__ . "/../vue/base/pied.php";
    }

    public function liste()
    {
        $invoices = $this->api->getInvoicesAll();

        $traductionReglement = [
            "Due upon receipt" => "À la réception",
            "Due on order" => "À la commande",
            "Due on delivery" => "À la livraison",
            "50% on order, 50% on delivery" => "50% à la commande, 50% à la livraison",
            "Due in 10 days" => "10 jours",
            "Due in 10 days, end of month" => "10 jours fin de mois",
            "Due in 14 days" => "14 jours",
            "Due in 14 days, end of month" => "14 jours fin de mois",
            "Due in 30 days" => "30 jours",
            "Due in 30 days, end of month" => "30 jours fin de mois",
            "Due in 45 days" => "45 jours",
            "Due in 45 days, end of month" => "45 jours fin de mois",
            "Due in 60 days" => "60 jours",
        ];

        require_once __DIR__ . "/../vue/base/entete.php";
        include __DIR__ . "/../vue/factureliste.php";
        require_once __DIR__ . "/../vue/base/pied.php";
    }

    public function voirid($id)
    {
        if ($id) {

            $id = intval($id);



            $invoice = $this->api->getInvoicesById($id);





            $traductionReglement = [
                "Due upon receipt" => "À la réception",
                "Due on order" => "À la commande",
                "Due on delivery" => "À la livraison",
                "50% on order, 50% on delivery" => "50% à la commande, 50% à la livraison",
                "Due in 10 days" => "10 jours",
                "Due in 10 days, end of month" => "10 jours fin de mois",
                "Due in 14 days" => "14 jours",
                "Due in 14 days, end of month" => "14 jours fin de mois",
                "Due in 30 days" => "30 jours",
                "Due in 30 days, end of month" => "30 jours fin de mois",
                "Due in 45 days" => "45 jours",
                "Due in 45 days, end of month" => "45 jours fin de mois",
                "Due in 60 days" => "60 jours",
            ];

            require_once __DIR__ . "/../vue/base/entete.php";
            if (!$invoice || isset($invoice['error'])) {
                echo '<div class="container mt-5">
    <h1>Facture introuvable veuillez rechercher une autre facture</h1>
    <a href="../voirid" class="btn btn-primary">Retour</a>
</div>';
            } else {
                include __DIR__ . "/../vue/facturelistebyid.php";
            }
            require_once __DIR__ . "/../vue/base/pied.php";
        } else {
            require_once __DIR__ . "/../vue/base/entete.php";
            include __DIR__ . "/../vue/facturechercheid.php";
            require_once __DIR__ . "/../vue/base/pied.php";
        }
    }

    public function voirref($ref)
    {
        if ($ref) {

            $ref = intval($ref);



            $invoice = $this->api->getInvoicesByRef($ref);





            $traductionReglement = [
                "Due upon receipt" => "À la réception",
                "Due on order" => "À la commande",
                "Due on delivery" => "À la livraison",
                "50% on order, 50% on delivery" => "50% à la commande, 50% à la livraison",
                "Due in 10 days" => "10 jours",
                "Due in 10 days, end of month" => "10 jours fin de mois",
                "Due in 14 days" => "14 jours",
                "Due in 14 days, end of month" => "14 jours fin de mois",
                "Due in 30 days" => "30 jours",
                "Due in 30 days, end of month" => "30 jours fin de mois",
                "Due in 45 days" => "45 jours",
                "Due in 45 days, end of month" => "45 jours fin de mois",
                "Due in 60 days" => "60 jours",
            ];

            require_once __DIR__ . "/../vue/base/entete.php";
            if (!$invoice || isset($invoice['error'])) {
                echo '<div class="container mt-5">
    <h1>Facture introuvable veuillez rechercher une autre facture</h1>
    <a href="../voirref" class="btn btn-primary">Retour</a>
</div>';
            } else {
                include __DIR__ . "/../vue/facturelistebyref.php";
            }
            require_once __DIR__ . "/../vue/base/pied.php";
        } else {
            require_once __DIR__ . "/../vue/base/entete.php";
            include __DIR__ . "/../vue/facturechercheref.php";
            require_once __DIR__ . "/../vue/base/pied.php";
        }
    }
}


// GET /invoices — Lister les factures

// POST /invoices — Créer une facture

// GET /invoices/{id} — Lire une facture

// PUT /invoices/{id} — Modifier une facture

// POST /invoices/{id}/validate — Valider une facture

// POST /invoices/{id}/lines — Ajouter une ligne

// PUT /invoices/{id}/lines/{lineid} — Modifier une ligne

// POST /invoices/{id}/payments — Ajouter un paiement