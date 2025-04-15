<?php

    require_once __DIR__ ."/../Models/Doctorant.php";

    class DoctorantController{
        // afficher la liste des Doctorant
        public function afficherDoctorants(){
            $doctorant = new Doctorant();
            $doctorants =$doctorant->getDoctorants();
            require_once __DIR__."/../views/admin/doctorant.php";
        }
        // afficher en dates de l'id de l'Doctorant
        public function afficherDoctorant($id){
            session_start();
            if(!$_SESSION['nom'] || !$_SESSION['id']){
                header("Location:index.php?page=accueil");
            }
            $doctorants= new Doctorant(); 
            $doctorant = $doctorants->getDoctorantById($id);
            require __DIR__."/../views/admin/modifierDoctorant.php";
            
        }
        // afficher le formulaire d'ajout d'un Doctorant
        public function ajoutDoctorant(){
            session_start();
            if(!$_SESSION['nom'] || !$_SESSION['id']){
                header("Location:index.php?page=accueil");
            }
            header("Location:views/admin/registerDoctorant.php");
        }
        //validation du formulaire d'ajout d'un Doctorant
        // et ajout de l'Doctorant à la base de données
        public function ajoutDoctorantValidation(){
            session_start();
            if(!$_SESSION['nom'] || !$_SESSION['id']){
                header("Location:index.php?page=accueil");
            }
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $error=[];
                if(!isset($_POST['nom']) || empty($_POST['nom'])){
                    $error[]="vous devez indiquez un nom d'Doctorant";
                    require_once(__DIR__."/../views/admin/registerDoctorant.php");
                }
                if(!isset($_POST['intitule']) || empty($_POST['intitule'])){
                     $error[]="vous devez indiquez un intitule d'Doctorant";
                    require_once(__DIR__."/../views/admin/registerDoctorant.php");
                }
                if(!isset($_POST['dates']) || empty($_POST['dates'])){
                     $error[]="vous devez indiquez une dates d'Doctorant";
                    require_once(__DIR__."/../views/admin/registerDoctorant.php");
                }
                if(!isset($_POST['formation']) || empty($_POST['formation'])){
                     $error[]="vous devez indiquez un lieu de travail d'Doctorant";
                    require_once(__DIR__."/../views/admin/registerDoctorant.php");
                }
                if(!isset($_POST['numero']) || empty($_POST['numero'])){
                    $error[]="vous devez indiquez un numero d'ordre du fichier de these";
                   require_once(__DIR__."/../views/admin/registerDoctorant.php");
               }
                // recuperation d'un Doctorant
                $doctorant= new Doctorant();
                $result=$doctorant->newDoctorant($_POST['nom'],$_POST['intitule'],$_POST['dates'],$_POST['formation'],$_POST['numero'],$_SESSION['id']); //ajout d'un Doctorant
                $_SESSION['alert']=[
                    "type"=>"success",
                    "msg"=>"Ajout realiser"
                ];
                if($result){
                    header("Location:index.php?page=doctorant");
                }
                else{
                    $_SESSION['alert']=[
                        "type"=>"error",
                        "msg"=>"Ajout echoue"
                    ];
                    $error[]="Ajout du doctorant echoué !";
                    require_once(__DIR__."/../views/admin/registerDoctorant.php");
                }
            }else{
                $_SESSION['alert']=[
                    "type"=>"error",
                    "msg"=>"Ajout echoue"
                ];
                require_once(__DIR__."/../views/admin/registerDoctorant.php");
            }
        }
        //supprimer un Doctorant de la base de données en dates de son id
        // et redirection vers la page d'Doctorant
        public function suppressionDoctorant($id){
            $doctorant= new Doctorant();
            $result=$doctorant->supprimerDoctorant($id); //supression d'un Doctorant
            if($result){
                $_SESSION['alert']=[
                    "type"=>"success",
                    "msg"=>"suppression realiser"
                ];
                // redirection vers la page d'Doctorant  
                header("Location:index.php?page=doctorant");
            }else{
                $_SESSION['alert']=[
                    "type"=>"success",
                    "msg"=>"suppression echouer"
                ];
                $error[]="Erreur supprission echouer !";
                require_once __DIR__."/index.php?page=doctorant";
            }
        }


        // afficher le formulaire de modification d'un Doctorant
        // en dates de son id
        public function modificationDoctorant($id){
            $doctorant= new Doctorant();
            $doctorant= $doctorant->getDoctorantById($id); // recuperation d'un Doctorant
            require_once __DIR__."/../views/admin/modifierDoctorant.php";
        }


        // validation du formulaire de modification d'un Doctorant
        // et modification de l'Doctorant dans la base de données
        public function modificationDoctorantValidation(){
            session_start();
            if(!$_SESSION['nom'] || !$_SESSION['id']){
                header("Location:index.php?page=accueil");
            }
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $error=[];
                if(!isset($_POST['nom']) || empty($_POST['nom'])){
                    $error[]="vous devez indiquez un nom du Doctorant";
                    require_once __DIR__."/../views/admin/modifierDoctorant.php";
                }
                if(!isset($_POST['intitule']) || empty($_POST['intitule'])){
                    $error[]="vous devez indiquez un intitule de la these Doctorant";
                    require_once __DIR__."/../views/admin/modifierDoctorant.php";
                }
                if(!isset($_POST['dates']) || empty($_POST['dates'])){
                    $error[]="vous devez indiquez une dates de soutenance";
                    require_once __DIR__."/../views/admin/modifierDoctorant.php";
                }
                if(!isset($_POST['formation']) || empty($_POST['formation'])){
                    $error[]="vous devez indiquez la formation du doctorant";
                    require_once __DIR__."/../views/admin/modifierDoctorant.php";
                }
                if(!isset($_POST['id']) || empty($_POST['id'])){
                    $error[]="vous devez indiquez un id du doctorant";
                    require_once __DIR__."/../views/admin/modifierDoctorant.php";
                }
                if(!isset($_POST['numero']) || empty($_POST['numero'])){
                    $error[]="vous devez indiquez un id du doctorant";
                    require_once __DIR__."/../views/admin/modifierDoctorant.php";
                }
                
                $doctorant =new Doctorant();
                $doctorant->modifierDoctorant($_POST['id'],$_POST['nom'],$_POST['intitule'],$_POST['dates'],$_POST['formation'],$_POST['numero'],$_POST['created_at']);
                
                if($doctorant){
                    $_SESSION['alert']=[
                        "type"=>"success",
                        "msg"=>"Modification realiser !"
                    ];
                    header("Location:index.php?page=doctorant");
                }else{
                    $_SESSION['alert']=[
                        "type"=>"error",
                        "msg"=>"Modification echouer !"
                    ];
                    $error[]="Erreur de modification !";
                    require_once __DIR__."/../views/admin/modifierDoctorant.php";
                }
            }else{ 
                session_start();
                $_SESSION['alert']=[
                    "type"=>"error",
                    "msg"=>"modification echouer !"
                ];
                $error[]="modification echouer Methode incorrecte !";
                require_once __DIR__."/../views/admin/modifierDoctorant.php";
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
                throw new Exception("l'ajout de l'image n'a pas datesner");
            else return ($random."_".$file['name']);
        }
    }

?>