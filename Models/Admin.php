<?php

class Admin{
    private $id;
    private $nom;
    private $email;
    private $motDePasse;
    private $confirmer;
    private $token;

    //creation d'un administrateur
    public function newAdmin($nom,$email,$motDePasse){
        $conn = connectDB();
        try{
            $email=trim($email);
            // Vérifier si l'email existe déjà
            $verifierExist = $conn->prepare("SELECT * FROM admin WHERE email = :email");
            $verifierExist->bindParam(':email', $email, PDO::PARAM_STR);
            $verifierExist->execute();
            $admin = $verifierExist->fetch(PDO::FETCH_ASSOC);
            // Vérifier si l'email existe déjà
            if($admin){
                return false; // l'email existe déjà
            }else{         
                //insérer l'administrateur dans la base de données
                $nom=htmlspecialchars(strip_tags($nom));
                $email=htmlspecialchars(strip_tags($email));
                $motDePasse=htmlspecialchars(strip_tags($motDePasse));
                //hacher le mot de passe
                $motDePasse = password_hash($motDePasse, PASSWORD_DEFAULT);
                $stmt= $conn->prepare("INSERT INTO admin (nom, email, motDePasse,created_at) VALUES (:nom, :email, :motDePasse, NOW())");
                $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
                $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                $stmt->bindParam(':motDePasse', $motDePasse, PDO::PARAM_STR);
                $stmt->execute();
                return true; 
            }   
        }catch (PDOException $e) {
            return false;            
        }
    }
    //modifier un administrateur de la base de données
    public function modifierAdmin($id,$nom,$email){
        $conn = connectDB();
        try{
            $email=trim($email);
            // Vérifier si l'email existe déjà
            $verifierExist = $conn->prepare("SELECT * FROM admin WHERE email = :email AND id != :id");
            $verifierExist->bindParam(':email', $email, PDO::PARAM_STR);
            $verifierExist->bindParam(':id', $id, PDO::PARAM_INT);
            $verifierExist->execute();
            $admin = $verifierExist->fetch(PDO::FETCH_ASSOC);
            // Vérifier si l'email existe déjà
            if($admin){
                return false; // l'email existe déjà
            }
            $nom=htmlspecialchars(strip_tags($nom));
            $email=htmlspecialchars(strip_tags($email));
            //insérer l'administrateur dans la base de données
            $stmt= $conn->prepare("UPDATE admin SET nom = :nom, email = :email  WHERE id =:id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            return true;     
        }catch (PDOException $e) {
            return false;            
        }
    }
    //supprimer un administrateur de la base de données
    public function supprimerAdmin($id){
        $conn = connectDB();
        try{
            $stmt= $conn->prepare("DELETE FROM admin WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return true;     
        }catch (PDOException $e) {
            return false;            
        }
    }
    //retourne l'id de l'administrateur
    public function getId(){
        return $this->id;
    }
    //retourne le nom de l'administrateur
    public function getNom(){
        return $this->nom;
    }
    //retourne l'email de l'administrateur
    public function getEmail(){
        return $this->email;
    }
    //retourne un administrateur en fonction de son id
    public function getAdminById($id){
        $conn = connectDB();
        try{
            $stmt= $conn->prepare("SELECT * FROM admin WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            if($stmt->rowCount() === 1){
                $admin = $stmt->fetch(PDO::FETCH_ASSOC);
                return $admin;
            }
            return null;
        }catch (PDOException $e) {
            return null;            
        }
    }
    //retourne tous les administrateurs de la base de données
    public function getAdmins(){
        $conn = connectDB();
        try{
            $stmt= $conn->prepare("SELECT * FROM admin");
            $stmt->execute();
            if($stmt->rowCount() > 0){
                $admins = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $admins;
            }
            return [];     
        }catch (PDOException $e) {
            return [];                     
        }
    }
    //connection d'un administrateur
    public function connectAdmin($email,$motDePasse){
        $conn = connectDB();
        try{
            $email=trim($email);
            $stmt= $conn->prepare("SELECT * FROM admin WHERE email = :email limit 1");
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            if($stmt->rowCount() === 1){
                $admin = $stmt->fetch(PDO::FETCH_ASSOC);
                // Vérification du mot de passe
                if (password_verify($motDePasse, $admin['motDePasse'])) {
                    $this->id = $admin['id'];
                    $this->nom = $admin['nom'];
                    $this->email = $admin['email'];
                    return true;
                }
                return false;
            }
            return false;
        }catch (PDOException $e) {
            print($e-> getMessage());            
        }
    }
    //deconnection d'un administrateur
    public function disconnectAdmin(){
        session_start();
        session_destroy();
        return true;
    }
    //modifier le mot de passe d'un administrateur
    public function modifierMotDePasse($id,$motDePasse){
        $conn = connectDB();
        try{
            //hacher le mot de passe
            $stmt= $conn->prepare("UPDATE admin SET motDePasse = :motDePasse,token=NULL  WHERE id =:id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':motDePasse', $motDePasse, PDO::PARAM_STR);
            $stmt->execute();
            return true;     
        }catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    // Trouver un administrateur par email
    public function getAdminByEmail($email) {
        $conn = connectDB();
        try{
            $email=trim($email);
            $stmt = $conn->prepare("SELECT * FROM admin WHERE email = :email");
            $email = htmlspecialchars(strip_tags($email));
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            if($stmt->rowCount() === 1){
                $admin = $stmt->fetch(PDO::FETCH_ASSOC);
                return $admin;
            }
            return null;
        }catch (PDOException $e) {
            return null;            
        }
    }
    //stoker le token dans la base de donnees
    public function stockToken($id,$token)
    {
        $conn= connectDB();
        try{
            $id=htmlspecialchars(strip_tags($id));
            $token= htmlspecialchars(strip_tags($token));
             // Vérifier si l'administrateur existe
             $stmt = $conn->prepare("SELECT * FROM admin WHERE id = :id");
             $stmt->bindParam(':id', $id, PDO::PARAM_INT);
             $stmt->execute();
             if($stmt->rowCount() === 0){
                 return false; // l'administrateur n'existe pas
             }
             // Mettre à jour le token dans la base de données
             $stmt = $conn->prepare("UPDATE admin SET token = :token WHERE id = :id");
             $stmt->bindParam(':token', $token, PDO::PARAM_STR);
             $stmt->bindParam(':id', $id, PDO::PARAM_INT);
             $stmt->execute();
             return true;
        }catch(PDOException $e) {
            return false;            
        }
    }
    //verifier la validiter du token
    public function isValidResetToken($token){
        $conn= connectDB();
        
        try{
            $token= htmlspecialchars(strip_tags($token));
            $stmt = $conn->prepare("SELECT * FROM admin WHERE token = :token LIMIT 1");
             $stmt->bindParam(':token', $token, PDO::PARAM_STR);
             $stmt->execute();
             if($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                
                $this->id = $row['id'];
                $this->nom = $row['nom'];
                $this->email = $row['email'];
                $this->motDePasse = $row['motDePasse'];  
                return $row;
            }
        }catch(PDOException $e){
            return false;
        }

    }
}
?>