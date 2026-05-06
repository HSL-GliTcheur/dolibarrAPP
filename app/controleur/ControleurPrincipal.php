<?php
require_once __DIR__ . "/../modele/DolibarrAPI.php";

class ControleurPrincipal
{
    private DolibarrAPI $api;

    public function __construct()
    {
        $this->api = new DolibarrAPI();
    }

    public function index($id = null)
    {
        // 1. Récupération des données pour les widgets
        $comptes = $this->api->getBankAccounts();
        $factures = $this->api->getInvoicesAll(); // On ajoute cette ligne pour définir $factures

        // 2. Affichage de la vue avec toutes les variables définies
        require_once __DIR__ . "/../vue/base/entete.php";
        include __DIR__ . "/../vue/home.php";
        require_once __DIR__ . "/../vue/base/pied.php";
    }
}