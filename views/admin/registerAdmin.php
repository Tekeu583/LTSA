<?php
// if (!isset($_SESSION['token']) and !isset($_SESSION['id']) and !isset($_SESSION['nom'])) {
//     //redirectionner vers la page d'accueil du visiteur;
//     header("Location:../../index.php");
// }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>création d'un compte admin</title>
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
                    <a href="../../index.php?page=admin/"><i class="fas fa-arrow-left"></i></a>
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
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            <?php foreach ($error as $errors): ?>
                                <li><?php echo htmlspecialchars($errors);?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                
                <div class="login-header">
                    <h2>créer un compte admin</h2>
                </div>
                <form method="POST" action="../../index.php?page=admin/register" enctype="multipart/form-data" id="registerForm">
                    <div class="input-group form-group">
                        <input type="text" id="nom" name="nom" class="input-field form-control" required>
                        <label for="nom" class="label">Nom</label>
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <div class="input-group form-group">
                        <input type="email" id="email" name="email" class="input-field form-control" required>
                        <label for="email" class="label">Email</label>
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <div class="input-group form-group">
                        <input type="password" id="pass" name="motDePasse" class="input-field  form-control" required>
                        <label for="pass" class="label">Mot de passe</label>
                        <i class="fa-solid fa-lock"></i>
                    </div>
                    <div class="input-group form-group">
                        <input type="password" id="confirmPassword" name="confirmPassword" class="input-field  form-control" required>
                        <label for="pass" class="label">confirmer le mot de passe</label>
                        <i class="fa-solid fa-lock"></i>
                    </div>
                    <button type="submit" class="btn" >créer le compte</button>
                    <div class="register-link">
                        <p><a href="../login.php">se connecter</a></p>
                    </div>
                    <p id="message"></p>
                </form>
            </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="public/js/bootstrap.min.js"></script>
    <script src="public/js/bootstrap-bundle.min.js"></script>
    <script>
        let password=document.getElementById("pass");
        let confirmPassword=document.getElementById("confirmPassword");
        let lock=document.querySelectorAll(".fa-lock");
        lock[0].addEventListener('click',()=>{
                if(password.type==="password"){
                    password.type="text";
                }else{
                    password.type="password";
                }
        });
         lock[1].addEventListener('click',()=>{
                if(confirmPassword.type==="password"){
                    confirmPassword.type="text";
                }else{
                    confirmPassword.type="password";
                }
            });
        
        
    </script>
</body>
</html>