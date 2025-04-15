<?php
require_once(__DIR__ . "/../config/bdltsa.php");
class Doctorant{
    // attributs de la classe doctorant
    private $id;
    private $nom;
    private $intitule;
    private $dates;
    private $formation;
    private $numero;
    private $id_admin;
    private $created_at;
   
    //les getteurs et nsetteur de la classe doctorants
    public function getID(){
        return $this->id;
    }
    public function getNom(){
        return $this->nom;
    }
    public function getIntitule(){
        return $this->intitule;
    }
    public function getDates(){
        return $this->dates;
    }
    public function getFormation(){
        return $this->formation;
    }
    public function getNumero(){
        return $this->numero;
    }
    public function getIdAdmin(){
        return $this->id_admin;
    }
    public function getCreated_at(){
        return $this->created_at;
    }
    public function setID($id){
        $this->id = $id;
    }
    public function setNom($nom){
        $this->nom = $nom;
    }
    public function setIntitule($intitule){
        $this->intitule = $intitule;
    }
    public function setDates($dates){
        $this->dates = $dates;
    }
    public function setFormation($formation){
        $this->formation = $formation;
    }
    public function setNumero($numero){
        $this->numero = $numero;
    }
    public function setIdAdmin($id_admin){
        $this->id_admin = $id_admin;
    }
    public function setCreated_at($created_at){
        $this->created_at = $created_at;
    }
    //ajouter un doctorant à la base de données
    // et à la liste des doctorant
    public function newDoctorant($nom,$intitule,$dates,$formation,$numero,$id_admin){
        $conn = connectDB();
        try{
            $verifierExist = $conn->prepare("SELECT * FROM doctorant WHERE nom = :nom");
            $verifierExist->bindParam(':nom', $nom, PDO::PARAM_STR);
            $verifierExist->execute();
            $doctorant = $verifierExist->fetch(PDO::FETCH_ASSOC);
            // Vérifier si l'doctorant existe déjà
            if($doctorant){
                return false; // l'doctorant existe déjà
            }
            $stmt = $conn->prepare("INSERT INTO doctorant (nom, intitule, dates, formation,numero,id_admin,created_at) VALUES (:nom, :intitule, :dates, :formation,:numero,:id_admin,NOW())");
            $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
            $stmt->bindParam(':intitule', $intitule, PDO::PARAM_STR);
            $stmt->bindParam(':dates', $dates, PDO::PARAM_STR);
            $stmt->bindParam(':formation', $formation, PDO::PARAM_STR);
            $stmt->bindParam(':numero', $numero, PDO::PARAM_STR);
            $stmt->bindParam(':id_admin', $id_admin, PDO::PARAM_INT);
            $stmt->execute();

            return true;
        }catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;            
        }
    }
    //modifier un doctorant de la base de données

    public function modifierDoctorant($id,$nom,$intitule,$dates,$formation,$numero,$created_at){
        $conn = connectDB();
        try{
            // Vérifier si l'doctorant existe déjà
            $verifierExist = $conn->prepare("SELECT * FROM doctorant WHERE nom = :nom AND id != :id");
            $verifierExist->bindParam(':nom', $nom, PDO::PARAM_STR);
            $verifierExist->bindParam(':id', $id, PDO::PARAM_INT);
            $verifierExist->execute();
            $doctorant = $verifierExist->fetch(PDO::FETCH_ASSOC);
            if($doctorant){
                return false; // l'doctorant existe déjà
            }
            $id=htmlspecialchars(strip_tags($id));
            $nom=htmlspecialchars(strip_tags($nom));
            $intitule=htmlspecialchars(strip_tags($intitule));
            $dates=htmlspecialchars(strip_tags($dates));
            $formation=htmlspecialchars(strip_tags($formation));
            $numero=htmlspecialchars(strip_tags($numero));
            $created_at=htmlspecialchars(strip_tags($created_at));
            //modifier l'doctorant dans la base de données
            $stmt = $conn->prepare("UPDATE doctorant SET nom = :nom, intitule = :intitule, dates = :dates, formation = :formation, numero= :numero, created_at = :created_at  WHERE id =:id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
            $stmt->bindParam(':intitule', $intitule, PDO::PARAM_STR);
            $stmt->bindParam(':dates', $dates, PDO::PARAM_STR);
            $stmt->bindParam(':formation', $formation, PDO::PARAM_STR);
            $stmt->bindParam(':numero', $numero, PDO::PARAM_STR);
            $stmt->bindParam(':created_at', $created_at, PDO::PARAM_STR);
            $stmt->execute();

            return true;
        }catch (PDOException $e) {
            echo "Error: " . $e->getMessage();            
        }
    }

    //supprimer un doctorant de la base de données
    public function supprimerDoctorant($id){
        $conn = connectDB();
        try{
            $stmt = $conn->prepare("DELETE FROM doctorant WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            echo "arrive ici exe";
            //return true;
        }catch (PDOException $e) {
            echo "arrive ici faux";
            //return false;            
        }
    }
    // recuperer touts les doctorants de la base de données
    public function getdoctorants(){
        $conn = connectDB();
        try{
            $stmt = $conn->prepare("SELECT * FROM doctorant");
            $stmt->execute();
            $doctorants = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $doctorants;
        }catch (PDOException $e) {
            echo "Error: " . $e->getMessage();            
        }
    }
    //retourne un doctorant en fonction de son id
    // si l'doctorant n'existe pas, une exception est levée
    public function getDoctorantById($id){
        $conn = connectDB();
        try{
            $stmt = $conn->prepare("SELECT * FROM doctorant WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $doctorant = $stmt->fetch(PDO::FETCH_ASSOC);
            return $doctorant;
        }catch (PDOException $e) {
            echo "Error: " . $e->getMessage();            
        }
    }
}
?>