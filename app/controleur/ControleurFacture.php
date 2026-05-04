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
        $invoices = $this->api->getInvoices();
        require_once __DIR__ . "/../vue/base/entete.php";
        include __DIR__ . "/../vue/facture.php";
        require_once __DIR__ . "/../vue/base/pied.php";
    }

    public function liste()
    {
        $invoices = $this->api->getInvoices();
        require_once __DIR__ . "/../vue/base/entete.php";
        include __DIR__ . "/../vue/factureliste.php";
        require_once __DIR__ . "/../vue/base/pied.php";
    }
}
