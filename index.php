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

try {
    $spcon = new SpecialiteController();
    
    switch ($request) {
        case '/admin/specialite':
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && $action === 'addSpecialite') {
                try {
                    $spcon->addSpecialite();                    
                    redirect('/admin/specialite'); // Redirection PRG pattern
                } catch (Exception $e) {
                    $_SESSION['error'] = $e->getMessage();
                    redirect('/admin/specialite');
                }
            }
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && $action === 'editSpecialite'){
                try {
                    $spcon->updateSpecialite();
                } catch (Exception $e) {
                    $_SESSION['error'] = $e->getMessage();
                    redirect('/admin/specialite');
                }
            }
            if ($_SERVER['REQUEST_METHOD'] === 'POST'&& $action === 'delspecialite'){
                try {
                    $spcon->deleteSpecialite(getIntParam("id"));
                } catch (Exception $e) {
                    $_SESSION['error'] = $e->getMessage();
                    redirect('/admin/specialite?id=1');
                }
            }
            //cours
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && $action === 'addCours') {
                try {
                    $spcon->addcours();                    
                    $_SESSION['success'] = "Cours ajouté avec succès !";
                } catch (Exception $e) {
                    $_SESSION['error'] = $e->getMessage();
                    redirect('/admin/specialite');
                }
            }
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && $action === 'editcours'){
                try {
                    $spcon->updatecours();
                    redirect('/admin/specialite'.$_GET['id']);
                } catch (Exception $e) {
                    $_SESSION['error'] = $e->getMessage();
                    redirect('/admin/specialite?id=1');
                }
            }
            if ($_SERVER['REQUEST_METHOD'] === 'POST'&& $action === 'delcours'){
                try {
                    $spcon->delcourse();
                } catch (Exception $e) {
                    $_SESSION['error'] = $e->getMessage();
                    redirect('/admin/specialite?id=1');
                }
            }

            $spcon->showSpecialite();            
            break;

        default:
            http_response_code(404);
            echo "404 Page introuvable";
            break;
    }
    
} catch (Exception $e) {
    http_response_code(500);
    echo "Erreur : " . $e->getMessage();
    exit;
}
?>