<?php
// app/controllers/DashboardController.php

require_once __DIR__ . '/../models/User.php';


class DashboardController {

    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Afficher le tableau de bord
    public function index() {
        // Vérifier si l'utilisateur est connecté
        session_start();
        $user = new User($this->pdo);
        // $utilisateur = $user->getUserById($_SESSION['user_id']);
        $userModel = new User($this->pdo);  // $this->pdo est la connexion à la base de données
        $users = $userModel->getAllUsers();  // Récupère tous les utilisateurs depuis la base de données

        include __DIR__ . '/../views/dashboard.php';
        // if (isset($_SESSION['user_id'])) {
        //     // Récupérer les informations de l'utilisateur connecté
        //     $user = new User($this->pdo);
        //     $utilisateur = $user->getUserById($_SESSION['user_id']);

        //     // Afficher la vue du tableau de bord
        //     include 'app/views/dashboard.php'; // Vous pouvez ajuster le nom du fichier si nécessaire
        // } else {
        //     // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
        //     header("Location: /login");
        //     exit();
        // }
    }
}
