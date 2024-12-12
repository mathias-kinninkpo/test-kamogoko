<?php

$host = '127.0.0.1'; // ou 'localhost'
$port = 3306; // Port MySQL par défaut
$username = 'root'; // Utilisateur par défaut dans XAMPP
$password = ''; // Pas de mot de passe par défaut dans XAMPP
$dbname = 'gestion_etat_civil'; // Nom de la base de données que tu veux créer


try {
    $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
