<?php
require_once __DIR__ . "/../modele/DolibarrAPI.php";

class ControleurDepense {
    private DolibarrAPI $api;

    public function __construct() {
        $this->api = new DolibarrAPI();
    }

    public function index($id = null) {
        // Logique pour récupérer les dépenses si nécessaire
        require_once __DIR__ . "/../vue/base/entete.php";
        include __DIR__ . "/../vue/Depense.php";
        require_once __DIR__ . "/../vue/base/pied.php";
    }
}