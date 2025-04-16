<?php

require_once __DIR__ . "/../Models/Specialite.php";

class SpecialiteController {
    private $specialiteModel;

    public function __construct() {
        $this->specialiteModel = new Specialite();
    }

    // ==========================================
    // AFFICHAGE PRINCIPAL
    // ==========================================

    public function showSpecialite() {
        try {
            $specialites = Specialite::getAll();
            $id = $_GET['id'] ?? null;
            
            if ($id === 'doctorat') {
                // Mode doctorat
                $doctoratInfo = Specialite::getDoctoratInfo();
                $courses = Specialite::getDoctoratCourses();
                $spec = "Doctorat";
                $isDoctorat = true;
            } elseif (ctype_digit($id)) {
                // Mode spécialité normale
                $currentSpecialite = new Specialite((int)$id);
                $courses = $currentSpecialite->getCourses();
                $spec = $currentSpecialite->getName();
                $isDoctorat = false;
            } else {
                // Mode par défaut (première spécialité)
                $courses = [];
                $spec = null;
                $isDoctorat = false;
            }

            require_once __DIR__ . "/../views/admin/specialite.php";
        } catch (Exception $e) {
            $_SESSION['error'] = "Erreur lors du chargement : " . $e->getMessage();
            require_once 'views/admin/specialite.php';
        }
    }

    // ==========================================
    // GESTION DES SPECIALITES
    // ==========================================

    public function addSpecialite() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: /admin/specialite");
            exit;
        }

        try {
            $nom = $_POST['nom'] ?? '';
            $description = $_POST['description'] ?? '';
            $code = $_POST['code'] ?? '';
            $id_admin = $_SESSION['user_id'] ?? 0;

            if (empty($nom) || empty($code)) {
                throw new Exception("Le nom et le code sont obligatoires");
            }

            $id = Specialite::create($nom, $description, $code);
            
            $_SESSION['success'] = "Spécialité créée avec succès";
            header("Location: /index.php?page=admin/specialite&id=" . $id);
            exit;
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            header("Location: /admin/specialite");
            exit;
        }
    }

    public function updateSpecialite() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: /admin/specialite");
            exit;
        }

        try {
            $id = $_POST['id'] ?? null;
            $nom = $_POST['nom'] ?? '';
            $description = $_POST['description'] ?? '';
            $code = $_POST['code'] ?? '';

            if (empty($id)) {
                throw new Exception("ID de spécialité manquant");
            }

            $specialite = new Specialite((int)$id);
            $specialite->update($nom, $description, $code);
            
            $_SESSION['success'] = "Spécialité mise à jour avec succès";
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
        }

        header("Location: /index.php?page=admin/specialite&id=" . $id);
        exit;
    }

    public function deleteSpecialite($id) {
        try {
            $specialite = new Specialite((int)$id);
            $specialite->delete();
            
            $_SESSION['success'] = "Spécialité supprimée avec succès";
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
        }

        // Rediriger vers la première spécialité
        header("Location: /admin/specialite");
        exit;
    }

    // ==========================================
    // GESTION DES COURS (SPECIALITE ET DOCTORAT)
    // ==========================================

    public function addCours() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: /admin/specialite");
            exit;
        }

        try {
            $specialite_id = $_POST['id_specialite'] ?? null;
            $isDoctorat = ($specialite_id === 'doctorat');

            if ($isDoctorat) {
                // Ajout d'un cours de doctorat
                $this->addDoctoratCours();
            } else {
                // Ajout d'un cours normal
                $this->addSpecialiteCours((int)$specialite_id);
            }
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            $id = $isDoctorat ? 'doctorat' : $specialite_id;
            header("Location: /index.php?page=admin/specialite&id=" . $id);
            exit;
        }
    }

    private function addSpecialiteCours($specialite_id) {
        $specialite = new Specialite($specialite_id);
        
        $specialite->addCourse(
            trim($_POST['codeEC']),
            trim($_POST['intituleEC']),
            (float)($_POST['coef'] ?? 0),
            (int)($_POST['cm'] ?? 0),
            (int)($_POST['td'] ?? 0),
            (int)($_POST['tp'] ?? 0),
            (int)($_POST['tpe'] ?? 0),
            (int)($_POST['ccts'] ?? 0)
        );

        $_SESSION['success'] = "Cours ajouté avec succès";
        header("Location: /index.php?page=admin/specialite&id=" . $specialite_id);
        exit;
    }

    public function addDoctoratCours() {
        try{
            $specialite = new Specialite();
            $specialite->addDoctoratCours(
                trim($_POST['codeEC']),
                trim($_POST['intituleEC']),
                (int)($_POST['creditEC'] ?? 0),
                trim($_POST['anneeDoctorat'])
            );
            $_SESSION['success'] = 'Cours de doctorat ajouté avec succès';
            header("Location: /index.php?page=admin/specialite&id=doctorat");
            exit;
        }catch(Exception $e){
            $_SESSION["error"] = $e->getMessage();
            echo $e->getMessage();
            header("Location: /index.php?page=admin/specialite&id=doctorat");
        }

        header("Location: /index.php?page=admin/specialite&id=doctorat");
        exit;
    }

    public function updateCours() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: /index.php?page=admin/specialite&id=".$_GET['id']);
            exit;
        }

        try {
            $isDoctorat = $_POST['specialite_id'] === 'doctorat';
            
            if ($isDoctorat) {
                $this->updateDoctoratCours();
            } else {
                $this->updateSpecialiteCours();
            }
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            $id = $isDoctorat ? 'doctorat' : $_POST['specialite_id'];
            header('Location: /index.php?page=admin/specialite&id=' . $id);
            exit;
        }
    }

    public function updateSpecialiteCours() {
        $specialite = new Specialite((int)$_POST['specialite_id']);
        
        
        $result = $specialite->editCours(
            trim($_POST['codeEC']),
            trim($_POST['intituleEC']),
            (float)($_POST['coef'] ?? 0),
            (int)($_POST['cm'] ?? 0),
            (int)($_POST['td'] ?? 0),
            (int)($_POST['tp'] ?? 0),
            (int)($_POST['tpe'] ?? 0),
            (int)($_POST['ccts'] ?? 0),
            (int)($_POST['cours_id'])
        );

        if ($result) {
            $_SESSION['success'] = "Cours mis à jour avec succès";
        } else {
            $_SESSION['error'] = "Aucune modification effectuée";
        }
        
        header("Location: /index.php?page=admin/specialite&id=" . $_POST['specialite_id']);
        exit;
    }

    public function updateDoctoratCours() {
        $conn = connectDB();
        $conn->beginTransaction();
        
        try {
            $stmt = $conn->prepare("UPDATE cycleDoctorat SET 
                                   codeEC = :codeEC,
                                   intituleEC = :intituleEC,
                                   creditEC = :creditEC,
                                   anneeDoctorat = :anneeDoctorat
                                   WHERE id = :id");
            
            $stmt->execute([
                ':id' => (int)$_POST['cours_id'],
                ':codeEC' => trim($_POST['codeEC']),
                ':intituleEC' => trim($_POST['intituleEC']),
                ':creditEC' => (int)($_POST['creditEC'] ?? 0),
                ':anneeDoctorat' => trim($_POST['anneeDoctorat'])
            ]);
            
            $conn->commit();
            $_SESSION['success'] = "Cours de doctorat mis à jour avec succès";
            header("Location: /index.php?page=admin/specialite&id=doctorat");
            exit;
        } catch (PDOException $e) {
            $conn->rollBack();
            throw new Exception("Erreur lors de la mise à jour du cours de doctorat");
        }
    }

    public function deleteCours() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: /admin/specialite");
            exit;
        }

        try {
            $isDoctorat = $_POST['specialite_id'] === 'doctorat';
            
            if ($isDoctorat) {
                $this->deleteDoctoratCours();
            } else {
                $this->deleteSpecialiteCours();
            }
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            $id = $isDoctorat ? 'doctorat' : $_POST['specialite_id'];
            header("Location: /index.php?page=admin/specialite&id=" . $id);
            exit;
        }
    }

    public function deleteSpecialiteCours() {
        $specialite = new Specialite((int)$_POST['specialite_id']);
        
        // Note: La méthode deleteCourse devrait être implémentée dans le modèle
        $specialite->deleteCourse((int)$_POST['cours_id']);
        
        $_SESSION['success'] = "Cours supprimé avec succès";
        header("Location: /index.php?page=admin/specialite&id=" . $_POST['specialite_id']);
        exit;
    }

    public function deleteDoctoratCours() {
        $conn = connectDB();
        $conn->beginTransaction();
        
        try {
            $stmt = $conn->prepare("DELETE FROM cycleDoctorat WHERE id = :id");
            $stmt->execute([':id' => (int)$_POST['cours_id']]);
            
            $conn->commit();
            $_SESSION['success'] = "Cours de doctorat supprimé avec succès";
            header("Location: /index.php?page=admin/specialite&id=doctorat");
            exit;
        } catch (PDOException $e) {
            $conn->rollBack();
            throw new Exception("Erreur lors de la suppression du cours de doctorat");
        }
    }

    // ==========================================
    // GESTION DU DOCTORAT
    // ==========================================

    public function updateDoctorat() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: /index.php?page=admin/specialite&id=doctorat");
            exit;
        }

        try {
            $nom = $_POST['nom'] ?? '';
            $description = $_POST['description'] ?? '';

            if (empty($nom)) {
                throw new Exception("Le nom du doctorat est obligatoire");
            }

            Specialite::updateDoctorat($nom, $description);
            
            $_SESSION['success'] = "Doctorat mis à jour avec succès";
        } catch (Exception $e) {
            $_SESSION['error'] = 'echec de la mise à jour'.$e->getMessage();
            
        }

        header("Location: /index.php?page=admin/specialite&id=doctorat");
        exit;
    }
    public function handleSpecialite($controller) {
        $action = $_POST['action'] ?? $_GET['action'] ?? '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            match ($action) {
                'addSpecialite'      => $controller->addSpecialite(),
                'editSpecialite'     => $controller->updateSpecialite(),
                'delspecialite'      => $controller->deleteSpecialite(getIntParam("id")),
                'addCours'           => $controller->addCours(),
                'editcours'          => $controller->updateSpecialiteCours(),
                'delcours'           => $controller->deleteCours(),
                'addCoursDoctorat'   => $controller->addDoctoratCours(),
                'editDoctoratCours'  => $controller->updateDoctoratCours(),
                'delDoctoratCours'   => $controller->deleteDoctoratCours(),
                default              => null,
            };
            redirect('/?page=admin/specialite&id=' . ($_GET['id'] ?? '1'));
        }
    }
}
