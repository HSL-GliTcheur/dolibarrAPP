<?php

require_once __DIR__ . "/../modele/DolibarrAPI.php";

class ControleurDepense 
{
    private DolibarrAPI $api;

    public function __construct() 
    {
        $this->api = new DolibarrAPI();
    }

    public function index($id = null) 
    {
        $title = "Mes Dépenses";
        // On récupère les notes de frais depuis l'API
        $depenses = $this->api->getExpenseReports();

        require_once __DIR__ . "/../vue/base/entete.php";
        include __DIR__ . "/../vue/Depense.php";
        require_once __DIR__ . "/../vue/base/pied.php";
    }
}