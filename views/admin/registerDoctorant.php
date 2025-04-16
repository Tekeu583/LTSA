<?php
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
    <title>Ajout d'un doctorant</title>
    <link rel="icon" href="../../public/img/LTSA.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="../../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../public/css/bootstrap-grid.css">
    <link rel="stylesheet" href="../../public/css/color.css">
    <link rel="stylesheet" href="../../public/css/login.css">
</head>
<body class="bg-admin vh-100 d-flex align-items-center" style="background: url('../../public/img/bg-form.jpg') center/cover no-repeat;">
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
                    <h2>Ajouter un doctorant</h2>
                </div>
                <form method="POST" action="../../index.php?page=doctorant/register" enctype="multipart/form-data" id="registerForm">
                    <div class="input-group form-group">
                        <input type="text" id="nom" name="nom"  class="input-field form-control" required>
                        <label for="nom" class="label">Nom du doctorant</label>
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <div class="input-group form-group">
                        <input type="text" id="intitule" name="intitule"  class="input-field form-control" required>
                        <label for="intitule" class="label">intitulé de la théses</label>
                    </div>
                    <div class="input-group form-group">
                        <input type="date" id="dates" name="dates"  class="input-field  form-control" required>
                        <label for="dates" class="label">Dates de soutenance</label>
                    </div>
                    <div class="input-group form-group">
                        <select name="formation" id="formation" class="input-field  form-control">  
                            <option disabled selected>Choisir une formation</option>
                            <option value="UFD-MATHEMATIQUES,INFORMATIQUE APPLIQUEE ET PHYSIQUE FONDAMENTALE">UFD-DE MATHEMATIQUES,INFORMATIQUE APPLIQUEE ET PHYSIQUE FONDAMENTALE</option>
                            <option value="UFD-BIO-GEOSCIENCES ET ENVIRONNEMENT ">UFD-BIO-GEOSCIENCES ET ENVIRONNEMENT  </option>
                            <option value="UFD-BIOCHIMIE DE CHIMIE ">UFD-BIOCHIMIE DE CHIMIE </option>
                            <option value="UFD-SCIENCES APPLIQUEES ">UFD-SCIENCES APPLIQUEES </option>
                            <option value="UFD-SCIENCES DE L’INGENIEUR ">UFD-SCIENCES DE L’INGENIEUR </option>
                            <option value="UFD-SCIENCES DE LA SANTE ">UFD-SCIENCES DE LA SANTE </option>
                        </select>
                    </div>
                    <div class="input-group form-group">
                        <input type="text" id="numero" name="numero" class="input-field  form-control" required>
                        <label for="numero" class="label">Numero d'ordre dans le fichier des théses</label>
                    </div>
                    <input type="hidden" id="id_admin" name="id_admin" value="<?= $_SESSION['id'];?>" hidden>
                    <button type="submit" class="btn" >Ajouter</button>
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