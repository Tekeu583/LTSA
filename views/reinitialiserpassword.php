<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mot de passe oublier</title>
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
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            <?php foreach ($error as $errors): ?>
                                <li><?php echo htmlspecialchars($errors);?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <?php if (!empty($success)): ?>
                    <div class="alert alert-success">
                        <ul class="mb-0">
                            <?php foreach ($success as $succes): ?>
                                <li><?php echo htmlspecialchars($succes);?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <div class="login-header">
                    <h2>Reinitialiser votre mot de passe</h2>
                </div>
                <form method="POST" action="index.php?page=login/sendMail" enctype="multipart/form-data">
                    <div class="input-group form-group">
                        <input type="email" name="email" id="email" class="input-field form-control" required>
                        <label for="email" class="label">Email</label>
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <button type="submit" class="btn" >Envoyer un lien de réinitialisation</button>
                    <div class="register-link">
                        <p><a href="index.php?page=login">se connecter</a></p>
                    </div>
                </form>
                <p id="resetMessage"></p>
            </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/bootstrap-bundle.min.js"></script>
</body>
</html>