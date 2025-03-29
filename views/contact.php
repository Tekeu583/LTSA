<?php 
ob_start();
?>

   <!-- FORMULAIRE DE CONTACT -->

<?php
$content=ob_get_clean();
require("template.php");
?>