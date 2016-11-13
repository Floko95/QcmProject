
/* Script d'initialisation de la BDD, a utiliser une seule fois */

CREATE SEQUENCE IF NOT EXISTS ID_DOMAINE START 1 INCREMENT 1 MAXVALUE 80;
CREATE SEQUENCE IF NOT EXISTS ID_SOUS_DOMAINE START 1 INCREMENT 1 MAXVALUE 80;
CREATE SEQUENCE IF NOT EXISTS ID_QUESTIONNEUR START 1 INCREMENT 1 MAXVALUE 100;
CREATE SEQUENCE IF NOT EXISTS ID_REPONDEUR START 1 INCREMENT 1 MAXVALUE 300;
CREATE SEQUENCE IF NOT EXISTS ID_QUESTION START 1 INCREMENT 1 MAXVALUE 800;
CREATE SEQUENCE IF NOT EXISTS ID_REPONSE START 1 INCREMENT 1 MAXVALUE 1200;
CREATE SEQUENCE IF NOT EXISTS ID_QCM START 1 INCREMENT 1 MAXVALUE 400;


CREATE TABLE IF NOT EXISTS Domaine(
id_domaine integer PRIMARY KEY DEFAULT nextval('ID_DOMAINE'),
nom_domaine varchar NOT NULL UNIQUE
);

CREATE TABLE IF NOT EXISTS Sous_Domaine(
id_sous_domaine integer PRIMARY KEY DEFAULT nextval('ID_SOUS_DOMAINE'),
id_domaine integer REFERENCES Domaine(id_domaine),
nom_sous_domaine varchar NOT NULL UNIQUE
);

CREATE TABLE IF NOT EXISTS Questionneur(
id_questionneur integer PRIMARY KEY DEFAULT nextval('ID_QUESTIONNEUR'),
nom_questionneur varchar NOT NULL UNIQUE,
mdp_questionneur varchar NOT NULL,
nb_qcm integer DEFAULT 0,
UNIQUE (id_questionneur, nom_questionneur, mdp_questionneur)
);

CREATE TABLE IF NOT EXISTS Repondeur(
id_repondeur integer PRIMARY KEY DEFAULT nextval('ID_REPONDEUR'), 
nom_repondeur varchar NOT NULL UNIQUE,
mdp_repondeur varchar NOT NULL,
UNIQUE (id_repondeur, nom_repondeur, mdp_repondeur)
);

CREATE TABLE IF NOT EXISTS Question(
id_question integer PRIMARY KEY DEFAULT nextval('ID_QUESTION'),
question varchar NOT NULL,
valeur float NOT NULL DEFAULT 1.0, -- points gagnés lors d'une bonne réponse à la question
temps integer NOT NULL DEFAULT 30, -- champs de durée en secondes 
UNIQUE (question)
);

CREATE TABLE IF NOT EXISTS Reponse(
id_reponse integer PRIMARY KEY DEFAULT nextval('ID_REPONSE'),
id_question integer NOT NULL REFERENCES Question(id_question),
reponse varchar NOT NULL,
correct boolean DEFAULT FALSE
);

CREATE TABLE IF NOT EXISTS Qcm(
id_qcm integer NOT NULL PRIMARY KEY DEFAULT nextval('ID_QCM'),
auteur varchar NOT NULL REFERENCES Questionneur(nom_questionneur),
date_creation date,
niveau varchar,
temps_total int DEFAULT null,
note float
);

CREATE TABLE IF NOT EXISTS QCM_Question(
id_qcm integer REFERENCES Qcm(id_qcm),
id_question integer REFERENCES Question(id_question),
domaine varchar REFERENCES Domaine(nom_domaine),
sous_domaine varchar REFERENCES Sous_Domaine(nom_sous_domaine),
PRIMARY KEY(id_qcm, id_question)
);

/*CREATE TABLE IF NOT EXISTS Question_Reponse(
id_question integer REFERENCES Question(id_question),
id_reponse integer REFERENCES Reponse(id_reponse),
PRIMARY KEY(id_question, id_reponse)
);*/

CREATE TABLE IF NOT EXISTS Recapitulatif(
id_utilisateur integer NOT NULL REFERENCES Repondeur(id_repondeur),
utilisateur varchar REFERENCES Repondeur(nom_repondeur),
moyenne float,
nb_qcm_fait integer,
note_dernier_qcm float,
temps_passe float,
PRIMARY KEY (id_utilisateur)
);
