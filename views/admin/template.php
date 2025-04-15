<?php
session_start();
if (!isset($_SESSION['token']) and !isset($_SESSION['id']) and !isset($_SESSION['nom'])) {
    //redirectionner vers la page d'accueil du visiteur;
    header("Location:index.php?page=accueil");
}
$heure = date("H");
if($heure < 12){
    $salutation = "Bonjour ";
}else if($heure < 18){  
    $salutation = "Bon après-midi ";
}else{
    $salutation="Bonsoir ";
}
$currentPage = $_GET['page'] ?? '';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title><?php echo isset($titre) ? $titre . ' - ' : '';?>LTSA</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">

    <!-- custom css -->
    <link rel="icon" href="public/img/LTSA.png" type="image/png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="public/css/color.css">
    <link rel="stylesheet" href="public/css/login.css">
    <link rel="stylesheet" href="public/css/publication.css">
    <link rel="stylesheet" href="public/css/template.css">
  <style>
    
  </style>
</head>
<body>

  <!-- Bouton burger (visible sur mobile) -->
  <nav class="navbar navbar-dark  d-md-none position-fixed">
    <button class="navbar-toggler bg-dark" type="button" id="toggleSidebar">
      <span class="navbar-toggler-icon"></span>
    </button>
  </nav>

  <!-- Sidebar -->
  <div class="sidebar" id="sidebar">
    <h4 class="text-center">LTSA</h4>
    <a href="index.php" class="nav-link">Accueil</a>
    <a href="<?= BASE_URL ?>index.php?page=doctorant"class="nav-link <?= $currentPage === 'doctorant' ? 'active-link' : '' ?>" >Doctorants</a>
    <a href="<?= BASE_URL ?>index.php?page=enseignant" class="nav-link <?= $currentPage === 'enseignant' ? 'active-link' : '' ?>">Enseignants</a>
    <a href="<?= BASE_URL ?>index.php?page=specialites" class="nav-link <?= $currentPage === 'specialites' ? 'active-link' : '' ?>">Cours/ Specialitées</a>
    <a href="<?= BASE_URL ?>index.php?page=publications" class="nav-link <?= $currentPage === 'publications' ? 'active-link' : '' ?>">Publications</a>
    <a href="<?= BASE_URL ?>index.php?page=actualites" class="nav-link <?= $currentPage === 'actualites' ? 'active-link' : '' ?>">Actualités</a>
    <a href="<?= BASE_URL ?>index.php?page=contact/message" class="nav-link <?= $currentPage === 'message' ? 'active-link' : '' ?>">Messages</a>
    <a href="<?= BASE_URL ?>index.php?page=admin" class="nav-link <?= $currentPage === 'admin' ? 'active-link' : '' ?>">Admin</a>
    <a href="<?= BASE_URL ?>index.php?page=login/decon">Déconnexion</a>
  </div>

  <!-- Overlay -->
  <div class="overlay" id="overlay"></div>

  <!-- Contenu principal -->
  <div class="content">
    <div class="d-flex justify-content-between" style="background-color: var(--bg-input);">
        <div class="md logo1 left ml-2"> <img src="public/img/LTSA.png" alt=""></div>
            <div class="text-center h3">Laboratoire de Technologies <br>et des Sciences Appliquées</div>
            <div class="logo2  right"><img src="public/img/IUT.png" alt=""></div>
        </div>
        <p class="col text-right"><span class="text-success"><?= $salutation ,$_SESSION['nom']?></span> et bienvenue sur la page admin !</p>
        <div class="container">
          <?= $content ?>
        </div>
  </div>

  <!-- JS -->
  <script>
    const toggleBtn = document.getElementById('toggleSidebar');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');
    const links = document.querySelectorAll('.sidebar .nav-link');

    function closeSidebar() {
      sidebar.classList.remove('active');
      overlay.classList.remove('active');
    }

    toggleBtn.addEventListener('click', () => {
      sidebar.classList.add('active');
      overlay.classList.add('active');
    });

    overlay.addEventListener('click', closeSidebar);

    links.forEach(link => {
      link.addEventListener('click', function(e) {
        // Ajout de la classe active
        links.forEach(l => l.classList.remove('active-link'));
        this.classList.add('active-link');

        // Fermer le menu sur mobile
        if (window.innerWidth < 768) {
          closeSidebar();
        }
      });
    });
  </script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.min.js"></script>
</body>
</html>