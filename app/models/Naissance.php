<?php

class Naissance {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Ajouter un enregistrement de naissance
    public function createNaissance($nom_enfant, $prenom_enfant, $nom_pere, $prenom_pere, $nom_mere, $prenom_mere, $data_naissance, $date_enregistrement, $id_arrondissement) {
        $sql = "INSERT INTO naissance (nom_enfant, prenom_enfant, nom_pere, prenom_pere, nom_mere, prenom_mere, data_naissance, date_enregistrement, id_arrondissement)
                VALUES (:nom_enfant, :prenom_enfant, :nom_pere, :prenom_pere, :nom_mere, :prenom_mere, :data_naissance, :date_enregistrement, :id_arrondissement)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':nom_enfant' => $nom_enfant,
            ':prenom_enfant' => $prenom_enfant,
            ':nom_pere' => $nom_pere,
            ':prenom_pere' => $prenom_pere,
            ':nom_mere' => $nom_mere,
            ':prenom_mere' => $prenom_mere,
            ':data_naissance' => $data_naissance,
            ':date_enregistrement' => $date_enregistrement,
            ':id_arrondissement' => $id_arrondissement
        ]);
        return $this->pdo->lastInsertId();
    }

    // Récupérer tous les enregistrements de naissance
    public function getNaissances() {
        $sql = "SELECT * FROM naissance";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer une naissance par ID
    public function getNaissanceParId($id_naissance) {
        $sql = "SELECT * FROM naissance WHERE id_naissance = :id_naissance";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id_naissance' => $id_naissance]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
