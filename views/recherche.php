<?php 
ob_start();
?>

<p>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grille de Recherches</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* ----- Section 1 : Bannière bleue ----- */
        .hero-banner {
            background-color: #063882;
            color: white;
            height: 20vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            margin-bottom: 3rem;
        }
        
        /* ----- Section 2 : Titres + flèche ----- */
        .research-header {
            margin-bottom: 3rem;
            padding-left: 1rem;
            color: #063882;
        }
        
        .main-title {
            position: relative;
            display: inline-block;
            padding-bottom: 8px;
            margin-bottom: 0.8rem;
            height: 2.1rem;
            width:40%;
            font-weight: bold;
        }

        .main-title::after{
        content: "";
        position: absolute;
        left: 0.025cm;
        right:-10%;
        bottom:0;
        height: 4.5px;
        background: #ffa500;
        width: 120%;
        }
        
        .subtitle {
            display: inline-block;
            margin-left: 1rem;
            font-weight: bold;
        }
        
        .dropdown-arrow {
            display: inline-block;
            background-color: #ffa500;
            width: 25px;
            height: 25px;
            text-align: center;
            line-height: 20px;
            color: rgb(0, 0, 0);
            font-size: 23px;
            cursor: pointer;
            left: -0.10cm;
            transform: translateY(15%);
            transition: transform 0.5s;
        }
        
        .dropdown-arrow.rotated {
            transform: rotate(90deg);
        }
        
        /* Menu déroulant des titres */
        .title-dropdown {
            position: absolute;
            background: rgb(224, 225, 226);
            border: 1px solid #ffa704;
            width: 300px;
            z-index: 100;
            display: none;
            margin-top: 5px;
        }
        
        .title-dropdown a {
            display: block;
            padding: 10px;
            color: #333;
            text-decoration: none;
        }
        
        .title-dropdown a:hover {
            background-color: #f8f9fa;
        }
        
        /* ----- Section 3 : Contenu avec ancres ----- */
        .research-item {
            margin-bottom: 4rem;
            padding-left: 2rem;
            scroll-margin-top: 20px; /* Évite que le titre soit caché sous la navbar */
        }
        
        .research-item h3 {
            font-weight: bold;
            margin-bottom: 1.5rem;
        }
    </style>
</head>
<body>
    <!-- Section 1 : Bannière bleue -->
    <div class="hero-banner">
        <h1>Bienvenue sur la grille de nos Recherches et détails</h1>
    </div>
    
    <div class="container">
        <!-- Section 2 : Titres + flèche interactive -->
        <div class="research-header">
            <h2 class="main-title">Recherches</h2>
            <div style="display: block;">
                <h3 class="subtitle">Sujets de recherches</h3>
                <div class="dropdown-arrow" id="dropdownArrow">→</div>
            </div>
            
            <!-- Menu déroulant cliquable -->
            <div class="title-dropdown" id="titleDropdown">
                <a href="#visionparordinateur" class="dropdown-item">Vision par ordinateur et reconnaissance des formes</a>
                <a href="#apprentissage" class="dropdown-item">Apprentissage profond</a>
                <a href="#sciences humaines" class="dropdown-item">Sciences humaines numeriques</a>
                <a href="#machine" classe="dropdown-item">Interaction homme-machine</a>
                <a href="#medias" class="dropdown-item">Analse des medias sociaux</a>
                <a href="#projets" class="dropdown-item">Projets</a>
            </div>
        </div>
        
        <!-- Section 3 : Contenu avec ancres -->
        <div class="research-content">
            <!-- Item 1 -->
            <div class="research-item" id="visionparordinateur">
                <h3>Vision par ordinateur et reconnaissance des formes</h3>
                <div class="research-description">
                    <p>je me rappele que le cntenu doit etre charge en back-end.</p>
                    <!-- genre text et image ou video correspondantes -->
                    <iframe width="100%" height="315" src="https://www.youtube.com/embed/dQw4w9WgXcQ" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
            
            <!-- Item 2 -->
            <div class="research-item" id="Apprentissane">
                <h3>Apprentissage profond</h3>
                <div class="research-description">
                    <p>Contenu chargé dynamiquement ici...</p>
                    <!-- Exemple de vidéo -->
                    <iframe width="100%" height="315" src="https://www.youtube.com/embed/dQw4w9WgXcQ" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
            
            <!-- Item 3 -->
            <div class="research-item" id="Science humaines">
                <h3>Sciences humaines numeriques</h3>
                <div class="research-description">
                    <p>Contenu chargé dynamiquement ici...</p>

                    <iframe width="100%" height="315" src="https://www.youtube.com/embed/dQw4w9WgXcQ" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>

 <!-- Item 4 -->
 <div class="research-item" id="machine">
    <h3>Interaction Homme-machine</h3>
    <div class="research-description">
        <p>Contenu chargé dynamiquement ici...</p>
        <iframe width="100%" height="315" src="https://www.youtube.com/embed/dQw4w9WgXcQ" frameborder="0" allowfullscreen></iframe>
    </div>

        </div>

<!-- Item 5 -->
<div class="research-item" id="medias">
    <h3>Analyse des medias sociaux</h3>
    <div class="research-description">
        <p>Contenu chargé dynamiquement ici...</p>
        <iframe width="100%" height="315" src="https://www.youtube.com/embed/dQw4w9WgXcQ" frameborder="0" allowfullscreen></iframe>
    </div>

        </div>

<!-- Item 6 -->
<div class="research-item" id="Projets">
    <h3>Projets</h3>
    <div class="research-description">
        <p>Contenu chargé dynamiquement ici...</p>
        <iframe width="100%" height="315" src="https://www.youtube.com/embed/dQw4w9WgXcQ" frameborder="0" allowfullscreen></iframe>
    </div>

        </div>

    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Gestion de la flèche et du menu déroulant
        document.getElementById('dropdownArrow').addEventListener('click', function() {
            this.classList.toggle('rotated');
            const dropdown = document.getElementById('titleDropdown');
            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        });

        // Ferme le menu si on clique ailleurs
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.research-header')) {
                document.getElementById('titleDropdown').style.display = 'none';
                document.getElementById('dropdownArrow').classList.remove('rotated');
            }
        });

        // Scroll fluide vers les ancres
        document.querySelectorAll('.title-dropdown a').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                document.querySelector(targetId).scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
                // Ferme le menu après clic
                document.getElementById('titleDropdown').style.display = 'none';
                document.getElementById('dropdownArrow').classList.remove('rotated');
            });
        });
    </script>

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
        background-color: #095edd; /* Bleu Bootstrap */
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 20px;
        cursor: pointer;
        opacity: 0;
        transition: opacity 0.3s;
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