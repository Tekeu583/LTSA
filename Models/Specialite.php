<?php
require_once __DIR__ . "/../config/bdltsa.php";

class Specialite {
    // Propriétés
    private $id;
    private $name;
    private $description;
    private $code;
    private $id_admin;

    // ======================
    // CONSTRUCTEUR ET CHARGEMENT
    // ======================

    public function __construct($id = null) {
        if ($id !== null) {
            $this->load($id);
        }
    }

    private function load($id) {
        $data = $this->getById($id);
        if ($data) {
            $this->id = $data['id'];
            $this->name = $data['nom'];
            $this->description = $data['description'];
            $this->code = $data['code'];
            $this->id_admin = $data['id_admin'];
        }
    }

    // ======================
    // METHODES CRUD SPECIALITES
    // ======================

    public static function create($name, $description, $code) {
        $conn = connectDB();
        $admin =  $_SESSION['id'];
        try {
            $stmt = $conn->prepare("INSERT INTO specialite (nom, description, code, id_admin) 
                                  VALUES (:name, :description, :code, :admin)");
            
            $stmt->execute([
                ':name' => trim($name),
                ':description' => trim($description),
                ':code' => trim($code),
                ':id_admin' => (int)$admin
            ]);
            
            return $conn->lastInsertId();
        } catch (PDOException $e) {
            error_log("Erreur création spécialité: " . $e->getMessage());
            throw new Exception("Erreur lors de la création de la spécialité");
        }
    }

    public function update($name, $description, $code) {
        $conn = connectDB();
        $conn->beginTransaction();
        
        try {
            $stmt = $conn->prepare("UPDATE specialite SET 
                                   nom = :name,
                                   description = :description,
                                   code = :code
                                   WHERE id = :id");
            
            $stmt->execute([
                ':id' => $this->id,
                ':name' => trim($name),
                ':description' => trim($description),
                ':code' => trim($code)
            ]);
            
            $conn->commit();
            return true;
        } catch (PDOException $e) {
            $conn->rollBack();
            error_log("Erreur mise à jour spécialité: " . $e->getMessage());
            throw new Exception("Erreur lors de la mise à jour de la spécialité");
        }
    }

    public function delete() {
        $conn = connectDB();
        $conn->beginTransaction();
        
        try {
            // Suppression des cours associés
            $this->deleteAllCourses();
            
            // Suppression de la spécialité
            $stmt = $conn->prepare("DELETE FROM specialite WHERE id = :id");
            $stmt->execute([':id' => $this->id]);
            
            $conn->commit();
            return true;
        } catch (PDOException $e) {
            $conn->rollBack();
            error_log("Erreur suppression spécialité: " . $e->getMessage());
            throw new Exception("Erreur lors de la suppression de la spécialité");
        }
    }

    // ======================
    // METHODES COURS SPECIALITE
    // ======================

    public function getCourses() {
        $conn = connectDB();
        try {
            $stmt = $conn->prepare("SELECT * FROM cours WHERE specialite = :id ORDER BY codeEC");
            $stmt->execute([':id' => $this->id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur récupération cours: " . $e->getMessage());
            throw new Exception("Erreur lors de la récupération des cours");
        }
    }

    public function addCourse($codeEC, $intituleEC, $coef, $cm, $td, $tp, $tpe, $ccts) {
        $conn = connectDB();
        $conn->beginTransaction();
        $admin =  $_SESSION['id'];
        try {
            $stmt = $conn->prepare("INSERT INTO cours 
                                  (codeEC, intituleEC, coef, CM, TD, TP, TPE, CCTS, specialite, id_admin) 
                                  VALUES (:codeEC, :intituleEC, :coef, :cm, :td, :tp, :tpe, :ccts, :specialite, :admin)");
            
            $stmt->execute([
                ':codeEC' => trim($codeEC),
                ':intituleEC' => trim($intituleEC),
                ':coef' => (float)$coef,
                ':cm' => (int)$cm,
                ':td' => (int)$td,
                ':tp' => (int)$tp,
                ':tpe' => (int)$tpe,
                ':ccts' => (int)$ccts,
                ':specialite' => $this->id,
                ':admin' => $admin
            ]);
            
            $conn->commit();
            return $conn->lastInsertId();
        } catch (PDOException $e) {
            $conn->rollBack();
            error_log("Erreur ajout cours: " . $e->getMessage());
            throw new Exception("Erreur lors de l'ajout du cours");
        }
    }

    public function addDoctoratCours($codeEC, $intituleEC, $creditEC, $anneeDoctorat){
        $conn = connectDB();
        $conn->beginTransaction();
        $admin =  $_SESSION['id'];
        try {
            $stmt = $conn->prepare("INSERT INTO cycleDoctorat 
                                   (codeEC, intituleEC, creditEC, anneeDoctorat, id_admin) 
                                   VALUES (:codeEC, :intituleEC, :creditEC, :anneeDoctorat, :admin)");
            
            $stmt->execute([
                ':codeEC' => trim($codeEC),
                ':intituleEC' => trim($intituleEC),
                ':creditEC' => (int)($creditEC),
                ':anneeDoctorat' => trim($anneeDoctorat),
                ':admin' => $admin
            ]);
            
            $conn->commit();
            $_SESSION['success'] = "Cours de doctorat ajouté avec succès";
            
        } catch (PDOException $e) {            
            $conn->rollBack();
            $_SESSION["error"] = $e->getMessage();
            throw new Exception("Erreur lors de l'ajout du cours de doctorat");
        }
    }

    private function deleteAllCourses() {
        $conn = connectDB();
        $stmt = $conn->prepare("DELETE FROM cours WHERE specialite = :id");
        $stmt->execute([':id' => $this->id]);
    }

    // ======================
    // METHODES DOCTORAT
    // ======================

    public static function getDoctoratInfo() {
        $conn = connectDB();
        try {
            $stmt = $conn->prepare("SELECT * FROM cycleDoctorat LIMIT 1");
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC) ?: [
                'nom' => 'Doctorat',
                'code' => 'PHD',
                'description' => 'Troisième cycle universitaire'
            ];
        } catch (PDOException $e) {
            error_log("Erreur récupération doctorat: " . $e->getMessage());
            return [
                'nom' => 'Doctorat',
                'code' => 'PHD',
                'description' => 'Troisième cycle universitaire'
            ];
        }
    }

    public static function updateDoctorat($nom, $description) {
        $conn = connectDB();
        $conn->beginTransaction();
        
        try {
            $exists = $conn->query("SELECT COUNT(*) FROM cycleDoctoratt")->fetchColumn() > 0;

            if ($exists) {
                $stmt = $conn->prepare("UPDATE cycleDoctorat SET nom = :nom, description = :description");
            } else {
                $stmt = $conn->prepare("INSERT INTO doctorat (nom, description, code) 
                                      VALUES (:nom, :description, 'PHD')");
            }

            $stmt->execute([
                ':nom' => trim($nom),
                ':description' => trim($description)
            ]);

            $conn->commit();
            return true;
        } catch (PDOException $e) {
            $conn->rollBack();
            error_log("Erreur mise à jour doctorat: " . $e->getMessage());
            throw new Exception("Erreur lors de la mise à jour du doctorat");
        }
    }

    // ======================
    // METHODES STATIQUES UTILITAIRES
    // ======================

    public static function getAll() {
        $conn = connectDB();
        try {
            $stmt = $conn->prepare("SELECT * FROM specialite ORDER BY nom");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur récupération spécialités: " . $e->getMessage());
            throw new Exception("Erreur lors de la récupération des spécialités");
        }
    }

    public static function getById($id) {
        $conn = connectDB();
        try {
            $stmt = $conn->prepare("SELECT * FROM specialite WHERE id = :id");
            $stmt->execute([':id' => (int)$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur récupération spécialité: " . $e->getMessage());
            throw new Exception("Erreur lors de la récupération de la spécialité");
        }
    }

    public static function getDoctoratCourses() {
        $conn = connectDB();
        try {
            $stmt = $conn->prepare("SELECT * FROM cycleDoctorat ORDER BY anneeDoctorat, codeEC");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur récupération cours doctorat: " . $e->getMessage());
            throw new Exception("Erreur lors de la récupération des cours de doctorat");
        }
    }
    
    /**
     * Met à jour un cours (spécialité normale)
     * @param string $codeEC Code du cours
     * @param string $intituleEC Intitulé du cours
     * @param float $coef Coefficient
     * @param int $cm Heures de CM
     * @param int $td Heures de TD
     * @param int $tp Heures de TP
     * @param int $tpe Heures de TPE
     * @param int $ccts Crédits CCTS
     * @param int $id ID du cours
     * @return int Nombre de lignes affectées
     * @throws Exception Si erreur de base de données
     */
    public  function editCours($codeEC, $intituleEC, $coef, $cm, $td, $tp, $tpe, $ccts, $id) {
        $conn = connectDB();
        $conn->beginTransaction();
        try {
            $stmt = $conn->prepare("UPDATE cours SET 
                                  codeEC = :codeEC,
                                  intituleEC = :intituleEC,
                                  coef = :coef,
                                  CM = :cm,
                                  TD = :td,
                                  TP = :tp,
                                  TPE = :tpe,
                                  CCTS = :ccts
                                  WHERE id = :id");
            
            $stmt->execute([
                ':codeEC' => trim($codeEC),
                ':intituleEC' => trim($intituleEC),
                ':coef' => (float)$coef,
                ':cm' => (int)$cm,
                ':td' => (int)$td,
                ':tp' => (int)$tp,
                ':tpe' => (int)$tpe,
                ':ccts' => (int)$ccts,
                ':id' => (int)$id
            ]);
            
            $rowCount = $stmt->rowCount();
            $conn->commit();
            return $rowCount;
        } catch (PDOException $e) {
            $conn->rollBack();
            error_log("Erreur mise à jour cours: " . $e->getMessage());
            throw new Exception("Erreur lors de la mise à jour du cours");
        }
    }
    
    /**
     * Supprime un cours (spécialité normale)
     * @param int $id ID du cours à supprimer
     * @return int Nombre de lignes affectées
     * @throws Exception Si erreur de base de données
     */
    public static function deleteCourse($id) {
        $conn = connectDB();
        $conn->beginTransaction();
        try {
            $stmt = $conn->prepare("DELETE FROM cours WHERE id = :id");
            $stmt->execute([':id' => (int)$id]);
            $rowCount = $stmt->rowCount();
            $conn->commit();
            return $rowCount;
        } catch (PDOException $e) {
            $conn->rollBack();
            error_log("Erreur suppression cours: " . $e->getMessage());
            throw new Exception("Erreur lors de la suppression du cours");
        }
    }
    
    /**
     * Met à jour un cours de doctorat
     * @param int $id ID du cours
     * @param string $codeEC Code du cours
     * @param string $intituleEC Intitulé du cours
     * @param int $creditEC Crédits ECTS
     * @param string $anneeDoctorat Année du doctorat
     * @return int Nombre de lignes affectées
     * @throws Exception Si erreur de base de données
     */
    public static function editDoctoratCours($id, $codeEC, $intituleEC, $creditEC, $anneeDoctorat) {
        $conn = connectDB();
        $conn->beginTransaction();
        try {
            $stmt = $conn->prepare("UPDATE cycleDoctorat SET 
                                  codeEC = :codeEC,
                                  intituleEC = :intituleEC,
                                  creditEC = :creditEC,
                                  anneeDoctorat = :anneeDoctorat
                                  WHERE id = :id");
            
            $stmt->execute([
                ':id' => (int)$id,
                ':codeEC' => trim($codeEC),
                ':intituleEC' => trim($intituleEC),
                ':creditEC' => (int)$creditEC,
                ':anneeDoctorat' => trim($anneeDoctorat)
            ]);
            
            $rowCount = $stmt->rowCount();
            $conn->commit();
            return $rowCount;
        } catch (PDOException $e) {
            $conn->rollBack();
            error_log("Erreur mise à jour cours doctorat: " . $e->getMessage());
            throw new Exception("Erreur lors de la mise à jour du cours de doctorat");
        }
    }
    
    /**
     * Supprime un cours de doctorat
     * @param int $id ID du cours à supprimer
     * @return int Nombre de lignes affectées
     * @throws Exception Si erreur de base de données
     */
    public static function deleteDoctoratCourse($id) {
        $conn = connectDB();
        $conn->beginTransaction();
        try {
            $stmt = $conn->prepare("DELETE FROM cycleDoctorat WHERE id = :id");
            $stmt->execute([':id' => (int)$id]);
            $rowCount = $stmt->rowCount();
            $conn->commit();
            return $rowCount;
        } catch (PDOException $e) {
            $conn->rollBack();
            error_log("Erreur suppression cours doctorat: " . $e->getMessage());
            throw new Exception("Erreur lors de la suppression du cours de doctorat");
        }
    }
    // ======================
    // GETTERS
    // ======================

    public function getId() { return $this->id; }
    public function getName() { return $this->name; }
    public function getDescription() { return $this->description; }
    public function getCode() { return $this->code; }
}