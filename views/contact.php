<?php
ob_start();
?>
    <style>
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
                Contactez-nous !
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
            <h2 class="form-title"><center>Formulaire de contact</center></h2>
            
            <form method="POST" action="index.php?page=contact/send" id="contactForm">
                <div class="mb-3 form-group">
                    <label for="nom" class="form-label required-field">Nom</label>
                    <i class="fas fa-user input-icon"></i>
                    <input type="text" class="form-control" name="nom" id="nom" placeholder="Entrez votre nom complet" required>
                </div>
                
                <div class="mb-3 form-group">
                    <label for="email" class="form-label required-field">Adresse e-mail</label>
                    <i class="fas fa-envelope input-icon"></i>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Entrez votre email" required>
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
<?php
 $content=ob_get_clean();
 require("template.php");
?>