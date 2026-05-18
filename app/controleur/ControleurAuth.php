<?php

require_once __DIR__ . "/../modele/DolibarrAPI.php";
class ControleurAuth
{
    private $api;

    public function __construct()
    {
        $this->api = new DolibarrAPI(); // Utilise ton modèle API existant
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    // URL: /auth/login
    // Affiche la page de connexion
    public function login()
    {
        if (isset($_SESSION['user_id'])) {
            // Si l'utilisateur est déjà connecté, redirige vers l'accueil
            header("Location: /Dolibarrapp/accueil");
            exit();
        }
        require_once __DIR__ . "/../vue/base/entete.php";
        include __DIR__ . "/../vue/auth/connexion.php";
        require_once __DIR__ . "/../vue/base/pied.php";
    }

    // URL: /auth/tenterConnexion
    // Traite la soumission du formulaire de connexion
    public function tenterConnexion()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // On récupère le login saisi dans le champ "email" de ton formulaire
            $loginSaisi = $_POST['email'];

            // On vérifie auprès de l'API
            $user = $this->api->checkLogin($loginSaisi);

            if ($user) {
                // On stocke les infos en session pour s'en souvenir sur les autres pages
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_nom'] = $user['login'];

                // Redirection vers l'accueil de l'application
                header("Location: /Dolibarrapp/accueil");
                exit();
            } else {
                // Si l'utilisateur n'existe pas dans Dolibarr
                $erreur = "Utilisateur Dolibarr introuvable.";
                $this->login(); // Cela évite de réécrire les require_once
            }
        }
    }

    // URL: /auth/deconnexion
    // Nettoie la session et déconnecte l'utilisateur
    public function deconnexion()
    {
        $_SESSION = array();

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        session_destroy();

        // Redirection vers le login
        header("Location: /Dolibarrapp/auth/login");
        exit();
    }
}