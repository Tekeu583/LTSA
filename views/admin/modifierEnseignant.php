<?php
session_start();
if (!isset($_SESSION['token']) and !isset($_SESSION['id']) and !isset($_SESSION['nom'])) {
    //redirectionner vers la page d'accueil du visiteur;
    header("Location:../../index.php");
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification d'un ensiegnant</title>
    <link rel="icon" href="public/img/LTSA.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/bootstrap-grid.css">
    <link rel="stylesheet" href="public/css/color.css">
    <link rel="stylesheet" href="public/css/login.css">

</head>
<body class="bg-admin vh-100 d-flex align-items-center" style="background: url('public/img/bg-form.jpg') center/cover no-repeat;">
    <div class="container justify-content-center align-items-center d-flex min-vh-100">
            <div class="login-box ">
                <div class="retour left ml-2 mb-2">
                    <a href="index.php?page=enseignant/"><i class="fas fa-arrow-left"></i></a>
                </div>
                <?php 
                if(!empty($_SESSION['alert'])):
                    ?>
                    <div class="alert alert-<?=$_SESSION['alert']['type']?>" role="alert">
                    <?=$_SESSION['alert']['msg']?>
                    </div>
                    
                    <?php 
                    unset($_SESSION['alert']);
                    endif;
                    if (!empty($error)): ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <?php foreach ($error as $errors): ?>
                                    <li><?php echo htmlspecialchars($errors);?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif;
                ?>
                <div class="login-header">
                    <h2>Modifier un enseignant</h2>
                </div>
                <form method="POST" action="index.php?page=enseignant/update/<?= $enseignant['id']?>" enctype="multipart/form-data" id="registerForm">
                    <input type="hidden" id="id" name="id" value="<?= $enseignant['id']?>" hidden>
                    <div class="input-group form-group">
                        <input type="text" id="nom" name="nom" value="<?=$enseignant['nom']?>" class="input-field form-control" required>
                        <label for="nom" class="label">Nom</label>
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <div class="input-group form-group">
                        <input type="text" id="grade" name="grade" value="<?=$enseignant['grade']?>" class="input-field form-control" required>
                        <label for="grade" class="label">Grade</label>
                    </div>
                    <div class="input-group form-group">
                        <input type="text" id="fonction" name="fonction" value="<?=$enseignant['fonction']?>" class="input-field  form-control" required>
                        <label for="fonction" class="label">Fonction</label>
                    </div>
                    <div class="input-group form-group">
                        <input type="text" id="lieuTravail" name="lieuTravail" value="<?=$enseignant['lieuTravail']?>" class="input-field  form-control" required>
                        <label for="lieuTravail" class="label">lieu de travail</label>
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <input type="hidden" id="created_at" name="created_at" value="<?=$enseignant['created_at']?>" hidden>
                    <button type="submit" class="btn" >Modifier</button>
                    <p id="message"></p>
                </form>
            </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="public/js/bootstrap.min.js"></script>
    <script src="public/js/bootstrap-bundle.min.js"></script>
    <script>
        
    </script>
</body>
</html>