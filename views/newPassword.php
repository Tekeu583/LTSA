<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau mot de passe</title>
    <link rel="icon" href="../img/LTSA.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="public/css/color.css">
    <link rel="stylesheet" href="public/css/login.css">
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/bootstrap-grid.css">

</head>
<body class="bg-login">
    <div class="container justify-content-center align-items-center d-flex min-vh-100">
            <div class="login-box ">
                <div class="retour left ml-2 mb-2">
                    <a href="index.php?page=login"><i class="fas fa-arrow-left"></i></a>
                </div>
                <div class="login-header">
                    <h2>nouveau mot de passe</h2>
                </div>
                <form method="POST" action="index.php?page=login/newpassword" enctype="multipart/form-data" id="newPasswordForm">
                    <div class="input-group form-group">
                        <input type="hidden" name="token" id="token" value="<?php echo @$token; ?>">
                    </div>
                    <div class="input-group form-group">
                        <input type="password" id="pass" name="motDePasse" class="input-field  form-control" required>
                        <label for="pass" class="label">nouveau mot de passe</label>
                        <i class="fa-solid fa-lock"></i>
                    </div>
                    <div class="input-group form-group">
                        <input type="password" id="confirmPassword" name="confirmPassword" class="input-field  form-control" required>
                        <label for="pass" class="label">confirmer le mot de passe</label>
                        <i class="fa-solid fa-lock"></i>
                    </div>
                    <button type="submit" class="btn" >Valider</button>
                    <div class="register-link">
                        <p><a href="index.php?page=login">connectez-vous</a></p>
                    </div>
                </form>
            </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/bootstrap-bundle.min.js"></script>
    <script>
        let password=document.getElementById("pass");
        let confirmPassword=document.getElementById("confirmPassword");
        let lock=document.querySelectorAll(".fa-lock");
        lock[0].addEventListener('click',()=>{
                if(password.type==="password"){
                    password.type="text";
                }
                else{
                    password.type="password";
                }
        });
        lock[1].addEventListener('click',()=>{
                if(confirmPassword.type==="password"){
                    confirmPassword.type="text";
                }
                else{
                    confirmPassword.type="password";
                }
        });


    </script>
</body>
</html>