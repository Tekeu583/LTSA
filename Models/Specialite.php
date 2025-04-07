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


    public  function newspecialite ($name, $description, $id_admin) {
        $conn = connectDB();

        try {
            $stmt = $conn->prepare("INSERT INTO specialite (name, description, id_admin) VALUES (:name, :description, :id_admin)");
            $stmt->bindParam(':id_admin', $id_admin, PDO::PARAM_INT);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam('', $description, PDO::PARAM_STR);
            $stmt->execute();

            return null;
        }catch (PDOException $e) {
            echo "Error: " . $e->getMessage();            
        }
    }

    public function editspecialite ($id, $name, $description){
        $conn = connectDB();

        try {
            $stmt = $conn->prepare("UPDATE specialite SET name = :name, description = :description WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);
            $stmt->execute();

            return null;
        }catch (PDOException $e) {
            echo "Error: " . $e->getMessage();            
        }
    }
    public function deletespecialite ($id, $name){
        $conn = connectDB();

        try {
            $stmt = $conn->prepare("DELETE FROM specialite WHERE id = :id AND name = :name");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->execute();

            return null;
        }catch (PDOException $e) {
            echo "Error: " . $e->getMessage();            
        }
    }

    public static function getAllSpecialites() {
        $conn = connectDB();
        try {
            $stmt = $conn->prepare("SELECT * FROM specialite ORDER BY id DESC");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();            
        }
    }
    public static function getspecialite($id) {
        $conn = connectDB();
        try {
            $stmt = $conn->prepare("SELECT * FROM specialite WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();            
        }
    }

    public static function getspecialite_id($id) {
        $conn = connectDB();
        try {
            $stmt = $conn->prepare("SELECT * FROM specialite WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();            
        }
    }

    public function newcourse($codeEC, $intituleEC, $coef, $cm, $td, $tp, $tpe, $ccts, $specialite_id) {
        $conn = connectDB();
        try {
            $stmt = $conn->prepare("INSERT INTO cours (codeEC, intituleEC, coef, cm, td, tp, tpe, ccts, specialite_id) VALUES (:codeEC, :intituleEC, :coef, :cm, :td, :tp, :tpe, :ccts, :specialite_id)");
            $stmt->bindParam(':codeEC', $codeEC, PDO::PARAM_STR);
            $stmt->bindParam(':intituleEC', $intituleEC, PDO::PARAM_STR);
            $stmt->bindParam(':coef', $coef, PDO::PARAM_STR);   
            $stmt->bindParam(':cm', $cm, PDO::PARAM_STR);
            $stmt->bindParam(':td', $td, PDO::PARAM_STR);
            $stmt->bindParam(':tp', $tp, PDO::PARAM_STR);
            $stmt->bindParam(':tpe', $tpe, PDO::PARAM_STR);
            $stmt->bindParam(':ccts', $ccts, PDO::PARAM_STR);
            $stmt->bindParam(':specialite_id', $specialite_id, PDO::PARAM_INT);
            $stmt->execute();
            return null;
        }catch (PDOException $e) {
            echo "Error: " . $e->getMessage();            
        }
    }
    public function editcourse($codeEC, $intituleEC, $coef, $cm, $tp, $tpe, $ccts, $specialite_id) {
        $conn = connectDB();
        try {
            $stmt = $conn->prepare("UPDATE cours SET codeEC = :codeEC, intituleEC = :intituleEC, coef = :coef, cm = :cm, tp = :tp, tpe = :tpe, ccts = :ccts WHERE specialite_id = :specialite_id");
            $stmt->bindParam(':codeEC', $codeEC, PDO::PARAM_STR);
            $stmt->bindParam(':intituleEC', $intituleEC, PDO::PARAM_STR);
            $stmt->bindParam(':coef', $coef, PDO::PARAM_STR);   
            $stmt->bindParam(':cm', $cm, PDO::PARAM_STR);
            $stmt->bindParam(':tp', $tp, PDO::PARAM_STR);
            $stmt->bindParam(':tpe', $tpe, PDO::PARAM_STR);
            $stmt->bindParam(':ccts', $ccts, PDO::PARAM_STR);
            $stmt->bindParam(':specialite_id', $specialite_id, PDO::PARAM_INT);
            $stmt->execute();
            return null;
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