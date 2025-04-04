<?php 
ob_start();
?>

<p>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A propos du LTSA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* ----- Section 1 : Image d'en-tête (à personnaliser) ----- */
        .header-image {
            width: 100%;
            height: 40vh; /* Ajuste la hauteur selon ton image */
            background-color: #ddd; /* Remplace par ton image */
            background-size: cover;
            background-position: center;
            margin-bottom: 2rem;
        }

        /* ----- Section 2 : Titre centré avec soulignement "manuel" ----- */
        .title-section {
            text-align: center;
            margin-bottom: -0.9%;
            position: relative;
            padding-bottom: 10px; /* Espace sous le titre */
        }
        
        .title-section h1 {
            color: #0755ca; /* Bleu Bootstrap */
            font-weight: bold;
            display: inline-block;
            position: relative;
            padding: 10 15px; /* Pour éviter que la ligne touche les lettres */
        }
        
        /* Soulignement qui évite les "p" */
        .title-section h1::after {
            content: " ";
            position: absolute;
            left: 0;
            right: 0;
            bottom: -1.5px; /* Ajuste la position verticale */
            height: 2.5px; /* Épaisseur du trait */
            background: #91fd0d;
            /* Masque le trait sous les "p" */
            background: linear-gradient(90deg, 
                #0d6efd 0%, 
                #0d6efd 5.5rem, 
                transparent 33%, 
                transparent 6.5rem, 
                #0d6efd 40%, 
                #0d6efd 100px);
        }

        /* ----- Section 3 : Cadre gris/orange avec listes ----- */
        .content-box {
            background-color: #f2f5f5; /* Gris léger */
            border: 3.5px solid #f3bd5a9c; /* Bordure orange gauche */
            padding: 2.5rem;
            margin-bottom: 7rem;
            min-height: 70vh; /* Recouvre 90% de la section */
        }
        
        /* Style des items (titre + description) */
        .custom-list {
            list-style-type: none;
            padding-left: 0.2%;
        }
        
        .custom-list li {
            position: relative;
            padding-left: -1rem; /* Espace pour le point orange */
            margin-bottom: 10rem;
        }
        
        /* Gros point orange devant les titres */
        .custom-list li::before {
            content: "•";
            color: #ffa500;
            font-size: 4rem; /* Taille ajustable */
            position: absolute;
            left: -0.990cm;
            top: -38px;
        }
        
        /* Titres en gras avec barre bleue débordante */
        .custom-list h3 {
            font-weight: bold;
            display: inline-block;
            position: relative;
            margin-bottom: 1rem;
            padding-bottom: 5px;
        }
        
        /* Barre bleue qui dépasse de 10cm */
        .custom-list h3::after {
            content: "";
            position: absolute;
            left: 0.7%; /* Débordement gauche */
            right: -50px; /* Débordement droit */
            bottom: 0;
            height: 3px; /* Épaisseur ajustable */
            background: #0755ca;
            z-index: 1;
        }

        /* ----- Section "Nous contacter" ----- */
        .contact-table {
            width: 100%;
            margin-top: 2rem;
            border-collapse: collapse;
        }
        
        .contact-table td {
            padding: 0.5rem;
            vertical-align: top;
            border: 1px solid #dee2e6;
        }
    </style>
</head>
<body>
    <!-- Section 1 : Image d'en-tête (à personnaliser) -->
    <div class="header-image" style="background-image: url('labo.jpg');"></div>
    
    <div class="container">
        <!-- Section 2 : Titre "À propos du LTSA" -->
        <div class="title-section">
            <h1>A propos du LTSA</h1>
        </div>
        
        <!-- Section 3 : Cadre gris/orange avec contenu -->
        <div class="content-box">
            <ul class="custom-list">
                <li>
                    <h3>Historique du LTSA</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                </li>
                
                <li>
                    <h3>Poles d’expertise notre laboratoire</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                </li>
                
                <li>
                    <h3>Nos partenaires</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                </li>
            </ul>
        </div>
        

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Bouton "Retour en haut" -->
<button id="backToTop" class="back-to-top-btn" aria-label="Retour en haut">
    ↑
</button>

<style>
    /* Style du bouton */
    .back-to-top-btn {
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 30px;
        height: 30px;
        background-color: #064db8; /* Bleu Bootstrap */
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 20px;
        cursor: pointer;
        opacity: 0;
        transition: opacity 0.5s;
        z-index: 999;
    }
    
    .back-to-top-btn.visible {
        opacity: 1;
    }
    
    .back-to-top-btn:hover {
        background-color: #0b5ed7; /* Bleu plus foncé */
    }
</style>

<script>
    // Affiche/masque le bouton selon la position de scroll
    window.addEventListener('scroll', function() {
        const backToTopBtn = document.getElementById('backToTop');
        if (window.pageYOffset > 300) {
            backToTopBtn.classList.add('visible');
        } else {
            backToTopBtn.classList.remove('visible');
        }
    });
    
    // Scroll vers le haut au clic
    document.getElementById('backToTop').addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
</script>

</body>
</html>
</h1>

<?php
$content=ob_get_clean();
require("template.php");
?>