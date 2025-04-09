<?php
session_start();
if (!isset($_SESSION['token']) and !isset($_SESSION['id']) and !isset($_SESSION['nom'])) {
    //redirectionner vers la page d'accueil du visiteur;
    header("Location:index.php");
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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title><?php echo isset($titre) ? $titre . ' - ' : '';?>LTSA</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- custom css -->
    <link rel="icon" href="public/img/LTSA.png" type="image/png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="public/css/color.css">
    <link rel="stylesheet" href="public/css/login.css">
    <link rel="stylesheet" href="public/css/publication.css">
    <style>
        body{
            margin: 0;
            padding: 0;
        }
        .sidebar{
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 16.6667%;
            background-color:var(--color-bleu-fonce) !important;
            color: white;
            padding-top: 1rem;
        }
        .sidebar h4{
            text-align: center;
            margin-bottom: 1rem;
        }
        .sidebar ul{
            list-style: none;
            padding: 0;
        }
        .sidebar ul li{
            margin: 1rem 0;
        }
        .sidebar ul li a{
            color: white;
            text-decoration: none;
            padding: 0.5rem 1rem;
            display: block;
            transition: background-color 0.3s;
        }
        .sidebar ul li a:hover{
            background-color: var(--color-orange) !important;
            color: var(--text-white);
            border-radius: 5px;
        }
        .contents{
            margin-left: 14.3%;
            padding: 0 2rem;
            height: 100vh;
            margin-top: 0 !important;
            position: relative;
            top: 0;
        }
        .container-fluid{
            padding: 0;
        }
        .active{
            background-color: var(--color-orange) !important;
            color: white;
            border-radius: 5px;
        }
        /* Dans <style> */
    @keyframes slideOutLeft {
        0% {
            transform: translateY(0);
            opacity: 1;
        }
        100% {
            transform: translateY(-100%);
            opacity: 0;
        }
    }

    .slide-out-left {
        animation: slideOutLeft 0.9s forwards;
    }
        
       
    </style>
</head>

<body>
    <div class="container-fluid position-relative">
        <nav class="navbar navbar-expand-lg d-block position-fixed">
           
            <div class="sidebar">
                <h4>LTSA</h4>
                <ul class="ml-3 mr-1">
                    <li><a href="index.php">Retour accueil</a></li>

                    <li class="nav-item <?= $currentPage === 'doctorant' ? 'active' : '' ?>">
                        <a href="<?= BASE_URL ?>index.php?page=doctorant">Doctorants</a>
                    </li>

                    <li class="nav-item <?= $currentPage === 'enseignant/' ? 'active' : '' ?>">
                        <a href="<?= BASE_URL ?>index.php?page=enseignant/">Enseignants</a>
                    </li>

                    <li class="nav-item <?= $currentPage === 'specialites/' ? 'active' : '' ?>">
                        <a href="<?= BASE_URL ?>index.php?page=specialites/">Cours/ Specialites</a>
                    </li>

                    <li class="nav-item <?= $currentPage === 'publications/' ? 'active' : '' ?>">
                        <a href="<?= BASE_URL ?>index.php?page=publications/">Publications</a>
                    </li>

                    <li class="nav-item <?= $currentPage === 'admin/' ? 'active' : '' ?>">
                        <a href="<?= BASE_URL ?>index.php?page=admin/">Admin</a>
                    </li>

                    <li class="nav-item <?= $currentPage === 'actualites/' ? 'active' : '' ?>">
                        <a href="<?= BASE_URL ?>index.php?page=actualites/">Actualites</a>
                    </li>

                    <li class="nav-item">
                        <a href="<?= BASE_URL ?>index.php?page=login/decon">Deconnexion</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="contents contanier-fluid mt-0">
            <div class="d-flex justify-content-between" style="background-color: var(--bg-input);">
                <div class="md logo1 left ml-2"> <img src="public/img/LTSA.png" alt=""></div>
                <div class="text-center h3">Laboratoire de Technologies <br>et des Sciences Appliquées</div>
                <div class="logo2  right"><img src="public/img/IUT.png" alt=""></div>
            </div>
            <p class="col text-right"><span class="text-success"><?= $salutation ,$_SESSION['nom'];?></span> et bienvenue sur la page admin !</p>
            <div class="container">
                <?= $content ?>
            </div>
           
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/all.min.js" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    function toggleSibar(){
        const sidebar=document.querySelector(".sidebar");
        sidebar.classList.toggle("active");
        document.body.style.overflow=sidebar.classList.contains("active")? 'hidden': 'auto';
    }
    document.querySelectorAll('.sidebar a').forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault(); // Empêche le chargement immédiat
            const href = this.getAttribute('href');
            
            // Ajoute la classe d'animation à la zone de contenu
            const content = document.querySelector('.contents');
            content.classList.add('slide-out-left');

            // Attendre que l'animation finisse avant de changer de page
            content.addEventListener('animationend', () => {
                window.location.href = href;
            });
        });
    });
</script>
</body>

</html>