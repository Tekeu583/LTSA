<?php 
ob_start();
?>

<style>
        /* ----- Section 1 : Bannière Hero ----- */
        .hero-banner {
            width: 100%;
            height: 50vh;
            background-color: #ddd;
            background-image: url('public/img/labo.jpg');
            background-size: cover;
            background-position: center;
            margin-bottom: 3rem;
        }
        
        /* ----- Section 2 : Titre avec soulignement spécial ----- */
        .main-title-container {
            text-align: center;
            margin: 2rem 0;
        }
        
        .main-title {
            color: #044ab3;
            font-weight: bold;
            display: inline-block;
            position: relative;
            padding: 0px;
            font-size: 2.5rem;
        }
        
        .main-title::after {
            content: "";
            position: absolute;
            left: 0;
            right: 0;
            bottom: -3px;
            height: 3px;
            background:#044ab3;
        }
        
        /* ----- Section 3 : Cadre orange à gris pale ----- */
        .content-container {
            width: 85%;
            margin: 0 auto 5rem;
            background-color: #f9fcff;
            border: 3.5px solid #f3bd5a9c;
            padding: 1rem;
            border-radius: 8px;
            font-weight: 360PX;
        }
        
        /* Styles pour les sections de contenu */
        .section-block {
            margin-bottom: 3rem;
            position: relative;
            padding-left: 1.5rem;
            margin-left: -1.1% !important;
        }
        
        .section-block::before {
            content: "•";
            color: #ffa500;
            font-size: 4rem;
            position: absolute;
            left: -0.80% !important;
            top: -2.7rem !important;
        }
        
        .section-title {
            color: #000000;
            font-weight: bold;
            font-size: 15px;
            margin-bottom: 1.5rem;
            position: relative;
            padding-bottom: 8px;
        }
        
        .section-title::after {
            content: "";
            position: absolute;
            left: 0;
            right: 295px;
            bottom: 0.5px;
            height: 3px;
            top: 1.2rem;
            background: #0755ca;
        }
        
        /* Style tableau enseignants */
        .teacher-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1.5rem;
        }
        .teacher-table thead{
            background-color: #0755ca;
        }
        
        .teacher-table th {
            background-color: #0755ca;
            color: white;
            padding: 8px;
            text-align: left;
        }
        
        .teacher-table td {
            padding: 8px;
            border-bottom: 2px solid #7a858e;
        }
        
        .teacher-table tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        
        /* Style cartes partenaires */
        .partner-card {
            border: 3px solid #03c64e;
            border-radius: 8px;
            overflow: hidden;
            transition: all 0.3s ease;
            height: 100%;
            margin-bottom: 1.5rem;
        }
        
        .partner-card:hover {
            transform: scale(1.03);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);

        }
        
        .partner-img-container {
            height: 150px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background: white;
        }
        
        .partner-img {
            max-height: 100%;
            max-width: 100%;
            object-fit: contain;
        }
        
        .partner-title {
            padding: 1rem;
            text-align: center;
            background-color: #f8f9fa;
            font-weight: bold;
        }
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
    <!-- Section 1 : Bannière Hero -->
    <div class="hero-banner"></div>
    
    <!-- Section 2 : Titre principal -->
    <div class="main-title-container">
        <h1 class="main-title">À propos du LTSA</h1>
    </div>
    
    <!-- Section 3 : Contenu principal -->
    <div class=" container content-container">
        <!-- Section Historique -->
        <div class="section-block">
            <h2 class="section-title">Historique du LTSA</h2>
            <div class="section-content">
                <h4 class="mt-4"><strong>👉 Création et affiliation</strong></h4>
                <p>Le <span style="color:#04c14c">LTSA</span> créé en 2017 est un laboratoire de recherche appartenant à l'Unité de formation Doctorale Sciences Appliquées (UFD-SCA) de l'Ecole Doctorale des Sciences Fondamentales et Appliquées (ADOSFA) de l'Université de Douala (Udo).</p>
                <p>Il est hébergé à l'Institut Universitaire de Technologie (IUT) de Douala et bénéficie gracieusement des infrastructures de cet illustre établissement de l'Université de Douala.</p>
                <p>La promotion 2020-2021 en est la 3ème cuvée sortie de ce Labo.</p>
                <p>La Coordination du LTSA est Assurée par le <strong><span style="color:#04c14c">Pr DJANNA KOFFI Francis Lénine</span></strong> et secondé par le <strong><span style="color:#04c14c">Pr Vishiti AKUMBOM</span></strong>.</p>
                
                <h4 class="mt-4"><strong>👉 Sélection et Formation des étudiants</strong></h4>
                <p>Le LTSA forme en cycle Master Recherche ou M2R (ancien DEA) et en cycle Doctorat/PhD.</p>
                <p>Le recrutement se fait sur étude de dossier et le Diplôme requis est :</p>
                <ul>
                    <li>Pour le cycle M2R : Diplôme d'Ingénieur, Master 2 professionnel de technologie, DIPET 2, maitrise de Physique dans l'un des parcours du LTSA.</li>
                    <li>Pour le cycle Doctorat/PhD : Master 2 recherche ou DEA dans l'un des parcours du LTSA.</li>
                </ul>
                
                <h4 class="mt-4"><strong>👉 Résultats scientifiques</strong></h4>
                <ul>
                    <li><strong>Statistiques des diplômés :</strong> Environ 60 Master 2 et une douzaine de thèses de Doctorat/PhD soutenus depuis sa création.</li>
                    <li><strong>Production scientifique :</strong> Près d'une centaine d'articles scientifiques publiés dans des revues fortement indexées et visant la solution aux besoins du développement local.</li>
                    <li><strong>Deux brevets initiés.</strong></li>
                </ul>
                
                <h4 class="mt-4"><strong>👉 Ressources Humaines</strong></h4>
                <p>Le LTSA a à son sein :</p>
                <ul>
                    <li>09 Professeurs titulaires des Universités</li>
                    <li>12 Maîtres de Conférences</li>
                    <li>13 Chargés de cours</li>
                    <li>Une dizaine d'enseignants associés (Pr, MC, CC)</li>
                </ul>
                
                <h4 class="mt-4"><strong>👉 Première année de doctorat</strong></h4>
                <p>L'étudiant(e) doit participer minimum à 3 séminaires (national ou international) durant cette période. Chaque séminaire compte pour 5 crédits. L'étudiant(e) devrait faire un rapport de synthèse de chaque séminaire, et y ajouter les documents justifiants sa présence au séminaire.
                L'étudiant(e) doit participer aux enseignements de recherche méthodologie en présentiel afin de faire une revue de la littérature de leur thème de recherche. La recherche méthodologique correspond à 5 crédits répartis comme suit :</p>
                <p><hr> -l'enseignement propre dit 
                l'évolution de la revue de la littérature de l'étudiant(e) (notée par son/ses directeurs de thèse).
                Le tutorat se fait en l'absence du /des directeur(s) de thèse et avec un jury de 3 membres donc l'un est président. Le tutorat compte pour 20 crédits.</p>
                
                <h4 class="mt-4"><strong>👉 Deuxième année de doctorat</strong></h4>
                <p>L'étudiant(e) doit participer au moins à un colloque/conférence (national ou international) dans le domaine de sa thèse et publier un acte de colloque/conférence, ce qui compte pour 5 crédits. L'acte de colloque/conférence doit obligatoirement être issu de sa thèse.
                L'étudiant(e) doit publier un article (minimum) dans un journal scientifique, ce qui compte pour 10 crédits. L'article doit obligatoirement être issu de sa thèse.
                Il est important de noter que l'acte de colloque/conférence et/ou l'article doit être indexé SCOPUS, c'est-à-dire faire partir des colloque/conférence et/ou journaux reconnu par SCOPUS (www.scopus.com).
                Le tutorat se fait en l'absence du /des directeur(s) de thèse et avec un jury de 3 membres donc l'un est président. Le tutorat compte pour 15 crédits.</p>
                
                <h4 class="mt-4"><strong>👉 Troisième année de doctorat</strong></h4>
                <p>Hormis les procédures administratives, la troisième année de doctorat est consacrée à la rédaction est à la soutenance de la thèse de doctorat de l'étudiant(e), soit 120 crédits.</p>
                
                <h4 class="mt-4"><strong>👉 Eligibilite</strong></h4>
                <p><strong>Cycle de Master 2 recherche</strong></p>
                <p>Etre titulaire d'un niveau de master 1 (équivalent de la maîtrise dans l'ancien système) en mathématique, physique.
                Etre titulaire d'un diplôme d'ingénieur, PLET, PLEG
                Etre titulaire d'un diplôme de master de Technologie dans l'une des spécialités du laboratoire ou son équivalent.</p>
                
                <h4 class="mt-4"><strong>👉 Cycle de doctorat</strong></h4>
                <p>Etre titulaire d'un diplôme de master 2 recherche (équivalent du DEA dans l'ancien système) dans l'une des spécialités du laboratoire ou son équivalent.</p>
            </div>
        <!-- Section Pôles d'expertise -->
        <div class="section-block">
            <h2 class="section-title">Pôles d'expertise notre laboratoire</h2>
            <div class="section-content">
                <p>Le LTSA a en son sein six options ou spécialités suivantes :</p>
                <ul class="expertise-list">
                    <li><strong>ENERGETIQUE</strong></li>
                    <li><strong>MECANIQUE</strong></li>
                    <li><strong>GENIE CIVIL ET BIOTECHNOLOGIE</strong></li>
                    <li><strong>ELECTRONIQUE, ELECTROTECHNIQUE, AUTOMATISME ET TELECOMMUNICATION (EEAT)</strong></li>
                    <li><strong>GENIE INDUSTRIEL ET MAINTENANCE (GIM)</strong></li>
                    <li><strong>GEOTECHNOLOGIE</strong></li>
                </ul>
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="teacher-table table table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="text-center">N°</th>
                        <th>Noms et Prénoms</th>
                        <th>Grade</th>
                        <th>Fonction</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Ligne 1 -->
                    <tr>
                        <td class="text-center">1</td>
                        <td>MOUKENGUE IMANO Adolph</td>
                        <td>Professeur Titulaire</td>
                        <td></td>
                    </tr>
                    <!-- Ligne 2 -->
                    <tr>
                        <td class="text-center">2</td>
                        <td>ELE Pierre</td>
                        <td>Professeur Titulaire</td>
                        <td></td>
                    </tr>
                    <!-- Ligne 3 -->
                    <tr>
                        <td class="text-center">3</td>
                        <td>MOUANGUE RUBEN</td>
                        <td>PROFESSEUR TITULAIRE</td>
                        <td>DIRECTEUR ENSPD</td>
                    </tr>
                    <!-- Ligne 4 -->
                    <tr>
                        <td class="text-center">4</td>
                        <td>DJAKOMO ESSIANE SALOMÉ</td>
                        <td>PROFESSEUR TITULAIRE</td>
                        <td>DIRECTEUR ENSET DOUALA</td>
                    </tr>
                    <!-- Ligne 5 -->
                    <tr>
                        <td class="text-center">5</td>
                        <td>TAMBA JEAN GASTON</td>
                        <td>PROFESSEUR TITULAIRE</td>
                        <td>DIRECTEUR ESTLC_AMBAM</td>
                    </tr>
                    <!-- Ligne 6 -->
                    <tr>
                        <td class="text-center">6</td>
                        <td>DJANNA KOFFI Francis Lénine</td>
                        <td>PROFESSEUR TITULAIRE</td>
                        <td>Coordonnateur Adjoint LTSA</td>
                    </tr>
                    <!-- Ligne 7 -->
                    <tr>
                        <td class="text-center">7</td>
                        <td>MONKAM Louis</td>
                        <td>PROFESSEUR TITULAIRE</td>
                        <td>Coordonnateur Adjoint UFD-SCA</td>
                    </tr>
                    <!-- Ligne 8 -->
                    <tr>
                        <td class="text-center">8</td>
                        <td>KOM Charles Hubert</td>
                        <td>PROFESSEUR TITULAIRE</td>
                        <td></td>
                    </tr>
                    <!-- Ligne 9 -->
                    <tr>
                        <td class="text-center">9</td>
                        <td>DZONDE NAOUSSI Serge Raoul</td>
                        <td>PROFESSEUR TITULAIRE</td>
                        <td></td>
                    </tr>
                    <!-- Ligne 10 -->
                    <tr>
                        <td class="text-center">10</td>
                        <td>ESSIBEN DIKOUNDOU Jean-François</td>
                        <td>Maître de Conférences</td>
                        <td></td>
                    </tr>
                    <!-- Ligne 11 -->
                    <tr>
                        <td class="text-center">11</td>
                        <td>YAMB BELL Emmanuel</td>
                        <td>Maître de Conférences</td>
                        <td></td>
                    </tr>
                    <!-- Ligne 12 -->
                    <tr>
                        <td class="text-center">12</td>
                        <td>KANA'A Thomas</td>
                        <td>Maître de Conférences</td>
                        <td></td>
                    </tr>
                    <!-- Ligne 13 -->
                    <tr>
                        <td class="text-center">13</td>
                        <td>KOMBE Timothée</td>
                        <td>Maître de Conférences</td>
                        <td>Directeur Adjoint IBA de Nkonsamba</td>
                    </tr>
                    <!-- Ligne 14 -->
                    <tr>
                        <td class="text-center">14</td>
                        <td>MENGATA MENGOUNOU Ghislain</td>
                        <td>Maître de Conférences</td>
                        <td>Adjoint IUT de Douala</td>
                    </tr>
                    <!-- Ligne 15 -->
                    <tr>
                        <td class="text-center">15</td>
                        <td>ONGUENE Raphaël</td>
                        <td>Maître de Conférences</td>
                        <td></td>
                    </tr>
                    <!-- Ligne 16 -->
                    <tr>
                        <td class="text-center">16</td>
                        <td>KOUMI NGOH Simon</td>
                        <td>Maître de Conférences</td>
                        <td></td>
                    </tr>
                    <!-- Ligne 17 -->
                    <tr>
                        <td class="text-center">17</td>
                        <td>ZOGO TSALA Simon Armand</td>
                        <td>Maître de Conférences</td>
                        <td></td>
                    </tr>
                    <!-- Ligne 18 -->
                    <tr>
                        <td class="text-center">18</td>
                        <td>KOUSKE Arnaud Patrice</td>
                        <td>Maître de Conférences</td>
                        <td></td>
                    </tr>
                    <!-- Ligne 19 -->
                    <tr>
                        <td class="text-center">19</td>
                        <td>AKUMBON VISHITI</td>
                        <td>Maître de Conférences</td>
                        <td></td>
                    </tr>
                    <!-- Ligne 20 -->
                    <tr>
                        <td class="text-center">20</td>
                        <td>MOUZONG PEMI Marcelin</td>
                        <td>Maître de Conférences</td>
                        <td></td>
                    </tr>
                    <!-- Ligne 21 -->
                    <tr>
                        <td class="text-center">21</td>
                        <td>MOUNGNUTOU MFETOUM Inoussah</td>
                        <td>Maître de Conférences</td>
                        <td></td>
                    </tr>
                    <!-- Ligne 22 -->
                    <tr>
                        <td class="text-center">22</td>
                        <td>EPESSE MISSE Samuel</td>
                        <td>Chargé de Cours</td>
                        <td></td>
                    </tr>
                    <!-- Ligne 23 -->
                    <tr>
                        <td class="text-center">23</td>
                        <td>NKAPKOP Jean De Dieu</td>
                        <td>Chargé de Cours</td>
                        <td></td>
                    </tr>
                    <!-- Ligne 24 -->
                    <tr>
                        <td class="text-center">24</td>
                        <td>NDAME NGUANGUE Max Keller</td>
                        <td>Chargé de Cours</td>
                        <td></td>
                    </tr>
                    <!-- Ligne 25 -->
                    <tr>
                        <td class="text-center">25</td>
                        <td>MANDENG Jean Jacque</td>
                        <td>Chargé de Cours</td>
                        <td></td>
                    </tr>
                    <!-- Ligne 26 -->
                    <tr>
                        <td class="text-center">26</td>
                        <td>DIBOMA Benjamin</td>
                        <td>Chargé de Cours</td>
                        <td></td>
                    </tr>
                    <!-- Ligne 27 -->
                    <tr>
                        <td class="text-center">27</td>
                        <td>MBOUH TIAYA Elvis</td>
                        <td>Chargé de Cours</td>
                        <td></td>
                    </tr>
                    <!-- Ligne 28 -->
                    <tr>
                        <td class="text-center">28</td>
                        <td>SAPNKEN Emmanuel Flavien</td>
                        <td>Chargé de Cours</td>
                        <td></td>
                    </tr>
                    <!-- Ligne 29 -->
                    <tr>
                        <td class="text-center">29</td>
                        <td>GUEFANO SERGE</td>
                        <td>Chargé de Cours</td>
                        <td></td>
                    </tr>
                    <!-- Ligne 30 -->
                    <tr>
                        <td class="text-center">30</td>
                        <td>KIONG MARIUS TONY</td>
                        <td>Chargé de Cours</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <!-- Section Partenaires -->
        <div class="section-block">
            <h2 class="section-title">Nos partenaires</h2>
            <div class="row">
                <!-- Carte Partenaire 1 -->
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
                    <div class="partner-card">
                        <div class="partner-img-container">
                            <img src="public/img/ENSET.png" alt="ENSET Douala" class="partner-img">
                        </div>
                        <div class="partner-title">
                            ECOLE NORMALE SUPERIEURE DE L'ENSEIGMENT TECHNIQUE DE DOUALA
                        </div>
                    </div>
                </div>
                
                <!-- Carte Partenaire 2 -->
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
                    <div class="partner-card">
                        <div class="partner-img-container">
                            <img src="public/img/ENSPD.png" alt="ENSPD" class="partner-img">
                        </div>
                        <div class="partner-title">
                            ECOLE NORMALE SUPERIEURE POLYTECHNIQUE DE DOUALA
                        </div>
                    </div>
                </div>
                
                <!-- Carte partenaire 3 -->
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
                    <div class="partner-card">
                        <div class="partner-img-container">
                            <img src="public/img/ESTLC.png" alt="ESTLC_AMBAM" class="partner-img">
                        </div>
                        <div class="partner-title">
                            ECOLE SUPERIEURE DE TRANSPORT ,LOGISTIQUE ET COMMERCE
                        </div>
                    </div>
                </div>

                <!-- Carte partenaire 4 -->
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
                    <div class="partner-card">
                        <div class="partner-img-container">
                            <img src="public/img/ESTLC.png" alt="ESTLC_AMBAM" class="partner-img">
                        </div>
                        <div class="partner-title">
                            ECOLE SUPERIEURE DE TRANSPORT ,LOGISTIQUE ET COMMERCE
                        </div>
                    </div>
                </div>

                <!-- Carte partenaire 5 -->
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
                    <div class="partner-card">
                        <div class="partner-img-container">
                            <img src="public/img/IUT.png" alt="IUT_DLA" class="partner-img">
                        </div>
                        <div class="partner-title">
                            INSTITUT UNIVERSITAIRE DES TECHNOLOGIES DE DOUALA
                        </div>
                    </div>
                </div>

                <!-- Carte partenaire 6 -->
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
                    <div class="partner-card">
                        <div class="partner-img-container">
                            <img src="public/img/UD.png" alt="LOGO_UD" class="partner-img">
                        </div>
                        <div class="partner-title">
                            UNIVERSITE DE DOUALA
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Bouton "Retour en haut" -->
    <button id="backToTop" class="back-to-top-btn" aria-label="Retour en haut">
        ↑
    </button>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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