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
        $comptes = $this->api->getBankAccounts(); 
        
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
    public function store() 
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'ref'           => $_POST['label'], 
                'label'         => $_POST['label'],
                'bank'          => $_POST['bank'],
                'type'          => $_POST['type'],
                'courant'       => 1,
                'status'        => 1,
                'currency_code' => 'EUR',
                'country_id'    => 1,
                'country_code'  => 'FR'
            ];

            $result = $this->api->createBankAccount($data);

            if ($result && !isset($result['error'])) {
                header("Location: /Dolibarrapp/banque/index");
                exit();
            } else {
                die("Erreur Dolibarr : " . ($result['error']['message'] ?? 'Erreur inconnue'));
            }
        }
    }

    // URL: /banque/modifier/2 (Le $id est passé automatiquement par le routeur)
    public function modifier($id) 
    {
        if ($id) {
            $compte = $this->api->request("/bankaccounts/" . $id);
            
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
                'bank'  => $_POST['bank']
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
            header("Location: /Dolibarrapp/banque/index");
            exit();
        }
    }
}