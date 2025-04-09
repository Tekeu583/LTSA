<?php 
ob_start();
?>
    <style type="text/css" id="dcoder_stylesheet">/* Définition des couleurs */
      :root {
        --color-bleu-clair: #323597; /* Adjusted to match image */
        --color-bleu-fonce: #211F59;
        --color-vert: #41CF41;
        --color-orange: #F8B72F;
        --bg-white: #FCFCFC;
        --text-black: #000000;
        --text-white: #FFFFFF;
        --bg-input: #8592A2;
      }

      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: Poppins, Roboto;
      }

      body {
        background-color: var(--bg-white);
        color: var(--text-black);
      }


      /* Présentation */
      #presentation {
        text-align: center;
        background: var(--color-bleu-fonce);
        color: var(--text-white);
        padding: 40px 20px;
        width: 100%;
        position: relative;
        z-index: 1;
        height: 430px;  
      }

      #presentation h2 {
        font-size: 2.5em; /* Increased heading size */
        margin-bottom: 15px;
        font-weight: bold; /* Made heading bold */
      }

      #texte_presentation h6 {
        font-size: 1.1em;
        font-style: italic;
        margin-bottom: 30px;
        color: #ddd; /* Slightly lighter text */
      }

      #texte_presentation p {
        color: var(--text-white);
        max-width: 85%; /* Reduced max-width for a wider paragraph */
        margin: 20px auto;
        font-size: 1.1rem;
        line-height: 1.8;
        
      }

      .accolade {
        color: var(--color-orange);
        font-size: 1.3em;
      }

      .savoir-plus-container {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 20px;
      }

      .savoir-plus-container img {
        width: 20px; 
        height: 20px;
        vertical-align: middle;
        margin-right: 8px;
        filter: brightness(0) invert(1);
      }

      .savoir-plus-container a.texte_petit {
        color: var(--color-orange); 
        text-decoration: none;
        font-weight: bold;     
      }

      .savoir-plus-container a.texte_petit:hover {
        text-decoration: underline;
      }


      #carreaux_presentation {
        background-color: var(--color-white);
        padding: 0 20px;
        width: 100%;
        position: relative;
        top: -50px;
        margin-top: 10px;
        z-index: 2;
        
      }
      .stats-section {
        display: flex;
        justify-content: center;
        align-items: stretch;
        max-width: 1200px;
        margin: 0 auto;
        gap: 25px;
        flex-wrap: wrap;
      
      }

      .stat-card {
        background: var(--bg-white);
        width: calc(25% - 20px); 
        min-width: 200px; 
        padding: 30px 20px;
        text-align: center;
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
        justify-content: center; 
        align-items: center;
      }

      .stat-card .icon {
        width: 25px; 
        height: 25px;
        background-color: var(--color-orange);
        border-radius: 50%;
        
      }

      .stat-card p {
        font-size: 1em;
        color: var(--text-black);
        margin-bottom: 10px;
        height: 100px;
        padding-top: 30px;
        
        text-align: center;
      }


      .green-line {
        width: 60px;
        height: 4px;
        background-color: var(--color-vert);
        margin: 15px auto;
      }

      .stat-card span {
        font-size: 0.9em;
        font-weight: bold;
        display: block;
        color: var(--text-black);
        margin-top: 15px;
      }
      .section-hero {
        background-image: linear-gradient(to top, #333366, #778899); 
        color: #ffffff; 
        padding: 100px 20px; 
        text-align: center; 
      
      }

      .contenu-hero {
        max-width: 800px; 
        margin: 0 auto; 
      }

      h1 {
        font-size: 2.5em; 
        font-weight: bold;
        margin-bottom: 20px;
      }

      p {
        font-size: 1.2em;
        margin-bottom: 30px; 
      }

      .bouton-decouvrir {
        background-color: transparent; 
        color: #F8B72F;
        border: 2px solid #F8B72F; 
        padding: 15px 30px; 
        text-decoration: none; 
        border-radius: 5px; 
        font-size: 1em;
        cursor: pointer; 
        transition: background-color 0.3s ease; 
      }

      .bouton-decouvrir:hover {
        background-color: #F8B72F; 
        color: #333333; 
      }


      /* Section Publications */
      #publications {
        padding: 50px 10px;
        vertical-align: middle;
        text-align: center;  align-items: center;
        background-color: var(--bg-white); 
      }

      #publications h2 {
        font-size: 2em;
        color: var(--color-bleu-fonce);
        margin-bottom: 10px;
        left: 40px;
      }

      .publication-subtitle {
        color: #777;
        margin-bottom: 30px;
        
      }



      .contain{
        width:100%;
        min-height: 440px;
        display: flex;
      flex-direction: row;
      justify-content: flex-start;
      margin-top: 50px;
      }
      .shadow-effect {
        position: absolute;
        width: 85%;
        min-height: 150px;
        border-radius: 5px; 
        background-color: #211F59; 
        top: 15px;
        }

      .shadow-effect-left {
        position: absolute;
        left: 85px;
        top: 0px;
        width: 83%;
        min-height: 150px;
        border: 1px solid black;
        border-radius: 5px; 
        background-color : white; 
        }
        
      .shadow-effect-left:hover{
        top: 15px;
        left: 65px;
        width: 85%;
            transition: top 0.3s ease-in-out, left 0.3s ease-in-out, width 0.3s ease-in-out, min-height 0.3s ease-in-out; /* Added transitions */
      }
      .shadow-effect-left:hover + .shadow-effect {
        display: none;
      }
      .shadow-box{
        display: flex;
        position: relative ;
          justify-content: center;
          width: 100%;
        align-items: center;
        min-height: 220px; 
        background-color: #fff; 
      }
      .conteneur{
        min-height: 440px;
        background-color: #fdfdfd;
        width: 90%;
      }
      .container {
                  display: flex;
                  flex-direction: column;
                  align-items: center;
                  width: 10%;
                  min-height: 440px;
                  }                    

              .bar {
                  width: 5px;
                  background-color: black;
              }

              .top-bar {
                background-color: black;
                  height: 170px;
              }

              .middle-bar {
                  background-color: black;
                  height: 170px; 
              }

              .circle {
                
                  width: 30px; 
                  height: 30px; 
                  background-color: #F8B72F;
                  border-radius: 50%; 
                  margin-bottom: 0px; 
                  margin-top: 0px; 
              }

              .top-circle {
                  margin-bottom: 0px;
              }


      /* Section Événements */
      #evenements {
        padding: 50px 20px;
        text-align: center;
        background-color: #f0f0f0; 
      }

      #evenements h2 {
        font-size: 2em;
        color: var(--color-bleu-fonce);
        margin-bottom: 10px;
      }

      .evenements-subtitle {
        color: #777;
        margin-bottom: 30px;
      }

      .evenements-carousel {
        display: flex;
        gap: 20px;
        overflow-x: auto; 
        padding: 20px;
        max-width: 100%;
      }

      .evenement-card {
        background-color: var(--bg-white);
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        min-width: 300px; 
        padding: 20px;
        text-align: left;
      }

      .evenement-card h3 {
        font-size: 1.3em;
        color: var(--color-bleu-fonce);
        margin-bottom: 10px;
      }

      .evenement-card .date {
        color: #555;
        font-size: 0.9em;
        margin-bottom: 15px;
      }

      .evenement-card p {
        color: var(--text-black);
        line-height: 1.6;
        margin-bottom: 15px;
      }

      .event-image {
        width: 100%;
        border-radius: 5px;
        overflow: hidden;
        margin-bottom: 15px;
      }

      .event-image img {
        width: 100%;
        display: block;
        height: auto;
      }

      .evenement-card .more-info {
        color: var(--color-orange);
        font-weight: bold;
      }




      @media (max-width: 768px) {
        
        
      
        #evenements {
          padding: 40px 15px;
        }
        .evenements-carousel {
          padding: 15px;
        }
        
          .evenement-card {
          width: 90%;
          display: flex ;
          flex-direction: column ;
        }
        


      @media (max-width: 480px) {
        
        #publications h2 {
          font-size: 1.8em;
        }
        #evenements h2 {
          font-size: 1.8em;
        }
        
      }

        #presentation h2 {
          font-size: 1.8em;
        }
        #texte_presentation h6 {
          font-size: 1em;
        }
        #texte_presentation p {
          font-size: 0.9rem;
        }
      }
    </style>

  <section id="presentation"> 
    <div> 
        <div id="texte_presentation"> 
          <h2>BIENVENUE AU LTSA</h2> 
          <h6><span class="accolade">"</span>Explorer, innover, transformer le futur de la science et de la technologie<span class="accolade">"</span></h6> 
          <p class="paragraphe"> Le LTSA créé en 2017 est un laboratoire de recherche appartenant à l'Unité de formation Doctorale Sciences Appliquées (UFD-SCA) de l'Ecole Doctorale de des <br>Sciences Fondamentales et Appliquées (ADOSFA) de l'Université de Douala (Udo).<br> Il est hébergé à l'Institut Universitaire de Technologie (IUT) de Douala et bénéficie gracieusement des infrastructures de cet illustre établissement de l'Université de Douala. <br>La promotion 2020-2021 en est la 3ème cuvée sortie de ce Labo.<br> La Coordination du LTSA est Assurée par le Pr DJANNA KOFFI Francis Lénine et secondé par le Pr Vishiti AKUMBOM. </p> 
          <div class="savoir-plus-container"> 
            <img src="https://i.postimg.cc/50V0t7kB/fleche-droite.png" alt="icône"> <a class="texte_petit">Savoir plus</a> 
          </div> 
        </div> 
    </div> 
  </section> 
  <section id="carreaux_presentation"> 
   <div class="stats-section"> 
    <div class="stat-card"> 
     <div class="icon"></div> 
     <p>Créé depuis<br><strong>2017</strong></p> 
     <div class="green-line"></div> <span>CREATION<br> <br></span> 
    </div> 
    <div class="stat-card"> 
     <div class="icon"></div> 
     <p><strong>60</strong> masters et une <strong>douzaine</strong> de thèses de doctorats/PhD</p> 
     <div class="green-line"></div> <span>STATISTIQUE DES DIPLÔMÉES</span> 
    </div> 
    <div class="stat-card"> 
     <div class="icon"></div> 
     <p>Pres d’une <strong>centaine</strong> d’articles scientifiques publiés</p> 
     <div class="green-line"></div> <span>PRODUCTION SCIENTIFIQUE</span> 
    </div> 
    <div class="stat-card"> 
     <div class="icon"></div> 
     <p>Des <strong>brevets</strong> <br>initiés</p> 
     <div class="green-line"></div> <span>INVENTIONS<br><br></span> 
    </div><b> </b> 
   </div><b> </b> 
  </section><b> 
   <div class="section-hero"> 
    <div class="contenu-hero"> 
     <h1>Et si l'avenir s'inventait ici?</h1> 
     <p>Découvrez nos recherches et projets révolutionnaires</p> <button class="bouton-decouvrir">DECOUVRIR</button> 
    </div> 
   </div> 
   <section id="publications"> 
    <h2>PUBLICATION</h2> 
    <p class="publication-subtitle">Consultez nos dernières dernières publications</p> 
    <div class="contain"> 
     <div class="container"> 
      <div class="circle top-circle"></div> 
      <div class="bar top-bar"></div> 
      <div class="circle middle-circle"></div> 
      <div class="bar middle-bar"></div> 
      <div class="circle bottom-circle"></div> 
     </div> 
     <div class="conteneur "> 
      <div class="shadow-box"> 
       <div class="shadow-effect"></div> 
       <div class="shadow-effect-left"></div> 
      </div> 
      <div class="shadow-box"> 
       <div class="shadow-effect"></div> 
       <div class="shadow-effect-left"></div> 
      </div> 
     </div> 
    </div> 
   </section> 
   <section id="evenements"> 
    <h2>ÉVÉNEMENTS</h2> 
    <p class="evenements-subtitle">(Conférences, séminaires et ateliers)</p> 
    <div class="evenements-carousel"> 
     <div class="evenement-card"> 
      <h3>CONFÉRENCE SUR L'INTELLIGENCE ARTIFICIELLE</h3> 
      <p class="date">25 Avril 2025 - Amphi Campus</p> 
      <p>Découvrez comment l'IA révolutionne dans certains domaines...</p> 
      <div class="event-image"> 
       <img src="https://via.placeholder.com/200x150/cccccc/333333?Text=IA+Image" alt="IA Image"> 
      </div> 
      <p class="more-info">Plus d'informations...</p> 
     </div> 
     <div class="evenement-card"> 
      <h3>CONFÉRENCE SUR L'INTELLIGENCE ARTIFICIELLE</h3> 
      <p class="date">25 Avril 2025 - Amphi Campus</p> 
      <p>Découvrez comment l'IA révolutionne dans certains domaines...</p> 
      <div class="event-image"> 
       <img src="https://via.placeholder.com/200x150/eeeeee/555555?Text=Another+Event" alt="Another Event"> 
      </div> 
      <p class="more-info">Plus d'informations...</p> 
     </div> 
    </div> 
   </section> </b> 
 
<?php
$content=ob_get_clean();
require("template.php");
?>
