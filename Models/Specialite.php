<?php
require_once(__DIR__ . "/../config/bdltsa.php");

class Specialite {

    private $id;
    private $name;
    private $description;
    private $specialite_id;
    private $id_admin;
    private $codeEC;
    private $intituleEC;
    private $coef;
    private $cm;
    private $td;
    private $tp;
    private $tpe;
    private $ccts;
    private $code;


    public function newspecialite($name, $description, $id_admin, $code) {
        $conn = connectDB();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        try {
            $conn->beginTransaction();
            
            $stmt = $conn->prepare("INSERT INTO specialite (nom, description, code, id_admin) 
                VALUES (:name, :description, :code, :id_admin)");
    
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':code', $code);
            $stmt->bindParam(':id_admin', $id_admin);
    
            $result = $stmt->execute();
            $conn->commit();
            
            return $result;
    
        } catch (PDOException $e) {
            if ($conn->inTransaction()) {
                $conn->rollBack();
            }
            error_log("Erreur DB: " . $e->getMessage());
            return false;
        }
    }
    

    public function editSpecialite($id, $name, $description, $code) {
        $conn = connectDB();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->beginTransaction(); // Début de transaction
    
        try {
            // Validation robuste des données
            if (!is_numeric($id) || $id <= 0) {
                throw new InvalidArgumentException("ID invalide");
            }
    
            if (empty(trim($name)) || strlen(trim($name)) > 100) {
                throw new InvalidArgumentException("Nom invalide (1-100 caractères)");
            }
    
            if (empty(trim($code)) || strlen(trim($code)) > 20) {
                throw new InvalidArgumentException("Code invalide (1-20 caractères)");
            }
    
            // Requête préparée sécurisée
            $stmt = $conn->prepare("UPDATE specialite 
                                   SET nom = :name,
                                       description = :description,
                                       code = :code
                                   WHERE id = :id");
    
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->bindValue(':name', trim($name), PDO::PARAM_STR);
            $stmt->bindValue(':description', !empty(trim($description)) ? trim($description) : null, PDO::PARAM_STR);
            $stmt->bindValue(':code', trim($code), PDO::PARAM_STR);
    
            $stmt->execute();
            $rowCount = $stmt->rowCount();
            
            $conn->commit(); // Validation de la transaction
            
            return $rowCount;
    
        } catch (PDOException $e) {
            $conn->rollBack();
            error_log("[".date('Y-m-d H:i:s')."] ERREUR DB: " . $e->getMessage() . " dans " . __FILE__ . " ligne " . __LINE__);
            throw new Exception("Erreur de mise à jour en base de données");
            
        } catch (InvalidArgumentException $e) {
            $conn->rollBack();
            error_log("[".date('Y-m-d H:i:s')."] ERREUR VALIDATION: " . $e->getMessage());
            throw $e;
            
        } catch (Exception $e) {
            $conn->rollBack();
            error_log("[".date('Y-m-d H:i:s')."] ERREUR INATTENDUE: " . $e->getMessage());
            throw new RuntimeException("Erreur lors de la mise à jour");
        }
    }

    public function delspecialite ($id){
        $conn = connectDB();
        $conn->beginTransaction();
        try {
            $stmt = $conn->prepare("DELETE FROM specialite WHERE id = ? ");            
            $stmt->execute([$id]);

            $conn->commit(); // Validation de la transaction
            
        }catch (PDOException $e) {
            $conn->rollBack(); // Annulation de la transaction en cas d'erreur  
            $_SESSION['error'] = "Erreur à la suppression". $e->getMessage();          
        } finally {
            $conn = null; // Ferme la connexion
        }
    }

    public static function getAllSpecialites() {
        $conn = connectDB();
        try {
            $stmt = $conn->prepare("SELECT * FROM specialite ORDER BY id ASC");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();            
        }
    }
    

    public static function getspecialite_id($id) {
        $conn = connectDB();
        try {
            $stmt = $conn->prepare("SELECT nom FROM specialite WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            
            // Récupère uniquement la colonne 'nom'
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return $result ? $result['nom'] : null;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();            
        }
    }

    public function newcourse($codeEC, $intituleEC, $coef, $cm, $td, $tp, $tpe, $ccts, $specialite) {
        $conn = connectDB();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        try {
            // Validation des types
            if (!is_numeric($coef) || !is_numeric($cm) || !is_numeric($td) || 
                !is_numeric($tp) || !is_numeric($tpe) || !is_numeric($ccts)) {
                throw new InvalidArgumentException("Tous les champs numériques doivent être valides");
            }
    
            $stmt = $conn->prepare("INSERT INTO cours (codeEC, intituleEC, coef, CM, TD, TP, TPE, CCTS, specialite) 
                                   VALUES (:codeEC, :intituleEC, :coef, :cm, :td, :tp, :tpe, :ccts, :specialite)");
            
            $stmt->execute([
                ':codeEC' => $codeEC,
                ':intituleEC' => $intituleEC,
                ':coef' => (float)$coef,
                ':cm' => (int)$cm,
                ':td' => (int)$td,
                ':tp' => (int)$tp,
                ':tpe' => (int)$tpe,
                ':ccts' => (int)$ccts,
                ':specialite' => (int)$specialite
            ]);
    
            return $conn->lastInsertId(); // Retourne l'ID du nouveau cours
    
        } catch (PDOException $e) {
            error_log("Erreur DB: " . $e->getMessage());
            throw new Exception("Erreur lors de l'ajout du cours");
        }
    }
    public function editcours($codeEC, $intituleEC, $coef, $cm,$td, $tp, $tpe, $ccts, $id) {
        $conn = connectDB();
        try {
            $stmt = $conn->prepare("UPDATE cours SET codeEC = :codeEC, intituleEC = :intituleEC, coef = :coef, cm = :cm, td = :td, tp = :tp, tpe = :tpe, ccts = :ccts WHERE id = :id");
            $stmt->bindParam(':codeEC', $codeEC, PDO::PARAM_STR);
            $stmt->bindParam(':intituleEC', $intituleEC, PDO::PARAM_STR);
            $stmt->bindParam(':coef', $coef, PDO::PARAM_STR);   
            $stmt->bindParam(':cm', $cm, PDO::PARAM_STR);
            $stmt->bindParam(':td', $td, PDO::PARAM_STR);
            $stmt->bindParam(':tp', $tp, PDO::PARAM_STR);
            $stmt->bindParam(':tpe', $tpe, PDO::PARAM_STR);
            $stmt->bindParam(':ccts', $ccts, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->rowCount(); // Retourne le nombre de lignes affectées
        }catch (PDOException $e) {
            echo "Error: " . $e->getMessage();            
        }
    }
    public function deletecourse($id) {
        $conn = connectDB();
        try {
            $stmt = $conn->prepare("DELETE FROM cours WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return null;
        }catch (PDOException $e) {
            echo "Error: " . $e->getMessage();            
        }
    }
    

    public static  function get_courses_by_specialite ($id){
        $conn = connectDB();

        try{
            $stmt = $conn->prepare("SELECT * FROM cours WHERE specialite = :id ORDER BY id DESC");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }
    }


}
?>