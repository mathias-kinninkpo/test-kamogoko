<?php

// Inclure le fichier de routage
require_once __DIR__ . '/router.php';

// Récupérer l'URI
$uri = trim($_SERVER['REQUEST_URI'], '/');

// Logique de routage simplifiée
if ($uri == '') {
    home();
} elseif ($uri == 'about') {
    about();
} elseif ($uri == 'login') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        handleLogin();
    } else {
        showLoginForm();
    }
} else {
    notFound();
}
