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

    public function ajouter()
    {
        $tiers = $this->api->getTiers();
        require_once __DIR__ . "/../vue/base/entete.php";
        include __DIR__ . "/../vue/facturecreer.php";
        require_once __DIR__ . "/../vue/base/pied.php";
    }


    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Dans Dolibarr, l'ID du tiers (socid) est obligatoire pour créer une facture.
            $data = [
                'socid' => $_POST['socid'],
                'type' => $_POST['type'] ?? 0, // 0 = Facture standard
                'date' => time() // Date actuelle (timestamp Unix)
            ];

            $result = $this->api->createInvoice($data);

            if ($result && !isset($result['error'])) {
                // Redirection vers la liste des factures en cas de succès
                header("Location: /Dolibarrapp/facture/liste");
                exit();
            } else {
                $errorMessage = "Erreur lors de la création de la facture.";

                if (isset($result['error'][0]) && strpos($result['error'][0], 'fk_facture_fk_soc') !== false) {
                    $errorMessage = "L'ID du Client (socid) sélectionné n'existe pas ou est invalide.";
                } elseif (isset($result['error']['message'])) {
                    $errorMessage = $result['error']['message'];
                }

                echo "<div class='container mt-5'>
                        <div class='alert alert-danger'>
                            <h4 class='alert-heading'>Impossible de créer la facture</h4>
                            <p>" . htmlspecialchars($errorMessage) . "</p>
                            <hr>
                            <p class='mb-0 small'>Détail technique : " . htmlspecialchars($result['error'][0] ?? '') . "</p>
                        </div>
                        <a href='/Dolibarrapp/facture/ajouter' class='btn btn-primary'>Retour au formulaire</a>
                      </div>";
            }
        }
    }


    public function supprimer($id)
    {
        if ($id) {
            $result = $this->api->deleteInvoice($id);
            // Redirection après suppression
            header("Location: /Dolibarrapp/facture/liste");
            exit();
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