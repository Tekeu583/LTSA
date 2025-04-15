<?php
session_start();
// if (!isset($_SESSION['token']) and !isset($_SESSION['id']) and !isset($_SESSION['nom'])) {
//     //redirectionner vers la page d'accueil du visiteur;
//     header("Location:index.php");
// }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>création d'un compte admin</title>
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
                    <a href="index.php?page=admin/"><i class="fas fa-arrow-left"></i></a>
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
                ?>
                <div class="login-header">
                    <h2>Modifier un admin</h2>
                </div>
                <form method="POST" action="index.php?page=admin/update" enctype="multipart/form-data" id="registerForm">
                    <input type="hidden" name="id" value="<?= $admins['id'] ?>">
                    <div class="input-group form-group">
                        <input type="text" id="nom" name="nom" value="<?= $admins['nom'] ?>" class="input-field form-control" required>
                        <label for="nom" class="label">Nom</label>
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <div class="input-group form-group">
                        <input type="email" id="email" name="email" value="<?= $admins['email'] ?>" class="input-field form-control" required>
                        <label for="email" class="label">Email</label>
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <input type="hidden" name="motDePasse" value="<?= $admins['motDePasse'] ?>">
                    <input type="hidden" name="created_at" value="<?= $admins['created_at'] ?>">
                    <input type="hidden" name="confirmer" value="<?= $admins['confirmer'] ?>">
                    <input type="hidden" name="token" value="<?= $admins['token'] ?>">
                    
                    <button type="submit" class="btn" >Modifier</button>
                    <p id="message"></p>
                    <div class="register-link">
                        <p><a href="index.php?page=admin/login">se connecter</a></p>
                    </div>
                </form>
            </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="public/js/bootstrap.min.js"></script>
    <script src="public/js/bootstrap-bundle.min.js"></script>
</body>
</html>