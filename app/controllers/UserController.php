<?php
// app/controllers/UserController.php

require_once __DIR__ . '/../models/User.php';

class UserController {

    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Inscription (Création d'un nouvel utilisateur)
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $email = $_POST['email'];
            $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_BCRYPT);
            $role = $_POST['role']; // 'administrateur', 'superviseur', 'opérateur'
            // Créer une instance PDO

            $user = new User($this->pdo);
            $result = $user->createUser($nom, $prenom, $email, $mot_de_passe, $role);

            if ($result) {
                header("Location: /login"); // Rediriger vers la page de connexion
            } else {
                echo "Erreur lors de l'inscription.";
            }
        } else {
            // Afficher le formulaire d'inscription
            include 'app/views/register.php';
        }
    }

    // Connexion de l'utilisateur
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $mot_de_passe = $_POST['mot_de_passe'];

            $user = new User($this->pdo);
            $utilisateur = $user->getUserByEmail($email);

            if ($utilisateur && password_verify($mot_de_passe, $utilisateur['mot_de_passe'])) {
                session_start();
                $_SESSION['user_id'] = $utilisateur['id_utilisateur'];
                $_SESSION['role'] = $utilisateur['role'];
                var_dump($_SESSION['user_id']);
                print($_SESSION['user_id']);
                header("Location: /dashboard"); 
            } else {
                echo "Email ou mot de passe incorrect.";
            }
        } else {
            // Afficher le formulaire de connexion
            include 'app/views/login.php';
        }
    }

    // Déconnexion de l'utilisateur
    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header("Location: /login"); // Rediriger vers la page de connexion
    }

    // Affichage des informations de l'utilisateur
    public function show($id) {
        $user = new User($this->pdo);
        $utilisateur = $user->getUserById($id);
        include 'app/views/userProfile.php';
    }

    // Mise à jour des informations de l'utilisateur
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $email = $_POST['email'];
            $role = $_POST['role'];

            $user = new User($this->pdo);
            $result = $user->updateUser($id, $nom, $prenom, $email, $role);

            if ($result) {
                header("Location: /user/{$id}"); // Rediriger vers la page de profil
            } else {
                echo "Erreur lors de la mise à jour.";
            }
        } else {
            $user = new User($this->pdo);
            $utilisateur = $user->getUserById($id);
            include 'app/views/editUser.php'; // Formulaire de mise à jour
        }
    }

    // Afficher tous les utilisateurs
    public function index() {
        $user = new User($this->pdo);
        $users = $user->getAllUsers();
        include 'app/views/admin_dashboard.php'; // Afficher la vue de gestion des utilisateurs
    }

    // Créer un nouvel utilisateur
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $email = $_POST['email'];
            $mot_de_passe = $_POST['mot_de_passe'];
            $role = $_POST['role']; // 'administrateur', 'superviseur', 'opérateur'

            $user = new User($this->pdo);
            $user->createUser($nom, $prenom, $email, $mot_de_passe, $role);
            header("Location: /admin_dashboard");
        } else {
            include 'app/views/createUser.php'; // Formulaire pour ajouter un utilisateur
        }
    }

    // Modifier un utilisateur
    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $email = $_POST['email'];
            $role = $_POST['role'];

            $user = new User($this->pdo);
            $user->updateUser($id, $nom, $prenom, $email, $role);
            header("Location: /admin_dashboard"); // Rediriger vers la page des utilisateurs
        } else {
            $user = new User($this->pdo);
            $utilisateur = $user->getUserById($id);
            include 'app/views/editUser.php'; // Formulaire de mise à jour
        }
    }

    // Supprimer un utilisateur
    public function delete($id) {
        $user = new User($this->pdo);
        $user->deleteUser($id); // Ajouter une méthode delete dans le modèle User
        header("Location: /admin_dashboard"); // Rediriger vers la page des utilisateurs
    }
}
