
/* Script d'initialisation de la BDD, a utiliser une seule fois */

CREATE SEQUENCE IF NOT EXISTS ID_DOMAINE START 1 INCREMENT 1 MAXVALUE 50;
CREATE SEQUENCE IF NOT EXISTS ID_SOUS_DOMAINE START 1 INCREMENT 1 MAXVALUE 50;
CREATE SEQUENCE IF NOT EXISTS ID_QUESTIONNEUR START 1 INCREMENT 1 MAXVALUE 100;
CREATE SEQUENCE IF NOT EXISTS ID_REPONDEUR START 1 INCREMENT 1 MAXVALUE 300;
CREATE SEQUENCE IF NOT EXISTS ID_QUESTION START 1 INCREMENT 1 MAXVALUE 500;
CREATE SEQUENCE IF NOT EXISTS ID_REPONSE START 1 INCREMENT 1 MAXVALUE 800;
CREATE SEQUENCE IF NOT EXISTS ID_QCM START 1 INCREMENT 1 MAXVALUE 200;


CREATE TABLE IF NOT EXISTS Domaine(
id_domaine serial PRIMARY KEY,
nom_domaine varchar,
UNIQUE (nom_domaine)
);

CREATE TABLE IF NOT EXISTS Sous_Domaine(
id_sous_domaine serial PRIMARY KEY,
id_domaine int REFERENCES Domaine(id_domaine),
nom_sous_domaine varchar,
UNIQUE (nom_sous_domaine)
);

CREATE TABLE IF NOT EXISTS Questionneur(
id_questionneur serial PRIMARY KEY,
nom_questionneur varchar NOT NULL UNIQUE,
mdp_questionneur varchar NOT NULL,
nb_qcm int
);

CREATE TABLE IF NOT EXISTS Repondeur(
id_repondeur serial PRIMARY KEY, 
nom_repondeur varchar NOT NULL,
mdp_repondeur varchar NOT NULL,
UNIQUE (id_repondeur, nom_repondeur, mdp_repondeur)
);

CREATE TABLE IF NOT EXISTS Question(
id_question serial PRIMARY KEY,
question varchar NOT NULL,
UNIQUE (question)
);

CREATE TABLE IF NOT EXISTS Reponse(
id_reponse serial PRIMARY KEY,
reponse varchar NOT NULL
);

CREATE TABLE IF NOT EXISTS Qcm(
id_qcm serial NOT NULL PRIMARY KEY,
auteur varchar NOT NULL REFERENCES Questionneur(nom_questionneur),
date_creation date,
niveau varchar,
note float
);

CREATE TABLE IF NOT EXISTS QCM_Question(
id_qcm int REFERENCES Qcm(id_qcm),
id_question int REFERENCES Question(id_question),
domaine varchar REFERENCES Domaine(nom_domaine),
sous_domaine varchar REFERENCES Sous_Domaine(nom_sous_domaine),
PRIMARY KEY(id_qcm, id_question)
);

CREATE TABLE IF NOT EXISTS Question_Reponse(
id_question int REFERENCES Question(id_question),
id_reponse int REFERENCES Reponse(id_reponse),
PRIMARY KEY(id_question, id_reponse)
);

CREATE TABLE IF NOT EXISTS Statistiques(
utilisateur int REFERENCES Repondeur(id_repondeur),
moyenne float,
note_qcm float,
temps_passe time,
PRIMARY KEY (utilisateur)
);