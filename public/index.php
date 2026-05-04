<?php

require_once __DIR__ . "/../app/controleur/ControleurPrincipal.php";
require_once __DIR__ . "/../app/modele/DolibarrAPI.php";

// Récupération de la route
$route = $_GET['route'] ?? 'home';

// Routing simple
switch ($route) {

    case 'facture':
        require_once __DIR__ . "/../app/controleur/ControleurFacture.php";
        $controller = new ControleurFacture();
        $controller->index();
        break;

    case 'facture/liste':
        require_once __DIR__ . "/../app/controleur/ControleurFacture.php";
        $controller = new ControleurFacture();
        $controller->liste();
        break;

    case 'depense':
        require_once __DIR__ . "/../app/controleur/ControleurDepense.php";
        $controller = new ControleurDepense();
        $controller->index();
        break;

    case 'banque':
        require_once __DIR__ . "/../app/controleur/ControleurBanque.php";
        $controller = new ControleurBanque();
        $controller->index();
        break;

    case 'home':
    default:
        $controller = new ControleurPrincipal();
        $controller->index();
        break;
}
