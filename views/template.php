<?php
define('URL', 'http://localhost/projet ltsa/ltsa/');
$activePage=$_GET['page'] ?? '';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo isset($titre) ? $titre . ' - ' : '';?>LTSA
    </title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- custom css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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
    <style>
        /* Première partie du header */
 body {
    margin: 0;
    padding: 0;
    padding-top: 50px; /* espace pour la navbar fixe */
  }

  /* NAVBAR */
  .navbar {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    background-color: black;
    width: 100%;
    z-index: 1050;
    margin: 0;
    padding: 0;
  }

  .navbar-nav .nav-item{
    width: 100%;
  }
  .navbar-nav .nav-link {
    color: white !important;
    transition: color 0.3s;
    padding: 1rem;
  }

  .navbar-nav .nav-link:hover {
    color: #ccc;
  }

  .navbar-nav .nav-link.active {
    color: orange !important;
    font-weight: bold;
  }

  /* HEADER TOP */
  .header-top {
    background-color: white;
    padding: 20px 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid #eee;
  }

  .logo {
    height: 80px;
    width: auto;
  }

  .header-title {
    font-size: 1.2rem;
    font-weight: bold;
    color: #333;
    text-align: center;
    flex-grow: 1;
    max-width: 600px;
  }

  .logo-container {
    flex: 0 0 150px;
    padding: 0 10px;
  }

  .footer-ltsa {
    background-color: var(--color-bleu-fonce) !important; /* Bleu foncé */
    color: white;
    padding: 30px 0 10px;
    font-family: Arial, sans-serif;
    font-weight: bold;
    position: relative;
}

.footer-column {
    display: inline-block;
    vertical-align: top;
    width: 30%;
    padding: 0 2%;
}

.footer-title {
    color: #20d726; /* Vert */
    font-size: 1.1rem;
    font-weight: bold;
    margin-bottom: 20px;
    text-transform: uppercase;
}

.contact-info p,
.specialty,
.presentation {
    margin-bottom: 10px;
    line-height: 1.5;
}

.specialty {
    text-transform: uppercase;
}

.specialty:first-child {
    font-weight: bold;
}

.copyright {
    color: white;
    font-size: 0.9rem;
    margin-top: 40px;
    padding-top: 20px;
    border-top: 1px solid white;
    text-align: center;
}

.footer-container {

    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}
@media (max-width: 768px) {
    .footer-column .specialty{
        font-size: 10px;
    }
    .footer-column .contact-info p, .footer-column .presentation p{
        font-size: 14px;
    }
    .footer-column{
      display: block;
      width: 90%;
      margin: 10px auto;
    }
    
}
    </style>
</head>
<body>

  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-center" id="navbarMenu">
        <ul class="navbar-nav w-100">
          <li class="nav-item"><a class="nav-link <?= ($activePage == '')? 'active': '' ?> " href="<?= URL ?>index.php?page=accueil">Accueil</a></li>
          <li class="nav-item"><a class="nav-link <?= ($activePage == 'presentation')? 'active': '' ?>" href="<?= URL ?>index.php?page=presentation">Présentation</a></li>
          <li class="nav-item"><a class="nav-link <?= ($activePage == 'recherche')? 'active': '' ?>" href="<?= URL ?>index.php?page=recherche">Domaine de recherche</a></li>
          <li class="nav-item"><a class="nav-link <?= ($activePage == 'publication')? 'active': '' ?>" href="#">Publications</a></li>
          <li class="nav-item"><a class="nav-link <?= ($activePage == 'formations')? 'active': '' ?>" href="<?= URL ?>index.php?page=formations">Formations</a></li>
          <li class="nav-item"><a class="nav-link <?= ($activePage == 'contact')? 'active': '' ?>" href="<?= URL ?>index.php?page=contact">Contact</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= URL ?>index.php?page=login">Se connecter</a></li>
          <?php
              if (isset($_SESSION['token']) and isset($_SESSION['id']) and isset($_SESSION['nom'])) {
                ?><li class="nav-item"><a class="nav-link" href="<?= URL ?>index.php?page=login/decon">Deconnexion</a></li>
                <?php
              }
          ?>
        </ul>
      </div>
    </div>
  </nav>
  
  <!-- HEADER TOP -->
  <div class="header-top container-fluid">
    <div class="logo-container">
      <img src="public/img/LTSA.png" alt="Logo LTSA" class="logo" />
    </div>
    <h1 class="header-title">
      Laboratoire de Technologies et des<br class="d-none d-md-block"> Sciences Appliquées
    </h1>
    <div class="logo-container text-end">
      <img src="public/img/IUT.png" alt="Logo IUT" class="logo" />
    </div>
  </div>

  <?= $content ?>
  
  <!-- Footer  -->
  <footer class="footer-ltsa">
        <div class="footer-container">
            <div class="footer-column">
                <h2 class="footer-title">Nous contacter</h2>
                <div class="contact-info">
                    <p>Laboratoires de Technologies et des Sciences Appliquees</p>
                    <p>BP: 8580 Douala</p>
                    <p>+237 ......</p>
                    <p>+237 ......</p>
                    <p>Email: ......</p>
                    <p>Email: ......</p>
                </div>
            </div>
            
            <div class="footer-column">
                <h2 class="footer-title">Nos Specialités</h2>
                <p class="specialty">ENERGETIQUE</p>
                <p class="specialty">MECANIQUE</p>
                <p class="specialty">GENIE CIVIL ET BIOTECHNOLOGIE</p>
                <p class="specialty">ELECTRONIQUE, ELECTROTECHNIQUE, AUTOMATISME ET TELECOMMUNICATION (EEAT)</p>
                <p class="specialty">GENIE INDUSTRIEL ET MAINTENANCE (GIM)</p>
                <p class="specialty">GEOTECHNOLOGIE</p>
            </div>
            
            <div class="footer-column">
                <h2 class="footer-title">Presentations</h2>
                <p class="presentation">
                    <p>Le LTSA fondé en 2017 est un laboratoire de recherche appartenant à l'Unité de formation Doctorale <br>Sciences Appliquées (UFD-SCA) de l'Ecole Doctorale de des Sciences Fondamentales et Appliquées (ADOSFA) de l'Université de Douala (Udo).</p> 
                    <p>Il est hébergé à l'Institut Universitaire de Technologie (IUT) de Douala et bénéficie gracieusement <br>des infrastructures de cet illustre établissement de l'Université de Douala.</p>
                </p>
            </div>
            
            <div class="copyright">
                ©Copyright 2025 | LTSA.com
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/bootstrap-bundle.min.js"></script>
    
    <script>
        // Script amélioré pour gérer l'état actif des liens
        document.addEventListener('DOMContentLoaded', function() {
            const navLinks = document.querySelectorAll('.nav-link');
            const currentPage = "<?= $activePage ?>";
            
            // Marquer la page active au chargement
            navLinks.forEach(link => {
                if (link.getAttribute('href').includes(currentPage) && currentPage !== '') {
                    link.classList.add('active');
                }
            });
            
            // Gérer le clic sur les liens
            navLinks.forEach(link => {
                link.addEventListener('click', function() {
                    navLinks.forEach(l => l.classList.remove('active'));
                    this.classList.add('active');
                    
                    // Fermer le menu mobile si ouvert
                    if (window.innerWidth <= 1114) {
                        const navbarCollapse = document.getElementById('navbarMenu');
                        const bsCollapse = bootstrap.Collapse.getInstance(navbarCollapse);
                        if (bsCollapse) {
                            bsCollapse.hide();
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>