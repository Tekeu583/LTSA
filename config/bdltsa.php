<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'your_username');// à remplacer
define('DB_PASS', 'yourpassword');// à remplacer
define('DB_NAME', 'ltsa');// à remplacer si neccesaire


function connectDB (){        
    $dbHost = DB_HOST;
    $dbUser = DB_USER;
    $dbPass = DB_PASS;
    $dbName = DB_NAME;
    try {
        $db = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser, $dbPass);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}


?>