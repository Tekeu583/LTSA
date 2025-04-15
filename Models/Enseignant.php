<?php
require_once(__DIR__ . "/../config/bdltsa.php");
class Enseignant{
    // attributs de la classe Enseignant
    private $id;
    private $nom;
    private $grade;
    private $fonction;
    private $lieuTravail;
    private $id_admin;
    private $created_at;
   
    public function getNom(){
        return $this->nom;
    }
    public function getGrade(){
        return $this->grade;
    }
    public function getFonction(){
        return $this->fonction;
    }
    public function getLieuTravail(){
        return $this->lieuTravail;
    }
    public function getIdAdmin(){
        return $this->id_admin;
    }
    public function getCreatedAt(){
        return $this->created_at;
    }
    public function getId(){
        return $this->id;
    }
    public function setNom($nom){
        $this->nom=$nom;
    }
    public function setGrade($grade){
        $this->grade=$grade;
    }
    public function setFonction($fonction){
        $this->fonction=$fonction;
    }
    public function setLieuTravail($lieuTravail){
        $this->lieuTravail=$lieuTravail;
    }

    //ajouter un enseignant à la base de données
    // et à la liste des enseignants
    public function newEnseignant($nom,$grade,$fonction,$lieuTravail,$id_admin){
        $conn = connectDB();
        try{
            $verifierExist = $conn->prepare("SELECT * FROM enseignant WHERE nom = :nom");
            $verifierExist->bindParam(':nom', $nom, PDO::PARAM_STR);
            $verifierExist->execute();
            $enseignant = $verifierExist->fetch(PDO::FETCH_ASSOC);
            // Vérifier si l'enseignant existe déjà
            if($enseignant){
                return false; // l'enseignant existe déjà
            }
            $nom=htmlspecialchars(strip_tags($nom));
            $grade=htmlspecialchars(strip_tags($grade));
            $fonction=htmlspecialchars(strip_tags($fonction));
            $lieuTravail=htmlspecialchars(strip_tags($lieuTravail));
            $id_admin=htmlspecialchars(strip_tags($id_admin));
            $stmt = $conn->prepare("INSERT INTO enseignant (nom, grade, fonction, lieuTravail,id_admin,created_at) VALUES (:nom, :grade, :fonction, :lieuTravail,:id_admin,NOW())");
            $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
            $stmt->bindParam(':grade', $grade, PDO::PARAM_STR);
            $stmt->bindParam(':fonction', $fonction, PDO::PARAM_STR);
            $stmt->bindParam(':lieuTravail', $lieuTravail, PDO::PARAM_STR);
            $stmt->bindParam(':id_admin', $id_admin, PDO::PARAM_INT);
            $stmt->execute();

            return true;
        }catch (PDOException $e) {
            echo "Error: " . $e->getMessage();            
        }
    }
    //modifier un enseignant de la base de données

    public function modifierEnseignant($id,$nom,$grade,$fonction,$lieuTravail,$created_at){
        $conn = connectDB();
        try{
            // Vérifier si l'enseignant existe déjà
            $verifierExist = $conn->prepare("SELECT * FROM enseignant WHERE nom = :nom AND id != :id");
            $verifierExist->bindParam(':nom', $nom, PDO::PARAM_STR);
            $verifierExist->bindParam(':id', $id, PDO::PARAM_INT);
            $verifierExist->execute();
            $enseignant = $verifierExist->fetch(PDO::FETCH_ASSOC);
            // Vérifier si l'enseignant existe déjà
            if($enseignant){
                return false; // l'enseignant existe déjà
            }
            //modifier l'enseignant dans la base de données
            $nom=htmlspecialchars(strip_tags($nom));
            $grade=htmlspecialchars(strip_tags($grade));
            $fonction=htmlspecialchars(strip_tags($fonction));
            $lieuTravail=htmlspecialchars(strip_tags($lieuTravail));
            $created_at=htmlspecialchars(strip_tags($created_at));
            $stmt = $conn->prepare("UPDATE enseignant SET nom = :nom, grade = :grade, fonction = :fonction, lieuTravail = :lieuTravail, created_at = :created_at  WHERE id =:id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
            $stmt->bindParam(':grade', $grade, PDO::PARAM_STR);
            $stmt->bindParam(':fonction', $fonction, PDO::PARAM_STR);
            $stmt->bindParam(':lieuTravail', $lieuTravail, PDO::PARAM_STR);
            $stmt->bindParam(':created_at', $created_at, PDO::PARAM_STR);
            $stmt->execute();

            return true;
        }catch (PDOException $e) {
            echo "Error: " . $e->getMessage();            
        }
    }

    //supprimer un enseignant de la base de données
    public function supprimerEnseignant($id){
        $conn = connectDB();
        try{
            $stmt = $conn->prepare("DELETE FROM enseignant WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        }catch (PDOException $e) {
            return $e->getMessage();            
        }
    }
    // recuperer touts les enseignants de la base de données
    public function getEnseignants(){
        $conn = connectDB();
        try{
            $stmt = $conn->prepare("SELECT * FROM enseignant");
            $stmt->execute();
            $enseignants = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $enseignants;
        }catch (PDOException $e) {
            echo "Error: " . $e->getMessage();            
        }
    }
    //retourne un enseignant en fonction de son id
    // si l'enseignant n'existe pas, une exception est levée
    public function getEnseignantById($id){
        $conn = connectDB();
        try{
            $stmt = $conn->prepare("SELECT * FROM enseignant WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $enseignant = $stmt->fetch(PDO::FETCH_ASSOC);
            return $enseignant;
        }catch (PDOException $e) {
            echo "Error: " . $e->getMessage();            
        }
    }
}
?>