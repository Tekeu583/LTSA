<?php

require_once  "controller/SpecialiteController.php";

$request = $_SERVER['REQUEST_URI'];

function getIntParam(string $key, int $default = 0) {
    return isset($_GET[$key]) ? $_GET[$key] : $default; 
}

function redirect(string $location, int $statusCode = 302){
    header("Location:$location", true, $statusCode);
    exit;
}


    $spcon = new SpecialiteController();
switch ($request) {
    case '/':
        $spcon->showSpecialite();
        $spcon->showCourses(getIntParam('id'));
        break;
    }
?>