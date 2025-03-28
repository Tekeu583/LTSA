<?php 
ob_start();
?>

<p>ici le contenu de la page d'accueil</h1>

<?php
$content=ob_get_clean();
require("template.php");
?>