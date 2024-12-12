<?php

class Arrondissement {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Ajouter un nouvel arrondissement
    public function createArrondissement($nom_arrondissement) {
        $sql = "INSERT INTO arrondissements (nom_arrondissement) VALUES (:nom_arrondissement)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':nom_arrondissement' => $nom_arrondissement]);
        return $this->pdo->lastInsertId();
    }

    // Récupérer tous les arrondissements
    public function getArrondissements() {
        $sql = "SELECT * FROM arrondissements";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
