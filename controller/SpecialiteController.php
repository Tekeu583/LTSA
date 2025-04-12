<?php

require_once  __DIR__ ."/../Models/Specialite.php";


class SpecialiteController {
    
    private $model;

    public function __construct() {
        $this->model = new Specialite();
        
    }

    // specialité
    public  function showSpecialite() {
       try{
        
        
        $specialites = $this->model->getAllSpecialites();
        $courses = $this->showCourses($specialite_id= getIntParam("id"));
        $spec = $this->getSpecialiteById($id = getIntParam("id"));
        

        require_once 'views/admin/specialite.php';
       }catch (Exception $e) {
        $_SESSION['error'] = "Erreur lors du chargement des spécialités: " . $e->getMessage();
        require_once 'views/admin/specialite.php';
        }
    }

    public function deleteSpecialite($id) {
        try{
            $this->model->delspecialite($id);
            $_SESSION['success'] = "Spécialité supprimée avec succès";
        }catch (Exception $e) {
            $_SESSION["error"] = "Erreur à la suppression". $e->getMessage();
            header('Location: /admin/specialite?id='. $id);
            exit;
        }        
        
        header('Location: /admin/specialite?id='. $id-1);
        exit;
    }

    public function updateSpecialite() {
        $id = $_POST['id'] ?? null;
        $name = $_POST['nom'] ?? null;
        $code = $_POST['code'] ?? null;
        $description = $_POST['description'] ?? null;
    
        $result = $this->model->editSpecialite($id, $name, $description, $code);
    
        if ($result > 0) {
            $_SESSION['success'] = "Spécialité mise à jour avec succès";
        } else {
            $_SESSION['error'] = $result === false 
                ? "Erreur lors de la mise à jour" 
                : "Aucune modification effectuée";
        }
    
        header("Location: /admin/specialite?id=".$id);
        exit;
    }

    public function addSpecialite() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom'] ?? '';
            $description = $_POST['description'] ?? '';
            $code = $_POST['code'] ?? '';
            $id_admin = $_SESSION['user_id'] ?? 0; // À adapter
    
            // Validation
            if (empty($nom) || empty($code)) {
                $_SESSION['error'] = "Nom et code sont obligatoires";
                header("Location: /admin/specialite?id=".$_GET["id"]);
                exit;
            }
    
            $result = $this->model->newspecialite($nom, $description, $id_admin, $code);
    
            if ($result) {
                $_SESSION['success'] = "Spécialité ajoutée avec succès !";
            } else {
                $_SESSION['error'] = "Erreur lors de l'ajout de la spécialité";
            }
            
            if (is_object($result) && isset($result->id)) {
                header("Location: /admin/specialite?id=".$result->id);
            } else {
                $_SESSION['error'] = "Erreur lors de l'ajout de la spécialité";
                header("Location: /admin/specialite?id=1");
            }
            exit;
        }
        
        // Affichage normal si GET
        include __DIR__ .'/../views/admin/specialite.php';
    }
    public function getSpecialiteById($id) {
        $specialite = new Specialite();
        return $specialite->getspecialite_id($id);
    }


    // cours
    public function showCourses($specialite_id) {
        $specialite = new Specialite();
        return $specialite->get_courses_by_specialite($specialite_id);
    }

    public function addcours() {            
        // Vérification CSRF
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            $_SESSION['error'] = "Token de sécurité invalide";
            header("Location: /admin/specialite?id=".$_POST['id_specialite']);
            exit;
        }    
        try {            
    
            $result = $this->model->newcourse(
                trim($_POST['codeEC']),
                trim($_POST['intituleEC']),
                (float)($_POST['coef'] ?? 0),
                (int)($_POST['cm'] ?? 0),
                (int)($_POST['td'] ?? 0),
                (int)($_POST['tp'] ?? 0),
                (int)($_POST['tpe'] ?? 0),
                (int)($_POST['ccts'] ?? 0),
                (int)($_POST['id_specialite'])
            );

        
            if ($result) {
                $_SESSION['success'] = "Cours ajouté avec succès!!  intitule: " . $_POST['intituleEC'];
            } else {
                $_SESSION['error'] = "Erreur lors de l'ajout du cours";
            }
    
        } catch (InvalidArgumentException $e) {
            $_SESSION['error'] = $e->getMessage();
        } catch (Exception $e) {
            $_SESSION['error'] = "Erreur technique: " . $e->getMessage();
        }
        $specialite_id = $_POST['id_specialite'] ?? 1;
        header("Location: /admin/specialite?id=".$specialite_id);
        exit;
    }
    public function updatecours(){
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            $_SESSION['error'] = "Token de sécurité invalide";
            header("Location: /admin/specialite?id=" . ($_GET['id'] ?? '1'));
            exit;
        } 
        if(!$_POST['cours_id']){
            $_SESSION['error'] = 'errer';
            header('/admin/specialite?id=' . ($_GET['id'] ?? '1'));
        }
        try{
            $result = $this->model->editcours(
                trim($_POST['codeEC']),
                trim($_POST['intituleEC']),
                (float)($_POST['coef'] ?? 0),
                (int)($_POST['cm'] ?? 0),
                (int)($_POST['td'] ?? 0),
                (int)($_POST['tp'] ?? 0),
                (int)($_POST['tpe'] ?? 0),
                (int)($_POST['ccts'] ?? 0),
                (int)($_POST['cours_id'] )
            );
            if ($result) {
                $_SESSION['success'] = 'Cours mis à jour avec succès!';
                header("Location: /admin/specialite?id=" . ($_GET['id'] ?? '1'));
                exit;
            } else {
                $_SESSION['error'] = $result === false 
                    ? "Erreur lors de la mise à jour" 
                    : "Aucune modification effectuée";
                header("Location: /admin/specialite?id=" . ($_GET['id'] ?? '1'));
                exit;
            }  
        }catch(Exception $e){
            $_SESSION['error'] = $e->getMessage();
            header("Location: /admin/specialite?id=" . ($_GET['id'] ?? '1'));
            exit;
        }
                
    }
    public function delcourse(){
        try{
            $this->model->deletecourse($_POST['cours_id']);
            $_SESSION['success'] = "Cours supprimé avec succès";
            header("Location: /admin/specialite?id=" . ($_GET['id'] ??  '1'));        
            exit;
        }catch(Exception $e){
            $_SESSION['error'] = $e->getMessage();
        }

        header("Location: /admin/specialite?id=" . ($_GET['id'] ??  '1'));
        exit;
    }
}
?>