<?php

    require_once __DIR__ . '/../config/config.php';
    require_once __DIR__ . '/../vendor/autoload.php'; // Assurez-vous d'avoir installé PHPMailer via Composer
    require_once __DIR__ ."/../Models/Admin.php";
    require_once __DIR__ . "/../Models/MailService.php";
    class AdminController{
        // afficher la liste des administrateurs
        public function showAdmin(){
            $admin = new Admin();
            $admins = $admin->getAdmins();
            if($admins){
                require_once __DIR__ .'/../views/admin/admin.php';
                
            }else{
                session_start();
                $_SESSION['alert']=[
                    "type"=>"error",
                    "msg"=>"echec lors de la recuperation des donnees"
                ];
                echo " arrive ici echec";
                header("Location:/../views/admin/admin.php");
            }
        }
        public function showAdminById($id){
            $admin = new Admin();
            $admin = $admin->getAdminById($id);
            require_once __DIR__ .'/../views/admin/admin.php';
        }
        public function deleteAdmin($id){
            session_start();
            // if(!$_SESSION['nom'] || !$_SESSION['id']){
            //     header("Location:index.php?page=accueil");
            // }
            $error=[];
            $success=[];
            $admin = new Admin();
            $admins=$admin->supprimerAdmin($id);
            if($admins){
                $_SESSION['alert']=[
                    "type"=>"success",
                    "msg"=>"suppression realiser"
                ];
                header("Location:index.php?page=admin");

            }else{
                session_start();
                $_SESSION['alert']=[
                    "type"=>"error",
                    "msg"=>"suppresion echouer"
                ];
                $error[]="Suppression echoué !";
                header("Location:index.php?page=admin");
            }
            
        }
        public function addAdmin(){
            header("Location:views/admin/registerAdmin.php");
        }
        public function ajoutAdminValidation(){
            session_start();
            // if(!$_SESSION['nom'] || !$_SESSION['id']){
            //     header("Location:index.php?page=accueil");
            // }
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $error=[];
                if(!isset($_POST['nom']) || empty($_POST['nom'])){
                    $error[]="vous devez indiquez un nom";
                    require_once(__DIR__."/../views/admin/registerAdmin.php");
                }
                if(!isset($_POST['email']) || empty($_POST['email'])){
                    $error[]="vous devez indiquez un email";
                    require_once(__DIR__."/../views/admin/registerAdmin.php");
                }
                if(!isset($_POST['motDePasse']) || empty($_POST['motDePasse'])){
                    $error[]="vous devez indiquez un mot de passe";
                    require_once(__DIR__."/../views/admin/registerAdmin.php");
                }
                $nom= htmlspecialchars(strip_tags($_POST['nom']));
                $email= htmlspecialchars(strip_tags($_POST['email']));
                $motDePasse= htmlspecialchars(strip_tags($_POST['motDePasse']));
                $confirmPassword= htmlspecialchars(strip_tags($_POST['confirmPassword']));
                if(strlen($motDePasse)<8){
                    $error[]="Les mots de passe ne correspondent pas.";
                    require_once(__DIR__."/../views/admin/registerAdmin.php");
                }
                if($motDePasse !=$confirmPassword){
                    $error[]="Les mots de passe ne correspondent pas.";
                    require_once(__DIR__."/../views/admin/registerAdmin.php");
                }
                if(empty($error)){
                    $motDePasseHash=password_hash($motDePasse,PASSWORD_DEFAULT);
                    $admin= new Admin();
                    $result=$admin->newAdmin($nom,$email,$motDePasseHash);
                    if($result){
                        session_start();
                        $_SESSION['alert']=[
                            "type"=>"success",
                            "msg"=>"Ajout realiser"
                        ];
                        header("Location:index.php?page=admin");
                    }else{
                        $error[]="Erreur lors de l'ajout de l'administrateur.";
                        require_once(__DIR__."/../views/admin/registerAdmin.php");
                    }
                }
                require_once __DIR__.("/../views/admin/registerAdmin.php");
            }else{
                session_start();
                $_SESSION['alert']=[
                    "type"=>"error",
                    "msg"=>"Ajout echoue"
                ];
                $error[]="ajout echoué";
                require_once(__DIR__."/../views/admin/registerAdmin.php");
            }
        }
        public function modificationAdmin($id){
            $admin= new Admin();
            $admins= $admin->getAdminById($id); // recuperation d'un enseignant
            
            require_once __DIR__."/../views/admin/modifierAdmin.php";
        }
        public function validerModificationAdmin(){
            session_start();
            // if(!$_SESSION['nom'] || !$_SESSION['id']){
            //     header("Location:index.php?page=accueil");
            // }
            if ($_SERVER['REQUEST_METHOD'] === 'POST'){
                $error=[];
                if(!isset($_POST['id']) || empty($_POST['id'])){
                    $error[]="vous devez indiquez un identifiant";
                    require_once __DIR__ . '/index.php?page=admin';
                }
                if(!isset($_POST['nom']) || empty($_POST['nom'])){
                    $error[]="vous devez indiquez un nom ";
                    require_once __DIR__ . '/index.php?page=admin';
                }
                if(!isset($_POST['email']) || empty($_POST['email'])){
                    $error[]="vous devez indiquez un email";
                    require_once __DIR__ . '/index.php?page=admin';
                }
                if(!isset($_POST['motDePasse']) || empty($_POST['motDePasse'])){
                    $error[]="vous devez indiquez un mot de passe";
                    require_once __DIR__ . '/index.php?page=admin';
                }
                $id= htmlspecialchars(strip_tags($_POST['id']));
                $nom= htmlspecialchars(strip_tags($_POST['nom']));
                $email= htmlspecialchars(strip_tags($_POST['email']));
                $admin= new Admin();
                $result=$admin->modifierAdmin($id,$nom,$email);
                if($result){
                    session_start();
                    $_SESSION['alert']=[
                        "type"=>"success",
                        "msg"=>"modification realiser"
                    ];
                    header("Location:index.php?page=admin");
                }else{
                    session_start();
                    $_SESSION['alert']=[
                        "type"=>"error",
                        "msg"=>"modification echouer !"
                    ];
                    $error[]="modification echouer !";
                    require_once __DIR__ . '/index.php?page=admin';
                }
            }else{
                session_start();
                $_SESSION['alert']=[
                    "type"=>"error",
                    "msg"=>"modification echouer !"
                ];
                $error[]="Erreur de method d'envoie !";
                require_once __DIR__ . '/index.php?page=admin';
            }
        
        }
        public function showLoginForm() {
            // session_start();
            $_SESSION['token_csrf'] = bin2hex(random_bytes(32));
            // Afficher le formulaire de connexion
            require_once __DIR__ . '/../views/login.php';
        }
       
        //valider la connexion
        public function validerlogin() {
            // Récupérer les données POST
            session_start();
            if ($_SERVER['REQUEST_METHOD'] === 'POST'){

                $error=[];
                $csrfToken = $_POST['token'] ?? '';
                // Vérifier si l'email et le mot de passe sont présents
                if(!isset($_POST['email']) || empty($_POST['email'])){
                    $error[]="vous devez indiquez un email";
                    require_once __DIR__ . '/../views/login.php';
                }
                if(!isset($_POST['motDePasse']) || empty($_POST['motDePasse'])){
                    $error[]="vous devez indiquez un mot de passe ";
                    require_once __DIR__ . '/../views/login.php';
                }
                // Vérifier le token CSRF
                if(!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token_csrf']) {
                    $error[]="Token CSRF invalide";
                    require_once __DIR__ . '/../views/login.php';
                }
                $email= $_POST['email'];
                $motDePasse= $_POST['motDePasse'];
                $token= htmlspecialchars(strip_tags($_POST['token']));
                if(empty($error)){
                    // Vérifier si l'email est valide
                    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                        $error[]="Email invalide";
                        require_once __DIR__ . '/../views/login.php';
                    }else{
                        $admin = new Admin();
                        $admins = $admin->getAdminByEmail($email);
                        // Vérifier si l'administrateur existe
                        if(!$admins) {
                            $error[]="Email incorrect";
                            echo "arrive non 0";
                            require_once __DIR__ . '/../views/login.php';
                        }else{
                            try{
                                $result=$admin->connectAdmin($email,$motDePasse);
                                if(!$result) {
                                    $error[]="Erreur de connexion faillie :mot de passe incorrect";
                                    require_once __DIR__ . '/../views/login.php';
                                }else{
                                    // stoker le token jwt dans la base de données
                                    $stokerToken=$admin->stockToken($admins['id'],$token);
                                    if(!$stokerToken) {
                                        $error[]="Erreur lors de la génération du token";
                                        require_once __DIR__ . '/../views/login.php';
                                    }else{
                                        //session_start();
                                        $_SESSION['id']=$admins['id'];
                                        $_SESSION['nom']=$admins['nom'];
                                        $_SESSION['email']=$admins['email'];
                                        $_SESSION['token']=$token;
                                        // Redirection vers la page d'accueil de l'administrateur
                                        header("Location:index.php?page=doctorant");
                                    }
                                 
                                    //require_once __DIR__ . '/../views/login.php';
                            }
                        }catch(Exception $e) {
                            $error[]="Erreur de connexion  : " . $e->getMessage();
                            //require_once __DIR__ . '/../views/login.php';
                            }  
                            
                        }  
                    }
               
                }
            }
        }
        // deconnexion d'un administrateur
        public function logout() {
            session_start();
            // Vérifier si l'utilisateur est connecté
            if (!isset($_SESSION['id'])) {
                header("Location:index.php?page=accueil");
                exit;
            }
            // Déconnexion de l'administrateur
            $admin = new Admin();
            $result=$admin->disconnectAdmin();
            if ($result) {
                session_unset(); // Détruire toutes les variables de session
                $_SESSION['deconnexion'] = "Vous avez été déconnecté avec succès";
                header('Location:'.BASE_URL.'index.php');
                exit;
            }
            
        }
        // formulaire de reinitialisation du mot de passe
        public function reset(){
            require_once __DIR__.("/../views/reinitialiserpassword.php");
        }
        public function forgotPassword() {
            // Récupérer les données POST
            
            if ($_SERVER['REQUEST_METHOD'] === 'POST'){
                $error=[];
                $success=[];
                // Vérifier si l'email est présent
                if(!isset($_POST['email']) || empty($_POST['email'])){
                    $error[]="vous devez indiquez un email"; 
                    require_once __DIR__.("/../views/reinitialiserpassword.php");
                }
                // Vérifier si l'administrateur existe
                $admin = new Admin();
                $email= htmlspecialchars(strip_tags($_POST['email']));
                $admins = $admin->getAdminByEmail($email);
                if(!$admins) {
                    $error[]="Email incorrect";
                    require_once __DIR__.("/../views/reinitialiserpassword.php");
                }
                
                // Générer un token unique
                $token = bin2hex(random_bytes(32));
                
                // Stocker le token dans la base de données
                if($admin->stockToken($admins['id'],$token)) {
                    // URL de réinitialisation
                    $resetUrl = BASE_URL. "index.php?page=login/nouveauPassword/" . $token;
                    
                    // Envoyer l'email
                    $subject = 'Réinitialisation de votre mot de passe';
                    $body = "Bonjour {$admins['nom']},<br><br>";
                    $body .= "Vous avez demandé la réinitialisation de votre mot de passe. ";
                    $body .= "Veuillez cliquer sur le lien ci-dessous pour réinitialiser votre mot de passe :<br><br>";
                    $body .= "<a href=\"{$resetUrl}\">{$resetUrl}</a><br><br>";
                    $body .= "Ce lien expirera dans 1 heure.<br><br>";
                    $body .= "Si vous n'avez pas demandé cette réinitialisation, veuillez ignorer cet email.";
                    
                    $mails= new MailService();
                    $resultat=$mails->sendEmail($admins['email'], $subject, $body);
                    // $resultat=Mail($admins['email'], $subject, $body);
                    if($resultat) {
                        $success[]="Email de réinitialisation envoyé";
                        require_once __DIR__.("/../views/reinitialiserpassword.php");
                    } else {
                        $error[]="Erreur lors de l'envoi de l'email: $resultat";
                        require_once __DIR__.("/../views/reinitialiserpassword.php");
                    }
                } else {
                    $error[]="Erreur lors de la génération du token";
                    require_once __DIR__.("/../views/reinitialiserpassword.php");
                }
            }
        }
        //redirection vers la page de reinitialisation du mot de passe
        public function newpassword($tokens){
            $token=$tokens;
            require_once __DIR__."/../views/newPassword.php";
        }
        // Méthode de réinitialisation de mot de passe
    public function resetPassword() {
        // Récupérer les données POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $error=[];
            // Vérifier si toutes les données requises sont présentes
            if(!isset($_POST['token']) || !isset($_POST['motDePasse'])) {
                $error[]="Token et nouveau mot de passe requis";
                require_once __DIR__.("/../views/login.php");
            }
            $token= htmlspecialchars(strip_tags($_POST['token']));
            $motDePasse=htmlspecialchars(strip_tags($_POST['motDePasse']));
            $motDePasse=password_hash($motDePasse,PASSWORD_DEFAULT);
            $admin = new Admin();
            $result=$admin->isValidResetToken($token);
            //Vérifier si le token est valide
            if(!$result) {
                $error[]="Token invalide ou expiré";
                require_once __DIR__.("/../views/login.php");
            }else{
                $test=$admin->modifierMotDePasse($result['id'],$motDePasse);
                if($test) {
                    $error[]="Mot de passe réinitialisé avec succès";
                    require_once __DIR__.("/../views/login.php");
                }else{
                    $error[]="Erreur lors de la réinitialisation du mot de passe";
                    require_once __DIR__.("/../views/login.php");
                }

            }

            
        }
    }
}


?>