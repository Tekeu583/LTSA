<?php
session_start();

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
require_once "controller/SpecialiteController.php";
$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); // Nettoyage de l'URL
$action = $_POST['action'] ?? $_GET['action'] ?? ''; // Gère GET et POST

function getIntParam(string $key, int $default = 0) {
    return isset($_GET[$key]) ? (int)$_GET[$key] : $default; 
}

function redirect(string $location, int $statusCode = 302) {
    header("Location: $location", true, $statusCode);
    exit;
}

//Routeur

try {
    // chargement des contrôleurs
    $spcon = new SpecialiteController();
        
    if ($_SESSION['id']) {
        switch ($request) {
            case '/admin/specialite':
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
                http_response_code(404);
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