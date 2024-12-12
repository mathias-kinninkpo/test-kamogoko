<?php

class User {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Créer un nouvel utilisateur
    public function createUser($nom, $prenom, $email, $mot_de_passe, $role) {
        $sql = "INSERT INTO utilisateurs (nom, prenom, email, mot_de_passe, rôle) 
                VALUES (:nom, :prenom, :email, :mot_de_passe, :role)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':email' => $email,
            ':mot_de_passe' => password_hash($mot_de_passe, PASSWORD_BCRYPT),
            ':role' => $role
        ]);
        return $this->pdo->lastInsertId();
    }

    // Récupérer un utilisateur par email
    public function getUserByEmail($email) {
        $sql = "SELECT * FROM utilisateurs WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Vérifier les identifiants de connexion
    public function checkLogin($email, $mot_de_passe) {
        $utilisateur = $this->getUserByEmail($email);
        if ($utilisateur && password_verify($mot_de_passe, $utilisateur['mot_de_passe'])) {
            return $utilisateur;
        }
        return false;
    }

    // Récupérer un utilisateur par ID
    public function getUserById($id) {
        $sql = "SELECT * FROM utilisateurs WHERE id_utilisateur = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Mettre à jour un utilisateur
    public function updateUser($id, $nom, $prenom, $email, $role) {
        $sql = "UPDATE utilisateurs SET nom = :nom, prenom = :prenom, email = :email, rôle = :role 
                WHERE id_utilisateur = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':email' => $email,
            ':role' => $role
        ]);
    }
    public function deleteUser($id) {
        $sql = "DELETE FROM utilisateurs WHERE id_utilisateur = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    // Récupérer tous les utilisateurs
    public function getAllUsers() {
        $sql = "SELECT * FROM utilisateurs";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
