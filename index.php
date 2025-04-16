<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Token CSRF
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Configuration et contrôleurs
require_once __DIR__ . "/config/config.php";
require_once __DIR__ . "/controller/EnseignantController.php";
require_once __DIR__ . "/controller/DoctorantController.php";
require_once __DIR__ . "/controller/MessagesController.php";
require_once __DIR__ . "/controller/AdminController.php";
require_once __DIR__ . "/controller/SpecialiteController.php";

// Instances de contrôleurs
$enseignantController = new EnseignantController();
$doctorantController = new DoctorantController();
$messagesController   = new MessagesController();
$adminController      = new AdminController();
$spcon                = new SpecialiteController();

// Fonctions utilitaires
define('BASE_URL', 'http://localhost:8070/');

function getIntParam(string $key, int $default = 0): int {
    return isset($_GET[$key]) ? intval($_GET[$key]) : $default;
}

function redirect(string $location, int $statusCode = 302): void {
    header("Location: $location", true, $statusCode);
    exit;
}

// Routage
$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$action  = $_POST['action'] ?? $_GET['action'] ?? '';

// Traitement de la page
if (empty($_GET['page'])) {
    redirect('index.php?page=accueil');
} else {
    $url = explode("/", filter_var($_GET['page'], FILTER_SANITIZE_URL));

    switch ($url[0]) {
        case "enseignant":
            match ($url[1] ?? '') {
                ''         => $enseignantController->afficherEnseignants(),
                "l"        => $enseignantController->afficherEnseignant($url[2]),
                "a"        => $enseignantController->ajoutEnseignant(),
                "m"        => $enseignantController->modificationEnseignant($url[2]),
                "s"        => $enseignantController->suppressionEnseignant($url[2]),
                "register" => $enseignantController->ajoutEnseignantValidation(),
                "update"   => $enseignantController->modificationEnseignantValidation(),
                default    => print "<h1>Page enseignant introuvable</h1>",
            };
            break;

        case "doctorant":
            match ($url[1] ?? '') {
                ''         => $doctorantController->afficherDoctorants(),
                "l"        => $doctorantController->afficherDoctorant($url[2]),
                "a"        => $doctorantController->ajoutDoctorant(),
                "m"        => $doctorantController->modificationDoctorant($url[2]),
                "s"        => $doctorantController->suppressionDoctorant($url[2]),
                "register" => $doctorantController->ajoutDoctorantValidation(),
                "update"   => $doctorantController->modificationDoctorantValidation(),
                default    => print "<h1>Page doctorant introuvable</h1>",
            };
            break;

        case "admin":
            if (empty($url[1])) {
                $adminController->showAdmin();
            } else if ($url[1] === "specialite") {
                // Gestion des spécialités (id attendu dans $_GET['id'])
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
        
                        case 'addCours':
                            $spcon->addCours();
                            break;
                        case 'editcours':
                            $spcon->updateSpecialiteCours();
                            break;
                        case 'delcours':
                            $spcon->deleteCours();
                            break;
        
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
                    redirect(BASE_URL . 'index.php?page=admin/specialite&id=' . ($_GET['id'] ?? 'doctorat'));
                }

                $spcon->showSpecialite();

            } else if ($url[1] === "l") {
                $adminController->showAdminById($url[2]);
            } else if ($url[1] === "a") {
                $adminController->addAdmin();
            } else if ($url[1] === "m") {
                $adminController->modificationAdmin($url[2]);
            } else if ($url[1] === "register") {
                $adminController->ajoutAdminValidation();
            } else if ($url[1] === "update") {
                $adminController->validerModificationAdmin();
            } else if ($url[1] === "s") {
                $adminController->deleteAdmin($url[2]);
            }
            break;
            
        case "login":
            match ($url[1] ?? '') {
                ''              => $adminController->showLoginForm(),
                "conn"          => $adminController->validerlogin(),
                "reset"         => $adminController->reset(),
                "sendMail"      => $adminController->forgotPassword(),
                "newpassword"   => $adminController->resetPassword(),
                "decon"         => $adminController->logout(),
                "nouveauPassword" => $adminController->newpassword($url[2]),
                default         => print "<h1>Page login introuvable</h1>",
            };
            break;

        case "contact":
            match ($url[1] ?? '') {
                ''             => require __DIR__ . "/views/contact.php",
                "message"      => $messagesController->afficherMessages(),
                "send"         => $messagesController->ajouterMessage(),
                "formresponse" => $messagesController->afficherMessage($url[2]),
                "reponse"      => $messagesController->repondreMessage($url[2]),
                "suppMail"     => print "<h1>Suppression non implémentée</h1>",
                default        => print "<h1>Page contact introuvable</h1>",
            };
            break;

        case "accueil":
            require __DIR__ . "/views/accueil.php";
            break;
        case "presentation":
            require __DIR__ . "/views/presentation.php";
            break;
        case "formations":
            require __DIR__ . "/views/formations.php";
            break;
        case "recherche":
            require __DIR__ . "/views/recherche.php";
            break;
        case "publications":
            require __DIR__ . "/views/admin/publications.php";
            break;
        case "actualites":
            require __DIR__ . "/views/admin/actualites.php";
            break;

        default:
            print "<h1>Page introuvable</h1>";
    }

    
}
?>
