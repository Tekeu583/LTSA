<?php
require_once(__DIR__ . "/../config/bdltsa.php");

class Message{
    // attributs de la classe Message
    private $id;
    private $nom;
    private $email;
    private $objet;
    private $message;
    private $created_at;

    // les getteurs et nsetteur de la classe Message
    public function getID(){
        return $this->id;
    }
    public function getNom(){
        return $this->nom;
    }
    public function getEmail(){
        return $this->email;
    }
    public function getObjet(){
        return $this->objet;
    }
    public function getMessage(){
        return $this->message;
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
    public function setEmail($email){
        $this->email = $email;
    }
    public function setObjet($objet){
        $this->objet = $objet;
    }
    public function setMessage($message){
        $this->message = $message;
    }
    public function setCreated_at($created_at){
        $this->created_at = $created_at;
    }
    // ajouter un message à la base de données
    // et à la liste des messages
    public function newMessage($nom,$email,$objet,$message){
        $conn = connectDB();
        try{
            $nom=htmlspecialchars(strip_tags($nom));
            $email=htmlspecialchars(strip_tags($email));
            $objet=htmlspecialchars(strip_tags($objet));
            $message=htmlspecialchars(strip_tags($message));
            $created_at=date("Y-m-d H:i:s");
            $stmt = $conn->prepare("INSERT INTO messages (nom,email,objet,message,created_at) VALUES (:nom,:email,:objet,:message,:created_at)");
            $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':objet', $objet, PDO::PARAM_STR);
            $stmt->bindParam(':message', $message, PDO::PARAM_STR);
            $stmt->bindParam(':created_at', $created_at, PDO::PARAM_STR);
            if($stmt->execute()){
                return true;
            }else{
                return false;
            }
        }catch(PDOException $e){
            return false;
        }
    }
    // afficher tous les messages de la base de données
    public function getMessages(){
        $conn = connectDB();
        try{
            $stmt = $conn->prepare("SELECT * FROM messages ORDER BY created_at DESC");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            echo "Erreur: " . $e->getMessage();
        }
    }
    // afficher un message de la base de données
    public function getMessageById($id){
        $conn = connectDB();
        try{
            $stmt = $conn->prepare("SELECT * FROM messages WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            echo "Erreur: " . $e->getMessage();
        }
    }
    
    //repondre au message en modifiant la statue du message en fonction de l'identifiant
    public function repondreMessages($id){
        $conn = connectDB();
        try{
            // verifier si l'id existe
            $stmt = $conn->prepare("SELECT * FROM messages WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $message = $stmt->fetch(PDO::FETCH_ASSOC);
            if(!$message){
                return false;
            }
            $stmt = $conn->prepare("UPDATE messages SET statut = 'repondu' WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            if($stmt->execute()){
                return true;
            }else{
                return false;
            }
        }catch(PDOException $e){
            return false;
        }
    }











}
?>