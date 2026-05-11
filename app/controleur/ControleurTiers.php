<?php

require_once __DIR__ . "/../modele/DolibarrAPI.php";

class ControleurTiers
{
    private DolibarrAPI $api;

    public function __construct()
    {
        $this->api = new DolibarrAPI();
    }

    // Page d'accueil Tiers
    public function index()
    {
        require_once __DIR__ . "/../vue/Base/entete.php";
        include __DIR__ . "/../vue/tiers.php";
        require_once __DIR__ . "/../vue/Base/pied.php";
    }

    // Liste complète
    public function liste()
    {
        $lesTiers = $this->api->getTiers();
        require_once __DIR__ . "/../vue/Base/entete.php";
        include __DIR__ . "/../vue/tiersliste.php";
        require_once __DIR__ . "/../vue/Base/pied.php";
    }

    // Voir par ID
    public function voirid($id = null)
    {
        if ($id) {
            $unTiers = $this->api->getTiersById(intval($id));
            require_once __DIR__ . "/../vue/Base/entete.php";
            if (!$unTiers || isset($unTiers['error'])) {
                echo '<div class="container mt-5"><h1>Tiers introuvable.</h1><a href="../voirid" class="btn btn-primary">Retour</a></div>';
            } else {
                include __DIR__ . "/../vue/tierslistebyid.php";
            }
            require_once __DIR__ . "/../vue/Base/pied.php";
        } else {
            require_once __DIR__ . "/../vue/Base/entete.php";
            include __DIR__ . "/../vue/tierschercheid.php";
            require_once __DIR__ . "/../vue/Base/pied.php";
        }
    }

    // Voir par Nom
    public function voirnom($nom = null)
    {
        if ($nom) {
            $nomDecode = urldecode($nom);
            $tousLesTiers = $this->api->getTiers();
            $tiersTrouves = [];

            // Filtrage manuel en PHP pour éviter les complexités de l'API Dolibarr sur les filtres SQL
            if (!empty($tousLesTiers) && !isset($tousLesTiers['error'])) {
                foreach ($tousLesTiers as $t) {
                    if (stripos($t['name'], $nomDecode) !== false) {
                        $tiersTrouves[] = $t;
                    }
                }
            }

            require_once __DIR__ . "/../vue/Base/entete.php";
            include __DIR__ . "/../vue/tierslistebynom.php";
            require_once __DIR__ . "/../vue/Base/pied.php";
        } else {
            require_once __DIR__ . "/../vue/Base/entete.php";
            include __DIR__ . "/../vue/tierscherchenom.php";
            require_once __DIR__ . "/../vue/Base/pied.php";
        }
    }

    // Formulaire d'ajout
    public function ajouter()
    {
        require_once __DIR__ . "/../vue/Base/entete.php";
        include __DIR__ . "/../vue/tierscreer.php";
        require_once __DIR__ . "/../vue/Base/pied.php";
    }

    // Sauvegarder un nouveau tiers
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Seules les clés du tableau sont en anglais car l'API l'exige
            $donnees = [
                'name' => $_POST['nom'],
                'client' => $_POST['type_client'], // 1=client, 2=prospect
                'address' => $_POST['adresse'] ?? '',
                'zip' => $_POST['code_postal'] ?? '',
                'country_id' => !empty($_POST['pays']) ? intval($_POST['pays']) : '',
                'state_id' => !empty($_POST['departement']) ? intval($_POST['departement']) : '',
                'phone' => $_POST['telephone'] ?? '',
                'email' => $_POST['email'] ?? ''
            ];

            $resultat = $this->api->createTiers($donnees);

            if ($resultat && !isset($resultat['error'])) {
                header("Location: /Dolibarrapp/tiers/liste");
                exit();
            } else {
                echo "<div class='container mt-5 alert alert-danger'>Erreur lors de la création du Tiers.</div>";
            }
        }
    }

    // Formulaire de modification
    public function modifier($id)
    {
        if ($id) {
            $unTiers = $this->api->getTiersById($id);
            if (!$unTiers || isset($unTiers['error']))
                die("Tiers introuvable.");

            require_once __DIR__ . "/../vue/Base/entete.php";
            include __DIR__ . "/../vue/tiersmodifier.php";
            require_once __DIR__ . "/../vue/Base/pied.php";
        }
    }

    // Mise à jour d'un tiers
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $donnees = [
                'name' => $_POST['nom'],
                'client' => $_POST['type_client'],
                'address' => $_POST['adresse'],
                'zip' => $_POST['code_postal'],
                'phone' => $_POST['telephone'],
                'email' => $_POST['email']
            ];

            $this->api->updateTiers($id, $donnees);
            header("Location: /Dolibarrapp/tiers/voirid/" . $id);
            exit();
        }
    }

    // Supprimer
    public function supprimer($id)
    {
        if ($id) {
            $this->api->deleteTiers($id);
            header("Location: /Dolibarrapp/tiers/liste");
            exit();
        }
    }
}