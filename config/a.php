<?php
// Connexion à la base de données
require_once __DIR__ . '/db.php'; // Inclure la connexion à la base de données

// Vérifier si l'administrateur existe déjà
$sql = "SELECT * FROM utilisateurs WHERE email = :email";
$stmt = $pdo->prepare($sql);
$stmt->execute([':email' => 'adm@exemple.com']);
$adminExists = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$adminExists) {
    // Créer l'administrateur par défaut
    $sql = "INSERT INTO user (nom, prenom, email, mot_de_passe)
            VALUES (:nom, :prenom, :email, :mot_de_passe )";
    $stmt = $pdo->prepare($sql);
    var_dump([
        ':nom' => 'Admin',
        ':prenom' => 'Super',
        ':email' => 'adm@exemple.com',
        ':mot_de_passe' => password_hash('votre_mot_de_passe', PASSWORD_BCRYPT),
        // ':rôle' => 'administrateur'
    ]);
    
    $stmt->execute([
        ':nom' => 'Admin',
        ':prenom' => 'Super',
        ':email' => 'admin@exemple.com',
        ':mot_de_passe' => password_hash('pass', PASSWORD_BCRYPT),
        // ':rôle' => 'administrateur'
    ]);
    echo "Administrateur par défaut créé avec succès.";
} else {
    echo "L'administrateur existe déjà.";
}
?>
