<?php
if (isset($_SESSION['token']) and isset($_SESSION['id']) and isset($_SESSION['nom'])) {
    //redirectionner vers la page d'accueil du visiteur;
    header("Location:index.php?page=doctorant");
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" href="public/img/LTSA.png" type="image/png">
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
                    <a href="index.php"><i class="fas fa-arrow-left"></i></a>
                </div>
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
                    <h2>connexion</h2>
                </div>
                <form method="POST" action="index.php?page=login/conn" enctype="multipart/form-data">
                    <div class="input-group form-group">
                        <input type="email" name="email" id="email" class="input-field form-control" required>
                        <label for="email" class="label">Email</label>
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <div class="input-group form-group">
                        <input type="password" name="motDePasse" id="pass" class="input-field  form-control" required>
                        <label for="pass" class="label">password</label>
                        <i class="fa-solid fa-lock"></i>
                    </div>
                    <input type="hidden" name="token" id="token" value="<?php echo $_SESSION['token_csrf']; ?>">
                    <div class="remember-forgot">
                        <a href="index.php?page=login/reset">mot de passe oublié ?</a>
                    </div>
                    <button type="submit" class="btn" >se connecter</button>
                </form>
            </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/bootstrap-bundle.min.js"></script>
    <script>
        let password=document.getElementById("pass");
        let lock=document.querySelector(".fa-lock");
        lock.addEventListener('click',()=>{
                if(password.type==="password"){
                    password.type="text";
                }
                else{
                    password.type="password";
                }
        });

    </script>
</body>
</html>