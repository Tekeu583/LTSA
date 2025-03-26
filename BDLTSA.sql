#------------------------------------------------------------
#        Script MySQL pour la base de données LTSA
#------------------------------------------------------------


#------------------------------------------------------------
# Table: admin
#------------------------------------------------------------

CREATE TABLE admin(
        id         Int  Auto_increment  NOT NULL ,
        nom        Varchar (50) NOT NULL ,
        email      Varchar (255) NOT NULL ,
        motDePasse Varchar (255) NOT NULL ,
        confirmer  Int ,
        token      Varchar (255)
	,CONSTRAINT admin_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: energetique
#------------------------------------------------------------

CREATE TABLE energetique(
        id         Int  Auto_increment  NOT NULL ,
        codeEc     Varchar (20) NOT NULL ,
        intituleEc Varchar (50) NOT NULL ,
        coef       Int NOT NULL ,
        CM         Int NOT NULL ,
        TD         Int NOT NULL ,
        TP         Int NOT NULL ,
        TPE        Int NOT NULL ,
        CCTS       Int NOT NULL ,
        id_admin   Int NOT NULL
	,CONSTRAINT energetique_PK PRIMARY KEY (id)

	,CONSTRAINT energetique_admin_FK FOREIGN KEY (id_admin) REFERENCES admin(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: enseignant
#------------------------------------------------------------

CREATE TABLE enseignant(
        id          Int  Auto_increment  NOT NULL ,
        nom         Varchar (50) NOT NULL ,
        grade       Varchar (50) NOT NULL ,
        fonction    Varchar (50) NOT NULL ,
        lieuTravail Varchar (50) NOT NULL ,
        id_admin    Int NOT NULL
	,CONSTRAINT enseignant_PK PRIMARY KEY (id)

	,CONSTRAINT enseignant_admin_FK FOREIGN KEY (id_admin) REFERENCES admin(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: EEAT
#------------------------------------------------------------

CREATE TABLE EEAT(
        id         Int  Auto_increment  NOT NULL ,
        codeEc     Varchar (20) NOT NULL ,
        intituleEc Varchar (50) NOT NULL ,
        coef       Int NOT NULL ,
        CM         Int NOT NULL ,
        TD         Int NOT NULL ,
        TP         Int NOT NULL ,
        TPE        Int NOT NULL ,
        CCTS       Int NOT NULL ,
        id_admin   Int NOT NULL
	,CONSTRAINT EEAT_PK PRIMARY KEY (id)

	,CONSTRAINT EEAT_admin_FK FOREIGN KEY (id_admin) REFERENCES admin(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: actualites
#------------------------------------------------------------

CREATE TABLE actualites(
        id       Int  Auto_increment  NOT NULL ,
        titre    Varchar (100) NOT NULL ,
        contenu  Text NOT NULL ,
        image    Varchar (255) NOT NULL ,
        lien     Varchar (255) NOT NULL ,
        id_admin Int NOT NULL
	,CONSTRAINT actualites_PK PRIMARY KEY (id)

	,CONSTRAINT actualites_admin_FK FOREIGN KEY (id_admin) REFERENCES admin(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: evenement
#------------------------------------------------------------

CREATE TABLE evenement(
        id          Int  Auto_increment  NOT NULL ,
        titre       Varchar (50) NOT NULL ,
        description Text NOT NULL ,
        dateHeures  Datetime NOT NULL ,
        image       Varchar (255) NOT NULL ,
        id_admin    Int NOT NULL
	,CONSTRAINT evenement_PK PRIMARY KEY (id)

	,CONSTRAINT evenement_admin_FK FOREIGN KEY (id_admin) REFERENCES admin(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: cycleDoctorat
#------------------------------------------------------------

CREATE TABLE cycleDoctorat(
        id            Int  Auto_increment  NOT NULL ,
        AnneeDoctorat Varchar (2) NOT NULL ,
        codeEc        Varchar (20) NOT NULL ,
        intituleEc    Varchar (50) NOT NULL ,
        creditEc      Int NOT NULL ,
        id_admin      Int NOT NULL
	,CONSTRAINT cycleDoctorat_PK PRIMARY KEY (id)

	,CONSTRAINT cycleDoctorat_admin_FK FOREIGN KEY (id_admin) REFERENCES admin(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: genieMecanique
#------------------------------------------------------------

CREATE TABLE genieMecanique(
        id         Int  Auto_increment  NOT NULL ,
        codeEc     Varchar (20) NOT NULL ,
        intituleEc Varchar (50) NOT NULL ,
        coef       Int NOT NULL ,
        CM         Int NOT NULL ,
        TD         Int NOT NULL ,
        TP         Int NOT NULL ,
        TPE        Int NOT NULL ,
        CCTS       Int NOT NULL ,
        id_admin   Int NOT NULL
	,CONSTRAINT genieMecanique_PK PRIMARY KEY (id)

	,CONSTRAINT genieMecanique_admin_FK FOREIGN KEY (id_admin) REFERENCES admin(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: genieMecanique
#------------------------------------------------------------

CREATE TABLE genieMecanique(
        id         Int  Auto_increment  NOT NULL ,
        codeEc     Varchar (20) NOT NULL ,
        intituleEc Varchar (50) NOT NULL ,
        coef       Int NOT NULL ,
        CM         Int NOT NULL ,
        TD         Int NOT NULL ,
        TP         Int NOT NULL ,
        TPE        Int NOT NULL ,
        CCTS       Int NOT NULL ,
        id_admin   Int NOT NULL
	,CONSTRAINT genieMecanique_PK PRIMARY KEY (id)

	,CONSTRAINT genieMecanique_admin_FK FOREIGN KEY (id_admin) REFERENCES admin(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: geoscience
#------------------------------------------------------------

CREATE TABLE geoscience(
        id         Int  Auto_increment  NOT NULL ,
        codeEc     Varchar (20) NOT NULL ,
        intituleEc Varchar (50) NOT NULL ,
        coef       Int NOT NULL ,
        CM         Int NOT NULL ,
        TD         Int NOT NULL ,
        TP         Int NOT NULL ,
        TPE        Int NOT NULL ,
        CCTS       Int NOT NULL ,
        id_admin   Int NOT NULL
	,CONSTRAINT geoscience_PK PRIMARY KEY (id)

	,CONSTRAINT geoscience_admin_FK FOREIGN KEY (id_admin) REFERENCES admin(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: doctorant
#------------------------------------------------------------

CREATE TABLE doctorant(
        id             Int  Auto_increment  NOT NULL ,
        nom            Varchar (50) NOT NULL ,
        intituleThese  Varchar (100) NOT NULL ,
        dateSoutenance Date NOT NULL ,
        numeroOrdre    Varchar (50) NOT NULL ,
        id_admin       Int NOT NULL
	,CONSTRAINT doctorant_PK PRIMARY KEY (id)

	,CONSTRAINT doctorant_admin_FK FOREIGN KEY (id_admin) REFERENCES admin(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: messages
#------------------------------------------------------------

CREATE TABLE messages(
        id        Int  Auto_increment  NOT NULL ,
        nom       Varchar (50) NOT NULL ,
        email     Varchar (255) NOT NULL ,
        telephone Integer NOT NULL
	,CONSTRAINT messages_PK PRIMARY KEY (id)
)ENGINE=InnoDB;




