<?php
// Dans public/index.php

// 1. On récupère et on découpe l'URL (ex: facture/voir/2)
$url = explode('/', trim($_SERVER['REQUEST_URI'], '/'));


array_shift($url); // On enlève le premier segment (Dolibarrapp) si l'application n'est pas à la racine du serveur (en mode dev)

// Le premier segment de l'URL détermine la route (ex: 'facture')
$route = isset($url[0]) && $url[0] !== '' ? $url[0] : 'accueil';

// 2. Le SWITCH pour associer l'URL au bon nom de Contrôleur
switch ($route) {

    case 'facture':
        $nom_controleur = 'ControleurFacture';
        break;

    case 'banque':
        $nom_controleur = 'ControleurBanque';
        break;

    case 'depense':
        $nom_controleur = 'ControleurDepense';
        break;

    case 'accueil':
    case 'home':
        $nom_controleur = 'ControleurPrincipal';
        break;

    default:
        // Si l'URL n'existe pas, on renvoie vers l'accueil (ou un controleur 404)
        $nom_controleur = 'ControleurPrincipal';
        break;
}

// 3. On inclut le fichier correspondant et on l'instancie
require_once '../app/controleur/' . $nom_controleur . '.php';
$mon_controleur = new $nom_controleur();

// 4. On récupère l'action et l'ID dans la suite de l'URL
$action = isset($url[1]) && $url[1] !== '' ? $url[1] : 'index'; // ex: 'voir'
$id = isset($url[2]) ? $url[2] : null;                      // ex: '2'

// 5. On appelle la méthode du contrôleur en lui passant l'ID
$mon_controleur->$action($id);
?>