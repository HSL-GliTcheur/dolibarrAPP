<?php

require_once __DIR__ . "/../modele/DolibarrAPI.php";

class ControleurTiers
{
    private DolibarrAPI $api;

    public function __construct()
    {
        $this->api = new DolibarrAPI();
    }

    public function index()
    {

        require_once __DIR__ . "/../vue/base/entete.php";
        require_once __DIR__ . "/../vue/base/pied.php";
    }


}