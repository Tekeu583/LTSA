<?php 
ob_start();
?>

<p>
   
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
                <a href="#vision" class="dropdown-item">Vision par ordinateur et reconnaissance des formes</a>
                <a href="#domaines" class="dropdown-item">Domaines de recherches</a>
                <a href="#mecanique" class="dropdown-item">Mecanique</a>
                <a href="#genigeo" classe="dropdown-item">Génie Civil et Géotechnologie</a>
                <a href="#elec" class="dropdown-item">Electronique, Electrotechnique etc</a>
                <a href="#energetique" class="dropdown-item">Energetique</a>
            </div>
        </div>
                </div>
            </div>
            
         <!-- Section 1 - Vision et positionnement scientifique -->
<!-- Section 1 - Vision et positionnement scientifique -->
<div class="research-item" id="vision">
    <h3><span class="badge bg-primary me-2">🔭</span> Vision et positionnement scientifique</h3>
    <div class="research-description">
        <!-- Contenu inchangé -->
    </div>
</div>

<!-- Section 2 - Domaines de recherche -->
<div class="research-item" id="domaines">
    <h3><span class="badge bg-primary me-2">🧪</span> Domaines de recherche</h3>
    <div class="research-description">
        <p class="domain-intro">Le LTSA développe des recherches appliquées dans quatre spécialités scientifiques majeures :</p>
        
        <!-- Domaine 1 - Mécanique -->
        <div class="research-item" id="mecanique">
            <h3><span class="badge bg-primary me-2">⚙️</span> Mécanique</h3>
            <div class="research-description">
                <p>Notre département mécanique se concentre sur :</p>
                <ul>
                    <li>Conception et modélisation des systèmes mécaniques</li>
                    <li>Analyse des performances et fiabilité</li>
                    <li>Maintenance prédictive et amélioration continue</li>
                </ul>
                <p>Nos recherches visent à développer des solutions mécaniques adaptées aux besoins industriels locaux.</p>
            </div>
        </div>
        
        <!-- Domaine 2 - Génie Civil et Géotechnologie -->
        <div class="research-item" id="genigeo">
            <h3><span class="badge bg-primary me-2">🏗️</span> Génie Civil et Géotechnologie</h3>
            <div class="research-description">
                <p>Face aux défis du changement climatique et de l'urbanisation, notre département développe :</p>
                <ul>
                    <li>Des méthodes avancées d'évaluation des risques naturels</li>
                    <li>Des techniques innovantes de collecte et traitement de données géotechniques</li>
                    <li>Des modèles numériques pour l'aménagement territorial résilient</li>
                </ul>
                <div class="research-focus">
                    <span style="color: #ffa500;"><h5>Zones d'étude :</h5></span>
                    <p>Nos travaux couvrent l'atmosphère, les surfaces continentales, les zones marines côtières et le subsurface, avec une attention particulière sur la gestion intégrée des ressources en eau.</p>
                </div>
            </div>
        </div>
        
        <!-- Domaine 3 - Electronique et Télécoms -->
        <div class="research-item" id="elec">
            <h3><span class="badge bg-primary me-2">📡</span> Electronique, Electrotechnique, Automatique et Télécommunications</h3>
            <div class="research-description">
                <p>Ce département pluridisciplinaire couvre :</p>
                <div class="subdomains">
                    <div class="subdomain">
                        <h5>Conception électronique :</h5>
                        <p>Prototypage matériel et logiciel de systèmes instrumentaux avancés</p>
                    </div>
                    <div class="subdomain">
                        <h5>Énergie et automatisme :</h5>
                        <p>Optimisation des systèmes électriques et commande avancée</p>
                    </div>
                    <div class="subdomain">
                        <h5>Traitement du signal :</h5>
                        <p>Techniques innovantes d'acquisition et traitement d'images</p>
                    </div>
                </div>
                <p class="impact-statement">Nos recherches contribuent notamment au développement de solutions énergétiques durables basées sur les énergies renouvelables.</p>
            </div>
        </div>
        
        <!-- Domaine 4 - Energétique -->
        <div class="research-item" id="energetique">
            <h3><span class="badge bg-primary me-2">⚡</span> Energétique</h3>
            <div class="research-description">
                <p>Nos travaux en énergétique s'articulent autour de trois axes :</p>
                <ol>
                    <li>Conception de systèmes énergétiques optimisés</li>
                    <li>Modélisation des flux énergétiques complexes</li>
                    <li>Prospective énergétique et scénarios de transition</li>
                </ol>
                <p>Nous développons des solutions adaptées au contexte africain, combinant efficacité énergétique et accessibilité.</p>
            </div>
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
<?php
$content=ob_get_clean();
require("template.php");
?>