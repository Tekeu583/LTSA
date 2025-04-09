<?php

    require_once __DIR__ ."/../Models/Enseignant.php";
    require_once __DIR__ ."/../Models/Admin.php";

    class EnseignantController{
        // afficher la liste des enseignants
        public function afficherEnseignants(){
            $enseignant = new Enseignant();
            $enseignants =$enseignant->getEnseignants();
            require_once __DIR__."/../views/admin/enseignant.php";
        }
        // afficher en fonction de l'id de l'enseignant
        public function afficherEnseignant($id){
            session_start();
            if(!$_SESSION['nom'] || !$_SESSION['id']){
                header("Location:index.php");
            }
            $enseignants= new Enseignant(); 
            $enseignant = $enseignants->getEnseignantById($id);
            require __DIR__."/../views/admin/modifierEnseignant.php";
            
        }
        // afficher le formulaire d'ajout d'un enseignant
        public function ajoutEnseignant(){
            session_start();
            if(!$_SESSION['nom'] || !$_SESSION['id']){
                header("Location:index.php");
            }
            header("Location:views/admin/registerEnseignant.php");
        }
        //validation du formulaire d'ajout d'un enseignant
        // et ajout de l'enseignant à la base de données
        public function ajoutEnseignantValidation(){
            session_start();
            if(!$_SESSION['nom'] || !$_SESSION['id']){
                header("Location:index.php");
            }
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $error=[];
                if(!isset($_POST['nom']) || empty($_POST['nom'])){
                    $error[]="vous devez indiquez un nom d'enseignant";
                    require_once(__DIR__."/../views/admin/registerEnseignant.php");
                }
                if(!isset($_POST['grade']) || empty($_POST['grade'])){
                     $error[]="vous devez indiquez un grade d'enseignant";
                    require_once(__DIR__."/../views/admin/registerEnseignant.php");
                }
                if(!isset($_POST['fonction']) || empty($_POST['fonction'])){
                     $error[]="vous devez indiquez une fonction d'enseignant";
                    require_once(__DIR__."/../views/admin/registerEnseignant.php");
                }
                if(!isset($_POST['lieuTravail']) || empty($_POST['lieuTravail'])){
                     $error[]="vous devez indiquez un lieu de travail d'enseignant";
                    require_once(__DIR__."/../views/admin/registerEnseignant.php");
                }
                $admin= new Admin();
                $admin= $admin->getAdmins(); // recuperation d'un enseignant
                $enseignant= new Enseignant();
                $result=$enseignant->newEnseignant($_POST['nom'],$_POST['grade'],$_POST['fonction'],$_POST['lieuTravail'],$admin[0]['id']); //ajout d'un enseignant
                session_start();
                $_SESSION['alert']=[
                    "type"=>"success",
                    "msg"=>"Ajout realiser"
                ];
                if($result){
                    header("Location:index.php?page=enseignant");
                    
                }
                else{
                    session_start();
                    $_SESSION['alert']=[
                        "type"=>"error",
                        "msg"=>"Ajout echoue"
                    ];
                    $error[]="Ajout de l'enseignant echoué !";
                    require_once(__DIR__."/../views/admin/registerEnseignant.php");
                }
            }else{
                session_start();
                $_SESSION['alert']=[
                    "type"=>"error",
                    "msg"=>"Ajout echoue"
                ];
                require_once(__DIR__."/../views/admin/registerEnseignant.php");
            }
        }
        //supprimer un enseignant de la base de données en fonction de son id
        // et redirection vers la page d'enseignant
        public function suppressionEnseignant($id){
            session_start();
            if(!$_SESSION['nom'] || !$_SESSION['id']){
                header("Location:index.php");
            }
            $enseignant= new Enseignant();
            $result=$enseignant->supprimerEnseignant($id); //supression d'un enseignant
            if($result){
                $_SESSION['alert']=[
                    "type"=>"success",
                    "msg"=>"suppression realiser"
                ];
                // redirection vers la page d'enseignant  
                header("Location:index.php?page=enseignant");
            }else{
                $_SESSION['alert']=[
                    "type"=>"success",
                    "msg"=>"suppression echouer"
                ];
                $error[]="Erreur supprission echouer !";
                require_once __DIR__."/index.php?page=enseignant";
            }
            
        }
        // afficher le formulaire de modification d'un enseignant
        // en fonction de son id
        public function modificationEnseignant($id){
            $enseignant= new Enseignant();
            $enseignant= $enseignant->getEnseignantById($id); // recuperation d'un enseignant
            require_once __DIR__."/../views/admin/modifierEnseignant.php";
        }
        // validation du formulaire de modification d'un enseignant
        // et modification de l'enseignant dans la base de données
        public function modificationEnseignantValidation(){
            session_start();
            if(!$_SESSION['nom'] || !$_SESSION['id']){
                header("Location:index.php");
            }
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $error=[];
                if(!isset($_POST['nom']) || empty($_POST['nom'])){
                    $error[]="vous devez indiquez un nom d'enseignant";
                    require_once __DIR__."/../views/admin/modifierEnseignant.php";
                }
                if(!isset($_POST['grade']) || empty($_POST['grade'])){
                    $error[]="vous devez indiquez un grade d'enseignant";
                    require_once __DIR__."/../views/admin/modifierEnseignant.php";
                }
                if(!isset($_POST['fonction']) || empty($_POST['fonction'])){
                    $error[]="vous devez indiquez une fonction d'enseignant";
                    require_once __DIR__."/../views/admin/modifierEnseignant.php";
                }
                if(!isset($_POST['lieuTravail']) || empty($_POST['lieuTravail'])){
                    $error[]="vous devez indiquez un lieu de travail d'enseignant";
                    require_once __DIR__."/../views/admin/modifierEnseignant.php";
                }
                if(!isset($_POST['id']) || empty($_POST['id'])){
                    $error[]="vous devez indiquez un id d'enseignant";
                    require_once __DIR__."/../views/admin/modifierEnseignant.php";
                }
                $enseignant =new Enseignant();
                $enseignant->modifierEnseignant($_POST['id'],$_POST['nom'],$_POST['grade'],$_POST['fonction'],$_POST['lieuTravail'],$_POST['created_at']);
                $_SESSION['alert']=[
                    "type"=>"success",
                    "msg"=>"Modification realiser !"
                ];
                header("Location:index.php?page=enseignant");
            }else{ 
                session_start();
                $_SESSION['alert']=[
                    "type"=>"error",
                    "msg"=>"modification echouer !"
                ];
                $error[]="modification echouer !";
                require_once __DIR__."/../views/admin/modifierEnseignant.php";
            }

            
        }

        private function ajoutImage($file,$dir){
            if(!isset($file['name']) || empty($file['name'])){
                throw new Exception("vous devez indiquez une image");
            }
            if(!file_exists($dir)) mkdir($dir,0777);

            $extension=strtolower(pathinfo($file['name'],PATHINFO_EXTENSION));
            $random = rand(0,99999);
            $target_file= $dir.$random."_".$file['name'];
            
            if(!getimagesize($file["tmp_name"]))
                throw new Exception("le fichier n.est pas une image");
            if($extension!== "jpg" && $extension !== "jpeg" && $extension !== "png" && $extension !== "gif")
                throw new Exception("l'extension du fichier n'est pas reconnu");
            if(file_exists($target_file))
                throw new Exception("le ficher existe deja");
            if($file['size']>500000)
                throw new Exception("le fichier trop volumineux");
            if(!move_uploaded_file($file['tmp_name'],$target_file))
                throw new Exception("l'ajout de l'image n'a pas fonctionner");
            else return ($random."_".$file['name']);
        }
    }

?>