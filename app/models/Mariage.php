<?php

class Mariage {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Ajouter un enregistrement de mariage
    public function createMariage($nom_epoux, $prenom_epoux, $nom_epouse, $prenom_epouse, $nom_temoin, $prenom_temoin, $date_enregistrement, $id_arrondissement) {
        $sql = "INSERT INTO mariage (nom_epoux, prenom_epoux, nom_epouse, prenom_epouse, nom_temoin, prenom_temoin, date_enregistrement, id_arrondissement)
                VALUES (:nom_epoux, :prenom_epoux, :nom_epouse, :prenom_epouse, :nom_temoin, :prenom_temoin, :date_enregistrement, :id_arrondissement)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':nom_epoux' => $nom_epoux,
            ':prenom_epoux' => $prenom_epoux,
            ':nom_epouse' => $nom_epouse,
            ':prenom_epouse' => $prenom_epouse,
            ':nom_temoin' => $nom_temoin,
            ':prenom_temoin' => $prenom_temoin,
            ':date_enregistrement' => $date_enregistrement,
            ':id_arrondissement' => $id_arrondissement
        ]);
        return $this->pdo->lastInsertId();
    }

    // Récupérer tous les enregistrements de mariage
    public function getMariages() {
        $sql = "SELECT * FROM mariage";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer un mariage par ID
    public function getMariageById($id_mariage) {
        $sql = "SELECT * FROM mariage WHERE id_mariage = :id_mariage";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id_mariage' => $id_mariage]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
