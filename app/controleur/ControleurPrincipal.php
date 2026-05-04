<?php

class ControleurPrincipal
{

    public function index()
    {
        $title = "Accueil";
        require_once __DIR__ . "/../vue/base/entete.php";
        include __DIR__ . "/../vue/home.php";
        require_once __DIR__ . "/../vue/base/pied.php";
    }
}
