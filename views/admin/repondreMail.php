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
    <title>Reponses aux Mails</title>
    <link rel="icon" href="public/img/LTSA.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/color.css">
    <link rel="stylesheet" href="public/css/bootstrap-grid.css">
    <link rel="stylesheet" href="public/css/publication.css">
    <link rel="stylesheet" href="public/css/color.css">
    <link rel="stylesheet" href="public/css/presentation.css">
    <link rel="stylesheet" href="public/css/accueil.css">
    <link rel="stylesheet" href="public/css/template-accueil.css">
</head>
<body>
    <style>
        body{
            margin: 0;
            padding: 0;
            padding-top: 50px; /* espace pour la navbar fixe */
            background: url('public/img/bg-form.jpg') center/cover no-repeat;
        }
        .container{
            top: 10px !important;
            width: 50%;
        }
        .orange-box {
            background-color:rgb(250, 170, 21);
            border-radius: 5px;
            font-size: 1.5rem;
            padding: 3px;
            max-width: 400px;
            width: 100%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            margin: 0 auto;
            text-align: center; 
            /* width: fit-content;  */
     }
             
        .contact-form {
            width: 100%;
            background-color: #D9D9D9;
            top: 0;
            border-radius: 10px;
            padding: 2rem;
            margin-left: auto;
            margin-top: 2%;
            margin-right: auto;
            max-width: 600px;
        }
        
        .form-title {
            font-weight: bold;
            margin-bottom: 2rem;
        }
        
        .required-field::after {
            content: " *";
            color: red;
        }
        
        .btn-submit {
            background-color: green;
            color: white;
            width: 100%;
            padding: 10px;
            margin-top: 1rem;
        }
        
        .form-group {
            position: relative;
        }
        
        .form-control {
            margin-bottom: 1rem;
            padding-left: 40px !important;
        }
        
        .input-icon {
            position: absolute;
            left: 10px;
            top: 42px;
            color: #000;
            z-index: 2;
        }
        
        textarea.form-control {
            padding-left: 10px !important;
        }
    </style>


</head>
<body>
    <div class="container">
        <!-- Cadre orange avec titre -->
        <div class="orange-box">
                repondez aux mails
        </div>
        
        <div class="contact-form">
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
                <div>
                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <?php foreach ($error as $errors): ?>
                                    <li><?php echo htmlspecialchars($errors);?></li>
                                <?php endforeach; ?>
                            </ul>
                                </div>
                    <?php endif; ?>
                </div>
                <div class="retour left ml-2 mb-2">
                    <a href="index.php?page=contact/message"><i class="fas fa-arrow-left text-success"></i></a>
                </div>
            <h2 class="form-title"><center>Formulaire de Reponse aux Mails</center></h2>
            <form method="POST" action="index.php?page=contact/reponse" id="contactForm">
                <input type="hidden" name="id" value="<?= $message['id']; ?>">
                <div class="mb-3 form-group">
                    <!-- <label for="nom" class="form-label required-field">votre Email</label>
                    <i class="fas fa-user input-icon"></i> -->
                    <input type="hidden" class="form-control" name="email1" value="<?= $_SESSION['email']; ?>" id="nom" placeholder="Entrez votre nom complet" required>
                </div>
                
                <div class="mb-3 form-group">
                    <!-- <label for="email" class="form-label required-field">Adresse e-mail du destinateur</label>
                    <i class="fas fa-envelope input-icon"></i> -->
                    <input type="hidden" name="email" value="<?= $message['email']; ?>" class="form-control" id="email" placeholder="Entrez votre email" required>
                </div>
                
                <div class="mb-3 form-group">
                    <label for="objet" class="form-label required-field">objet</label>
                    <input type="text" name="objet" class="form-control" id="objet" placeholder="Saisissez l'objet du message" required>
                </div>
                
                <div class="mb-3">
                    <label for="message" class="form-label required-field">Message</label>
                    <textarea class="form-control" name="message" id="message" rows="4" placeholder="Entrez un message" required></textarea>
                </div>
                <button type="submit" class="btn btn-submit">Soumettre</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>