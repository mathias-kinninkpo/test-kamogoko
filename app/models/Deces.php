<?php

class Deces {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Ajouter un enregistrement de décès
    public function createDeces($nom_defunt, $prenom_defunt, $age_defunt, $date_heure_deces, $prenom_epouse, $nom_temoin, $prenom_temoin, $date_enregistrement, $id_arrondissement) {
        $sql = "INSERT INTO deces (nom_defunt, prenom_defunt, age_defunt, date_heure_deces, prenom_epouse, nom_temoin, prenom_temoin, date_enregistrement, id_arrondissement)
                VALUES (:nom_defunt, :prenom_defunt, :age_defunt, :date_heure_deces, :prenom_epouse, :nom_temoin, :prenom_temoin, :date_enregistrement, :id_arrondissement)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':nom_defunt' => $nom_defunt,
            ':prenom_defunt' => $prenom_defunt,
            ':age_defunt' => $age_defunt,
            ':date_heure_deces' => $date_heure_deces,
            ':prenom_epouse' => $prenom_epouse,
            ':nom_temoin' => $nom_temoin,
            ':prenom_temoin' => $prenom_temoin,
            ':date_enregistrement' => $date_enregistrement,
            ':id_arrondissement' => $id_arrondissement
        ]);
        return $this->pdo->lastInsertId();
    }

    // Récupérer tous les enregistrements de décès
    public function getDeces() {
        $sql = "SELECT * FROM deces";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer un décès par ID
    public function getDecesParId($id_deces) {
        $sql = "SELECT * FROM deces WHERE id_deces = :id_deces";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id_deces' => $id_deces]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
