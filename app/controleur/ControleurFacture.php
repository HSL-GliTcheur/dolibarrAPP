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

        $traductionReglement = [
            "Due upon receipt" => "À la réception",
            "Due on order" => "À la commande",
            "Due on delivery" => "À la livraison",
            "50% on order, 50% on delivery" => "50% à la commande, 50% à la livraison",
            "Due in 10 days" => "10 jours",
            "Due in 10 days, end of month" => "10 jours fin de mois",
            "Due in 14 days" => "14 jours",
            "Due in 14 days, end of month" => "14 jours fin de mois",
            "Due in 30 days" => "30 jours",
            "Due in 30 days, end of month" => "30 jours fin de mois",
            "Due in 45 days" => "45 jours",
            "Due in 45 days, end of month" => "45 jours fin de mois",
            "Due in 60 days" => "60 jours",
        ];

        require_once __DIR__ . "/../vue/base/entete.php";
        include __DIR__ . "/../vue/factureliste.php";
        require_once __DIR__ . "/../vue/base/pied.php";
    }
}
