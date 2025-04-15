<?php
require_once(__DIR__."/config/config.php");
require_once(__DIR__."/controller/EnseignantController.php");
require_once(__DIR__."/Models/Admin.php");
require_once(__DIR__."/controller/AdminController.php");
require_once  "controller/SpecialiteController.php";
$enseignantController = new EnseignantController;
$adminController= new AdminController;
$request = $_SERVER['REQUEST_URI'];
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
    header("location:views/accueil.php");
}else{
    $url= explode("/",filter_var($_GET['page']),FILTER_SANITIZE_URL);
    switch($url[0]){
        case "doctorant" : require_once __DIR__."/views/admin/doctorant.php";
        break;
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
        }else{
            throw new Exception("la page n'existe pas");
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
        }else{
            throw new Exception("la page n'existe pas");
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
            }else{
                throw new Exception("la page n'existe pas");
            }
            break;
         case "specialites":require_once __DIR__."/views/admin/cours-specialité.php";
            
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
            
    }
}
// switch ($request) {
//     case '/':
//         $spcon->showSpecialite();
//         $spcon->showCourses(getIntParam('id'));
//         break;
//     }
// ?>