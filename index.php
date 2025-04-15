<?php
session_start();
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
require_once(__DIR__."/config/config.php");
require_once(__DIR__."/controller/EnseignantController.php");
require_once(__DIR__."/controller/DoctorantController.php");
require_once(__DIR__."/controller/MessagesController.php");
require_once(__DIR__."/Models/Admin.php");
require_once(__DIR__."/controller/AdminController.php");
require_once  "controller/SpecialiteController.php";

$enseignantController = new EnseignantController;
$adminController= new AdminController;
$doctorantController = new DoctorantController;
$messagesController = new MessagesController;
$request = $_SERVER['REQUEST_URI'];

$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); // Nettoyage de l'URL
$action = $_POST['action'] ?? $_GET['action'] ?? ''; // Gère GET et POST
define('BASE_URL', 'http://localhost/projet ltsa/ltsa/');
function getIntParam(string $key, int $default = 0) {
    return isset($_GET[$key]) ? $_GET[$key] : $default; 
}

function redirect(string $location, int $statusCode = 302){
    header("Location:$location", true, $statusCode);
    exit;
}


    $spcon = new SpecialiteController();
if(empty($_GET['page'])){
    header("location:index.php?page=accueil");
}else{
    $url= explode("/",filter_var($_GET['page']),FILTER_SANITIZE_URL);
    switch($url[0]){
        case "enseignant" : 
        if(empty($url[1])){
            $enseignantController->afficherEnseignants();
        }else if($url[1] === "l"){
            $enseignantController->afficherEnseignant($url[2]);
        }
        else if($url[1] === "a"){
            $enseignantController->ajoutEnseignant();
        }
        else if($url[1] === "m"){
            $enseignantController->modificationEnseignant($url[2]);           
        }else if($url[1] === "s"){
            $enseignantController->suppressionEnseignant($url[2]);
        }else if($url[1] === "register"){
            $enseignantController->ajoutEnseignantValidation();
        }else if($url[1] === "update"){
            $enseignantController->modificationEnseignantValidation();
        }
        break;
        case "doctorant" : 
            if(empty($url[1])){
                $doctorantController->afficherDoctorants();
            }else if($url[1] === "l"){
                $doctorantController->afficherDoctorant($url[2]);
            }
            else if($url[1] === "a"){
                $doctorantController->ajoutDoctorant();
            }
            else if($url[1] === "m"){
                $doctorantController->modificationDoctorant($url[2]);           
            }else if($url[1] === "s"){
                $doctorantController->suppressionDoctorant($url[2]);
            }else if($url[1] === "register"){
                $doctorantController->ajoutDoctorantValidation();
            }else if($url[1] === "update"){
                $doctorantController->modificationDoctorantValidation();
            }
            break;
        case "admin":
            if(empty($url[1])){
                $adminController->showAdmin();
            }else if($url[1] === "l"){
                $adminController->showAdminById($url[2]);
            }
            else if($url[1] === "a"){
                $adminController->addAdmin();
            }
            else if($url[1] === "m"){
                $adminController->modificationAdmin($url[2]);
            }else if($url[1] === "register"){
                $adminController->ajoutAdminValidation();
            }else if($url[1] === "update"){
                $adminController->validerModificationAdmin();
            }else if($url[1] === "s"){
                $adminController->deleteAdmin($url[2]);
            }
            break;

        case "login":
            if(empty($url[1])){
                $adminController->showLoginForm();
            }else if($url[1] === "conn"){
                $adminController->validerlogin();
            }
            else if($url[1] === "reset"){
                $adminController->reset();
            }
            else if($url[1] === "sendMail"){
                $adminController->forgotPassword();
            }else if($url[1] === "newpassword"){
                $adminController->resetPassword();
            }elseif($url[1] === "decon"){
                $adminController->logout();
            }else if($url[1]=== "nouveauPassword"){
                $adminController->newpassword($url[2]);
            }
            else{
            echo "<h1>la page n'existe pas</h1>";
            }
            break;
        case "publications":require_once __DIR__."/views/admin/publications.php";
            
            break;
        case "actualites":require_once __DIR__."/views/admin/actualites.php";
            
            break;
        case "formations":require_once __DIR__."/views/formations.php";
            
            break;
        case "recherche":require_once __DIR__."/views/recherche.php";
            
            break;
        case "accueil":require_once __DIR__."/views/accueil.php";
            
            break;
        case "presentation":require_once __DIR__."/views/presentation.php";
            
            break;
        case "contact":
            if(empty($url[1])){
               require_once __DIR__."/views/contact.php";
            }else if($url[1]== "message"){
                $messagesController->afficherMessages();
            }else if($url[1]== "send"){
                $messagesController->ajouterMessage();
            }else if($url[1]=="formresponse"){
                $messagesController->afficherMessage($url[2]);
            }else if($url[1]=="reponse"){
                $messagesController->repondreMessage($url[2]);
            }else if($url[1]=="suppMail"){
                
            }
            break;
            
    }
}

//Routeur
try {
    // chargement des contrôleurs
    $spcon = new SpecialiteController();
        
    if ($_SESSION['id']) {
        switch ($request) {
            case '/admin/specialite?id=doctorat':
                // Actions CRUD pour les spécialités
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    switch ($action) {
                        case 'addSpecialite':
                            $spcon->addSpecialite();
                            break;
                        case 'editSpecialite':
                            $spcon->updateSpecialite();
                            break;
                        case 'delspecialite':
                            $spcon->deleteSpecialite(getIntParam("id"));
                            break;
                            
                        // Gestion des cours de spécialité
                        case 'addCours':
                            $spcon->addCours();
                            break;
                        case 'editcours':
                            $spcon->updateSpecialiteCours();
                            break;
                        case 'delcours':
                            $spcon->deleteCours();
                            break;
                            
                        // Gestion des cours de doctorat
                        case 'addCoursDoctorat':
                            $spcon->addDoctoratCours();                        
                            break;
                        case 'editDoctoratCours':
                            $spcon->updateDoctoratCours();
                            break;
                        case 'delDoctoratCours':
                            $spcon->deleteDoctoratCours();
                            break;
                    }
                    redirect('/admin/specialite?id=' . ($_GET['id'] ?? '1'));
    
                }
    
                $spcon->showSpecialite();            
                break;
    
            default:
                echo "404 Page introuvable";
                break;
        }        
    }else{
        // la page de connexion
    }

} catch (Exception $e) {
    $_SESSION['error'] = $e->getMessage();
    redirect('/admin/specialite');
}

 ?>