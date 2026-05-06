<?php

require_once __DIR__ . "/../modele/DolibarrAPI.php";

class ControleurBanque
{
    private DolibarrAPI $api;

    public function __construct()
    {
        $this->api = new DolibarrAPI();
    }

    // URL: /banque/index ou /banque/
    public function index()
    {
        $title = "Mes Comptes";
        // On demande explicitement plus de résultats à l'API
        $comptes = $this->api->getBankAccounts();

        // LIGNE DE TEST : Affiche tout le contenu brut reçu de l'API
        // echo "<pre>"; var_dump($comptes); echo "</pre>"; die();

        require_once __DIR__ . "/../vue/base/entete.php";
        require_once __DIR__ . "/../vue/Banque.php";
        require_once __DIR__ . "/../vue/base/pied.php";
    }

    // URL: /banque/ajouter
    public function ajouter()
    {
        $title = "Ajouter un compte";
        require_once __DIR__ . "/../vue/base/entete.php";
        include __DIR__ . "/../vue/CreerBanque.php";
        require_once __DIR__ . "/../vue/base/pied.php";
    }

    // URL: /banque/store (Appelé par le formulaire de création)
    public function store($id = null)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // On prépare un tableau complet pour Dolibarr
            $label = $_POST['label'];
            // On crée une ref courte (max 12 caractères) et sans espaces
            $ref = strtoupper(substr(str_replace(' ', '', $label), 0, 8)) . rand(1000, 9999);

            $data = [
                'ref' => $ref,   // Ex: "MONCOMPTEBAN" au lieu de "Mon compte bancaire trop long"
                'label' => $label, // Le label peut rester long
                'bank' => $_POST['bank'],
                'type' => $_POST['type'],
                'clos' => "0",
                'status' => "1",
                'currency_code' => 'EUR',
                'country_id' => "1"
            ];

            $result = $this->api->createBankAccount($data);

            // Debug : si ça échoue encore, on veut voir le message exact de Dolibarr
            if ($result && !isset($result['error'])) {
                header("Location: /Dolibarrapp/banque/index");
                exit();
            } else {
                echo "<h3>Erreur lors de la création</h3>";
                echo "<pre>";
                print_r($result); // Cela affichera le détail de l'erreur (ex: champ manquant)
                echo "</pre>";
                echo "<a href='/Dolibarrapp/banque/ajouter'>Retour au formulaire</a>";
            }
        }
    }
    // URL: /banque/modifier/2 (Le $id est passé automatiquement par le routeur)
    public function modifier($id)
    {
        if ($id) {
            $compte = $this->api->getBankAccountsById($id);

            if ($compte && !isset($compte['error'])) {
                $title = "Modifier le compte";
                require_once __DIR__ . "/../vue/base/entete.php";
                include __DIR__ . "/../vue/ModifierBanque.php";
                require_once __DIR__ . "/../vue/base/pied.php";
            } else {
                die("Compte introuvable.");
            }
        }
    }

    // URL: /banque/update (Appelé par le formulaire de modif)
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $data = [
                'label' => $_POST['label'],
                'bank' => $_POST['bank']
            ];

            $result = $this->api->updateBankAccount($id, $data);

            if ($result && !isset($result['error'])) {
                header("Location: /Dolibarrapp/banque/index");
                exit();
            } else {
                die("Erreur lors de la modification.");
            }
        }
    }

    // URL: /banque/supprimer/2
    public function supprimer($id)
    {
        if ($id) {
            $result = $this->api->deleteBankAccount($id);
            // Redirection vers la nouvelle route
            header("Location: /Dolibarrapp/banque/index");
            exit();
        }
    }
}