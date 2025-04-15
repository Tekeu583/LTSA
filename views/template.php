<?php
define('URL', 'http://localhost/projet ltsa/ltsa/');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo isset($titre) ? $titre . ' - ' : '';?>LTSA
    </title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- custom css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="icon" href="public/img/LTSA.png" type="image/png">
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/color.css">
    <link rel="stylesheet" href="public/css/bootstrap-grid.css">
    <link rel="stylesheet" href="public/css/publication.css">
    <link rel="stylesheet" href="public/css/color.css">
    <link rel="stylesheet" href="public/css/style_presentation.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container-fluid z-index-1001">
        <div class="nav-bar position-fixed d-flex position-absolute justify-content-between align-items-center">
            <div class="logo d-flex align-items-center">
                <img src="public/img/LTSA.png" alt="LTSA" class="logo-img">
                <h1 class="logo-text">LTSA</h1>
            </div>

            <nav>
                <ul class="d-flex bg-dark text-white justify-content-between align-items-center">
                    <li class="ml-3"><a href="index.php">Accueil</a></li>
                    <li class="ml-3"><a href="#">Publications</a></li>
                    <li class="ml-3"><a href="<?= URL ?>index.php?page=recherche/">Domaine de recherche</a></li>
                    <li class="ml-3"><a href="<?= URL ?>index.php?page=formations/">formations</a></li>
                    <li class="ml-3"><a href="#">contact</a></li>
                    <li class="ml-3"><a href="<?= URL ?>index.php?page=login">se connecter</a></li>
                    <?php
                        if (isset($_SESSION['token']) and isset($_SESSION['id']) and isset($_SESSION['nom'])) {
                            ?><li class="ml-3"><a href="<?= URL ?>index.php?page=login/decon">Deconnexion</a></li>
                            <?php
                        }

                    ?>
                </ul>
            </nav>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/bootstrap-bundle.min.js"></script>


</body>

</html>