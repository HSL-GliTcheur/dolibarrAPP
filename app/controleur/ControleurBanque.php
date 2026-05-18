<?php

require_once __DIR__ . "/../modele/DolibarrAPI.php";

class ControleurBanque
{
    private DolibarrAPI $api;

    public function __construct()
    {
        $this->api = new DolibarrAPI();
    }

    // Page d'accueil Banque (Dashboard d'actions)
    // URL: /banque/index ou /banque
    public function index()
    {
        require_once __DIR__ . "/../vue/Base/entete.php";
        include __DIR__ . "/../vue/banque.php";
        require_once __DIR__ . "/../vue/Base/pied.php";
    }

    // Liste complète de tous les comptes bancaires
    public function liste()
    {
        $lesComptes = $this->api->getBankAccounts();
        require_once __DIR__ . "/../vue/Base/entete.php";
        include __DIR__ . "/../vue/banqueliste.php";
        require_once __DIR__ . "/../vue/Base/pied.php";
    }

    // Visualiser un compte par son ID (ou afficher le formulaire de recherche)
    public function voirid($id = null)
    {
        if ($id) {
            $unCompte = $this->api->getBankAccountsById(intval($id));
            require_once __DIR__ . "/../vue/Base/entete.php";
            if (!$unCompte || isset($unCompte['error'])) {
                echo '<div class="container mt-5"><h1>Compte bancaire introuvable.</h1><a href="/Dolibarrapp/banque/voirid" class="btn btn-primary">Retour</a></div>';
            } else {
                include __DIR__ . "/../vue/banquelistebyid.php";
            }
            require_once __DIR__ . "/../vue/Base/pied.php";
        } else {
            require_once __DIR__ . "/../vue/Base/entete.php";
            include __DIR__ . "/../vue/banquechercheid.php";
            require_once __DIR__ . "/../vue/Base/pied.php";
        }
    }

    // Rechercher et lister des comptes par nom/libellé
    public function voirnom($nom = null)
    {
        if ($nom) {
            $nomDecode = urldecode($nom);
            $tousLesComptes = $this->api->getBankAccounts();
            $comptesTrouves = [];

            if (!empty($tousLesComptes) && !isset($tousLesComptes['error'])) {
                foreach ($tousLesComptes as $compte) {
                    if (stripos($compte['label'], $nomDecode) !== false || stripos($compte['bank'], $nomDecode) !== false) {
                        $comptesTrouves[] = $compte;
                    }
                }
            }

            require_once __DIR__ . "/../vue/Base/entete.php";
            include __DIR__ . "/../vue/banquelistebynom.php";
            require_once __DIR__ . "/../vue/Base/pied.php";
        } else {
            require_once __DIR__ . "/../vue/Base/entete.php";
            include __DIR__ . "/../vue/banquecherchenom.php";
            require_once __DIR__ . "/../vue/Base/pied.php";
        }
    }

    // Formulaire d'ajout d'un compte bancaire
    public function ajouter()
    {
        require_once __DIR__ . "/../vue/Base/entete.php";
        include __DIR__ . "/../vue/banquecreer.php";
        require_once __DIR__ . "/../vue/Base/pied.php";
    }

    // Enregistrer un nouveau compte bancaire via l'API
    public function store($id = null)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $libelle = $_POST['label'];
            $reference = strtoupper(substr(str_replace(' ', '', $libelle), 0, 8)) . rand(1000, 9999);

            // Tableau complet envoyé à Dolibarr avec les nouveaux champs exhaustifs
            $donnees = [
                'ref' => $reference,
                'label' => $libelle,
                'bank' => $_POST['bank'],
                'type' => $_POST['type_compte'],
                'number' => $_POST['numero_compte'] ?? '',
                'iban' => $_POST['iban'] ?? '',
                'bic' => $_POST['bic'] ?? '',
                'currency_code' => $_POST['devise'] ?? 'EUR',
                'clos' => "0",
                'status' => "1",
                'country_id' => "1"
            ];

            $resultat = $this->api->createBankAccount($donnees);

            if ($resultat && !isset($resultat['error'])) {
                header("Location: /Dolibarrapp/banque/liste");
                exit();
            } else {
                require_once __DIR__ . "/../vue/Base/entete.php";
                echo "<div class='container mt-5 alert alert-danger'><h3>Erreur lors de la création</h3><pre>" . print_r($resultat, true) . "</pre><a href='/Dolibarrapp/banque/ajouter'>Retour</a></div>";
                require_once __DIR__ . "/../vue/Base/pied.php";
            }
        }
    }

    // Formulaire de modification d'un compte bancaire
    public function modifier($id)
    {
        if ($id) {
            $unCompte = $this->api->getBankAccountsById($id);

            if ($unCompte && !isset($unCompte['error'])) {
                require_once __DIR__ . "/../vue/Base/entete.php";
                include __DIR__ . "/../vue/banquemodifier.php";
                require_once __DIR__ . "/../vue/Base/pied.php";
            } else {
                die("Compte introuvable.");
            }
        }
    }

    // Mettre à jour le compte bancaire
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $donnees = [
                'label' => $_POST['label'],
                'bank' => $_POST['bank'],
                'type' => $_POST['type_compte'],
                'number' => $_POST['numero_compte'] ?? '',
                'iban' => $_POST['iban'] ?? '',
                'bic' => $_POST['bic'] ?? '',
                'currency_code' => $_POST['devise'] ?? 'EUR'
            ];

            $resultat = $this->api->updateBankAccount($id, $donnees);

            if ($resultat && !isset($resultat['error'])) {
                header("Location: /Dolibarrapp/banque/voirid/" . $id);
                exit();
            } else {
                die("Erreur lors de la modification.");
            }
        }
    }

    // Supprimer un compte bancaire
    public function supprimer($id)
    {
        if ($id) {
            $this->api->deleteBankAccount($id);
            header("Location: /Dolibarrapp/banque/liste");
            exit();
        }
    }
}