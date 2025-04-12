<?php
ob_start();
?>
<p class="justify-content-center text-center">pas d'acualites pour le  moment !</p>

<?php
    $content= ob_get_clean();
    require "template.php";
?>