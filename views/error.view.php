<?php
ob_start();
?>
<?= $msg ?>

<?php
    $content= ob_get_clean();
    require "template.php";
?>