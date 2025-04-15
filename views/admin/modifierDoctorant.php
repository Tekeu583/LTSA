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
    <title>Modification d'un doctorant</title>
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
                    <a href="index.php?page=doctorant/"><i class="fas fa-arrow-left"></i></a>
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
                    <h2>Modifier un doctorant</h2>
                </div>
                <form method="POST" action="index.php?page=doctorant/update/<?= $doctorant['id']?>" enctype="multipart/form-data" id="registerForm">
                    <input type="hidden" id="id" name="id" value="<?= $doctorant['id']?>" hidden>
                    <div class="input-group form-group">
                        <input type="text" id="nom" name="nom" value="<?=$doctorant['nom']?>" class="input-field form-control" required>
                        <label for="nom" class="label">Nom du doctorant</label>
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <div class="input-group form-group">
                        <input type="text" id="intitule" name="intitule" value="<?=$doctorant['intitule']?>" class="input-field form-control" required>
                        <label for="intitule" class="label">intitulé de la théses</label>
                    </div>
                    <div class="input-group form-group">
                        <input type="date" id="dates" name="dates" value="<?=$doctorant['dates']?>" class="input-field  form-control" required>
                        <label for="dates" class="label">Dates de soutenance</label>
                    </div>
                    <div class="input-group form-group">
                        <select name="formation" id="formation" class="  form-control">  
                            <option class="input-field" disabled <?= !isset($doctorant['formation'])? 'selected': '' ?>>Choisir une formation</option>
                            <option class="input-field" value="UFD-MATHEMATIQUES,INFORMATIQUE APPLIQUEE ET PHYSIQUE FONDAMENTALE" <?= isset($doctorant['formation']) && $doctorant['formation']=="UFD-MATHEMATIQUES,INFORMATIQUE APPLIQUEE ET PHYSIQUE FONDAMENTALE" ? 'selected': '' ?>>UFD-DE MATHEMATIQUES,INFORMATIQUE APPLIQUEE ET PHYSIQUE FONDAMENTALE</option>
                            <option class="input-field" value="UFD-BIO-GEOSCIENCES ET ENVIRONNEMENT "  <?= isset($doctorant['formation']) && $doctorant['formation']=="UFD-BIO-GEOSCIENCES ET ENVIRONNEMENT " ? 'selected': '' ?>>UFD-BIO-GEOSCIENCES ET ENVIRONNEMENT  </option>
                            <option class="input-field" value="UFD-BIOCHIMIE DE CHIMIE " <?= isset($doctorant['formation']) && $doctorant['formation']=="UFD-BIOCHIMIE DE CHIMIE " ? 'selected': '' ?>>UFD-BIOCHIMIE DE CHIMIE </option>
                            <option class="input-field" value="UFD-SCIENCES APPLIQUEES " <?= isset($doctorant['formation']) && $doctorant['formation']=="UFD-SCIENCES APPLIQUEES " ? 'selected': '' ?>>UFD-SCIENCES APPLIQUEES </option>
                            <option class="input-field" value="UFD-SCIENCES DE L’INGENIEUR "  <?= isset($doctorant['formation']) && $doctorant['formation']==="UFD-SCIENCES DE L’INGENIEUR " ? 'selected': '' ?>>UFD-SCIENCES DE L’INGENIEUR </option>
                            <option class="input-field" value="UFD-SCIENCES DE LA SANTE "  <?= isset($doctorant['formation']) && $doctorant['formation']=="UFD-SCIENCES DE LA SANTE " ? 'selected': '' ?>>UFD-SCIENCES DE LA SANTE </option>
                        </select>
                    </div>
                    <div class="input-group form-group">
                        <input type="text" id="numero" name="numero" value="<?=$doctorant['numero']?>" class="input-field  form-control" required>
                        <label for="numero" class="label">Numero d'ordre dans le fichier des théses</label>
                    </div>
                    <input type="hidden" id="id_admin" name="id_admin" value="<?=$doctorant['id_admin']?>" hidden>
                    <input type="hidden" id="created_at" name="created_at" value="<?=$doctorant['created_at']?>" hidden>
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