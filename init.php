<?php

//Charger la config de la base de données
require_once __DIR__ . "/config/bdltsa.php";

// Creation de la base de données et des tables si elles n'existent pas
function  initializeDatabase (){
    $dbHost = DB_HOST;
    $dbUser = DB_USER;
    $dbPassword = DB_PASS;
    $dbName = DB_NAME;

    try{
        // connexion sans spécifier de base de données
        $db = new PDO("mysql:host=$dbHost;charset=utf8", $dbUser, $dbPassword);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo"Connexion réussie à MySQL<br>";

        //verifier si la base de données existe déjà
        $query = $db->query("SHOW DATABASES LIKE '$dbName'");
        echo "<br>";
        if($query->rowCount() == 0){
            echo "La base de données '$dbName' n'existe pas, création de la base de données...<br>";
            $db->exec("CREATE DATABASE $dbName CHARACTER SET utf8 COLLATE utf8mb4_general_ci");
            echo "Base de données '$dbName' créée avec succès<br>";
        }else{
            echo "la bd exise déjà.<br>";
            
        }

        //connexion à la base de données
        $db = connectDB();

        //création des tables si elles n'existent pas
        // table users
        $query = $db->query("SHOW TABLES LIKE 'users'");
        echo "<br>";
        if($query->rowCount() == 0){
            echo "La table 'users' n'existe pas, création de la table...<br>";
            $db->exec("CREATE TABLE users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                username VARCHAR(50) NOT NULL,
                password VARCHAR(255) NOT NULL,
                email VARCHAR(100) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )");
            echo "Table 'users' créée avec succès<br>";
        }else{
            echo "La table 'users' existe déjà.<br>";
        }

        // table admin
        $query = $db->query("SHOW TABLES LIKE 'admin'");
        echo "<br>";
        if($query->rowCount() == 0){
            echo "La table 'admin' n'existe pas, création de la table...<br>";
            $db->exec("CREATE TABLE admin (
                id         Int  Auto_increment  NOT NULL ,
                nom        Varchar (50) NOT NULL ,
                email      Varchar (255) NOT NULL ,
                motDePasse Varchar (255) NOT NULL ,
                confirmer  Int ,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                token      Varchar (255)
                ,CONSTRAINT admin_PK PRIMARY KEY (id),
                CONSTRAINT admin_UK UNIQUE (email)
            )");
            echo "Table 'admin' créée avec succès<br>";
        }else{
            echo "La table 'admin' existe déjà.<br>";
        }
    

        // table enseignant
        $query = $db->query("SHOW TABLES LIKE 'enseignant'");
        echo "<br>";
        if($query->rowCount() == 0){
            echo "La table 'enseignant' n'existe pas, création de la table...<br>";
            $db->exec("CREATE TABLE enseignant (
                id          Int  Auto_increment  NOT NULL ,
                nom         Varchar (50) NOT NULL ,
                grade       Varchar (50) NOT NULL ,
                fonction    Varchar (50) NOT NULL ,
                lieuTravail Varchar (50) NOT NULL ,
                id_admin    Int NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                ,CONSTRAINT enseignant_PK PRIMARY KEY (id)

                ,CONSTRAINT enseignant_admin_FK FOREIGN KEY (id_admin) REFERENCES admin(id)
            )");
            echo "Table 'enseignant' créée avec succès<br>";
        }else{
            echo "La table 'enseignant' existe déjà.<br>";
        }
        

        // table actualités
        $query = $db->query("SHOW TABLES LIKE 'actualites'");
        echo "<br>";
        if($query->rowCount() == 0){
            echo "La table 'actualites' n'existe pas, création de la table...<br>";
            $db->exec("CREATE TABLE actualites (
                id       Int  Auto_increment  NOT NULL ,
                titre    Varchar (100) NOT NULL ,
                contenu  Text NOT NULL ,
                image    Varchar (255) NOT NULL ,
                lien     Varchar (255) NOT NULL ,
                id_admin Int NOT NULL,
                date_publication TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                ,CONSTRAINT actualites_PK PRIMARY KEY (id)

	            ,CONSTRAINT actualites_admin_FK FOREIGN KEY (id_admin) REFERENCES admin(id)
            )");
            echo "Table 'actualites' créée avec succès<br>";    
        }else{
            echo "La table 'actualites' existe déjà.<br>";
        }

        // table evenements
        $query = $db->query("SHOW TABLES LIKE 'evenements'");
        echo "<br>";
        if($query->rowCount() == 0){
            echo "La table 'evenements' n'existe pas, création de la table...<br>";
            $db->exec("CREATE TABLE evenements (
                id       Int  Auto_increment  NOT NULL ,
                titre    Varchar (100) NOT NULL ,
                description Text NOT NULL ,
                dateHeures  Datetime NOT NULL ,                
                image    Varchar (255) NOT NULL ,                
                id_admin Int NOT NULL,
                date_publication TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                ,CONSTRAINT evenements_PK PRIMARY KEY (id)
                ,CONSTRAINT evenements_admin_FK FOREIGN KEY (id_admin) REFERENCES admin(id)
            )");
            echo "Table 'evenements' créée avec succès<br>";
        }else{
            echo "La table 'evenements' existe déjà.<br>";
        }

        // table cycleDoctorat

        $query = $db->query("SHOW TABLES LIKE 'cycleDoctorat'");
        echo "<br>";
        if($query->rowCount() == 0){
            echo "La table 'cycleDoctorat' n'existe pas, création de la table...<br>";
            $db->exec("CREATE TABLE cycleDoctorat (
                id            Int  Auto_increment  NOT NULL ,
                AnneeDoctorat Varchar (20) NOT NULL ,
                codeEc        Varchar (20) NOT NULL ,
                intituleEc    Varchar (50) NOT NULL ,
                creditEc      Int NOT NULL ,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                id_admin      Int NOT NULL
                ,CONSTRAINT cycleDoctorat_PK PRIMARY KEY (id)
                ,CONSTRAINT cycleDoctorat_admin_FK FOREIGN KEY (id_admin) REFERENCES admin(id)
            )");
            echo "Table 'cycleDoctorat' créée avec succès<br>";
        }else{
            echo "La table 'cycleDoctorat' existe déjà.<br>";
        }

        // table Specialite
        $query = $db->query("SHOW TABLES LIKE 'Specialite'");
        echo "<br>";
        if($query->rowCount() == 0){
            echo "La table 'Specialite' n'existe pas, création de la table...<br>";
            $db->exec("CREATE TABLE specialite (
                id         Int  Auto_increment  NOT NULL ,
                nom     Varchar (20) NOT NULL ,
                description Varchar (50)  ,                
                id_admin   Int NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                ,CONSTRAINT Specialite_PK PRIMARY KEY (id)

                ,CONSTRAINT Specialite_admin_FK FOREIGN KEY (id_admin) REFERENCES admin(id)
            )");
            echo "Table 'Specialite' créée avec succès<br>";
        }else{
            echo "La table 'Specialite' existe déjà.<br>";
        }

        // table cours
        $query = $db->query("SHOW TABLES LIKE 'Cours'");
        echo "<br>";
        if($query->rowCount() == 0){
            echo "La table 'Cours' n'existe pas, création de la table...<br>";
            $db->exec("CREATE TABLE cours (
                id         Int  Auto_increment  NOT NULL ,
                codeEc     Varchar (20) NOT NULL ,
                intituleEc Varchar (50) NOT NULL ,
                coef       Int NOT NULL ,
                CM         Int NOT NULL ,
                TD         Int NOT NULL ,
                TP         Int NOT NULL ,
                TPE        Int NOT NULL ,
                CCTS       Int NOT NULL ,
                specialite INT NOT NULL, -- Colonne clé étrangère
                id_admin   Int NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                ,CONSTRAINT Cours_PK PRIMARY KEY (id)
                ,CONSTRAINT Cours_Specialite_FK FOREIGN KEY (specialite) REFERENCES Specialite(id)
                ,CONSTRAINT Cours_admin_FK FOREIGN KEY (id_admin) REFERENCES admin(id)
            )");
            echo "Table 'Cours' créée avec succès<br>";
        }else{
            echo "La table 'Cours' existe déjà.<br>";
        }


        // table doctorant
        $query = $db->query("SHOW TABLES LIKE 'doctorant'");
        echo "<br>";
        if($query->rowCount() == 0){
            echo "La table 'doctorant' n'existe pas, création de la table...<br>";
            $db->exec("CREATE TABLE doctorant (
                id         Int  Auto_increment  NOT NULL ,
                nom        Varchar (50) NOT NULL ,
                prenom     Varchar (50) NOT NULL ,
                email      Varchar (255) NOT NULL ,
                motDePasse Varchar (255) NOT NULL ,
                id_admin   Int NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                ,CONSTRAINT doctorant_PK PRIMARY KEY (id)

                ,CONSTRAINT doctorant_admin_FK FOREIGN KEY (id_admin) REFERENCES admin(id)
            )");
            echo "Table 'doctorant' créée avec succès<br>";
        }else{
            echo "La table 'doctorant' existe déjà.<br>";
        }

        // table messages
        $query = $db->query("SHOW TABLES LIKE 'messages'");
        echo "<br>";
        if($query->rowCount() == 0){
            echo "La table 'messages' n'existe pas, création de la table...<br>";
            $db->exec("CREATE TABLE messages (
                id         Int  Auto_increment  NOT NULL ,
                nom        Varchar (50) NOT NULL ,
                email      Varchar (255) NOT NULL ,
                sujet      Varchar (255) NOT NULL ,
                message    Text NOT NULL ,
                id_admin   Int NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                ,CONSTRAINT messages_PK PRIMARY KEY (id)

                ,CONSTRAINT messages_admin_FK FOREIGN KEY (id_admin) REFERENCES admin(id)
            )");
            echo "Table 'messages' créée avec succès<br>";
        }else{
            echo "La table 'messages' existe déjà.<br>";
        }
        
    }catch (PDOException $e){
        echo "Erreur lors de la création de la base de données ou des tables: " . $e->getMessage(); 
    }
}

initializeDatabase();
?>