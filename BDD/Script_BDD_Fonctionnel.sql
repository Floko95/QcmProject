DROP TABLE Qcm CASCADE;
DROP TABLE Qcm_Question CASCADE;
DROP TABLE Question CASCADE;
DROP TABLE Question_Reponse CASCADE;
DROP TABLE Reponse CASCADE;
DROP TABLE ReponsesQCMRepondant CASCADE;
DROP TABLE Questionneur CASCADE;
DROP TABLE Repondeur CASCADE;
DROP TABLE Statistiques CASCADE;
DROP TABLE Domaine CASCADE;
DROP TABLE Sous_Domaine CASCADE;


CREATE TABLE Questionneur(
id_questionneur serial NOT NULL PRIMARY KEY,
nom_questionneur varchar NOT NULL,
nb_qcm int,
UNIQUE (id_questionneur)
);

CREATE TABLE Repondeur(
id_repondeur serial NOT NULL PRIMARY KEY, 
nom_repondeur varchar NOT NULL,
UNIQUE (id_repondeur)
);

CREATE TABLE Question(
id_question serial NOT NULL ,
question varchar,
PRIMARY KEY (id_question)
);

CREATE TABLE Reponse(
id_reponse serial NOT NULL,
reponse varchar,
PRIMARY KEY (id_reponse)
);

CREATE TABLE Qcm(
id_qcm serial NOT NULL PRIMARY KEY,
auteur int NOT NULL REFERENCES Questionneur(id_questionneur),
theme varchar,
sous_theme varchar,
date_creation date,
niveau varchar,
note float
);

CREATE TABLE QCM_Question(
id_qcm int REFERENCES Qcm(id_qcm),
id_question int REFERENCES Question(id_question),
PRIMARY KEY(id_qcm, id_question)
);

CREATE TABLE Question_Reponse(
id_question int,
id_reponse int,
PRIMARY KEY(id_question, id_reponse),
FOREIGN KEY(id_question) REFERENCES Question(id_question),
FOREIGN KEY(id_reponse) REFERENCES Reponse(id_reponse)
);

-- à enlever si possible

CREATE TABLE ReponsesQCMRepondant(
utilisateur int NOT NULL REFERENCES Repondeur(id_repondeur),
id_qcm int REFERENCES Qcm(id_qcm),
id_reponse int,
rep_donnee varchar,
PRIMARY KEY (utilisateur, id_qcm)
);

-- remplacer ReponsesQCMRepondant par l'utilisation du $_SESSION ou $_POST dans le code PHP

CREATE TABLE Statistiques(
utilisateur int NOT NULL REFERENCES Repondeur(id_repondeur),
moyenne float,
note_qcm float,
temps_passe time,
PRIMARY KEY (utilisateur)
);

CREATE TABLE Domaine(
id_domaine serial NOT NULL PRIMARY KEY,
nom_domaine varchar UNIQUE
);

CREATE TABLE Sous_Domaine(
id_sous_domaine serial NOT NULL PRIMARY KEY,
id_domaine serial REFERENCES Domaine(id_domaine),
nom_sous_domaine varchar UNIQUE
);