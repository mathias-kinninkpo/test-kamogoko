<?php

// Inclure le modèle User
// require_once __DIR__ . '/../models/User.php';
// require_once __DIR__ . '/../controllers/UserController.php';

// Fonction pour gérer la page d'accueil
function home() {
    echo "<h1>Page d'accueil</h1>";
}

// Fonction pour gérer la page "À propos"
function about() {
    echo "<h1>À propos</h1>";
}

// Fonction pour afficher la page de connexion
function showLoginForm() {
    require_once __DIR__ . '/../views/login.php';
}

function ShowDashboard() {
    require_once __DIR__ . '/../controllers/UserController.php';
    require_once __DIR__ . '/../controllers/dashbordController.php';
    $pdo = new PDO("mysql:host=127.0.0.1;dbname=gestion_etat_civil", "root", "", [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
    $controller = new DashboardController($pdo);
    $controller->index(); 
}


function handleLogin() {
    require_once __DIR__ . '/../models/User.php';
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    $pdo = new PDO("mysql:host=127.0.0.1;dbname=gestion_etat_civil", "root", "", [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    
    $userModel = new User($pdo);


    $utilisateur = $userModel->checkLogin($email, $mot_de_passe);

    if ($utilisateur) {
        
        session_start();
        $_SESSION['utilisateur'] = $utilisateur;
        header('Location: /dashboard');
        exit;
    } else {
        
        $errorMessage = "Identifiants incorrects.";
        require_once __DIR__ . '/../views/login.php';
    }
}


function notFound() {
    echo "<h1>404 - Page non trouvée</h1>";
}
