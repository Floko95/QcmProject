

/* Script d'initialisation de la BDD */

-- Séquences d'incrémentation pour les ID de chaque tables avec une valeur max pour éviter de surcharger la base de données
CREATE SEQUENCE IF NOT EXISTS ID_DOMAINE START 1 INCREMENT 1 MAXVALUE 200;     
CREATE SEQUENCE IF NOT EXISTS ID_SOUS_DOMAINE START 1 INCREMENT 1 MAXVALUE 300;
CREATE SEQUENCE IF NOT EXISTS ID_QUESTIONNEUR START 1 INCREMENT 1 MAXVALUE 500;
CREATE SEQUENCE IF NOT EXISTS ID_REPONDEUR START 1 INCREMENT 1 MAXVALUE 500;
CREATE SEQUENCE IF NOT EXISTS ID_QUESTION START 1 INCREMENT 1 MAXVALUE 2000;
CREATE SEQUENCE IF NOT EXISTS ID_REPONSE START 1 INCREMENT 1 MAXVALUE 8000;
CREATE SEQUENCE IF NOT EXISTS ID_QCM START 1 INCREMENT 1 MAXVALUE 1000;

-- La relation Domaine instaure les différents noms de domaine
CREATE TABLE IF NOT EXISTS Domaine(
id_domaine integer PRIMARY KEY DEFAULT nextval('ID_DOMAINE'),
domaine varchar NOT NULL UNIQUE
);

-- La relation Sous_Domaine ajoute une précision à un domaine 
CREATE TABLE IF NOT EXISTS Sous_Domaine(
id_sous_domaine integer PRIMARY KEY DEFAULT nextval('ID_SOUS_DOMAINE'),
id_domaine integer REFERENCES Domaine(id_domaine),
sous_domaine varchar UNIQUE
);

-- La relation Questionneur contient les infos de chaque questionneur pouvant utiliser le site de QCM
CREATE TABLE IF NOT EXISTS Questionneur(
id_questionneur integer PRIMARY KEY DEFAULT nextval('ID_QUESTIONNEUR'),
nom_questionneur varchar NOT NULL UNIQUE,
mdp_questionneur varchar NOT NULL,
nb_qcm_fait integer DEFAULT 0,
UNIQUE (id_questionneur, nom_questionneur, mdp_questionneur)
);

-- La relation Répondeur contient les infos de chaque répondeur utilisant le site web
CREATE TABLE IF NOT EXISTS Repondeur(
id_repondeur integer PRIMARY KEY DEFAULT nextval('ID_REPONDEUR'), 
nom_repondeur varchar NOT NULL UNIQUE,
mdp_repondeur varchar NOT NULL,
nb_qcm_fait integer DEFAULT 0,
moyenne float DEFAULT 0.00,
temps_total integer DEFAULT 0,
UNIQUE (id_repondeur, nom_repondeur, mdp_repondeur)
);

-- La relation Question sauvegarde les questions et les infos utiles afin d'être utilisable dans un qcm
CREATE TABLE IF NOT EXISTS Question(
id_question integer PRIMARY KEY DEFAULT nextval('ID_QUESTION'),
question varchar NOT NULL UNIQUE,
valeur float NOT NULL DEFAULT 1.0,	-- points gagnés lors d'une bonne réponse à la question
temps integer NOT NULL DEFAULT 30, 	-- champs de durée en secondes 
explication varchar DEFAULT NULL	-- texte explicatif à afficher lors de la correction (pas nécessaire)
);

-- La relation Reponse comptabilise les réponses possibles pour chaque question
CREATE TABLE IF NOT EXISTS Reponse(
id_reponse integer PRIMARY KEY DEFAULT nextval('ID_REPONSE'),
id_question integer NOT NULL REFERENCES Question(id_question),
reponse varchar NOT NULL,
correct boolean DEFAULT FALSE
);

-- La relation Qcm est la clef de voûte de la base de données
CREATE TABLE IF NOT EXISTS Qcm(
id_qcm integer NOT NULL PRIMARY KEY DEFAULT nextval('ID_QCM'),
auteur varchar NOT NULL REFERENCES Questionneur(nom_questionneur),
domaine varchar REFERENCES Domaine(domaine),
sous_domaine varchar REFERENCES Sous_Domaine(sous_domaine),
date_creation date DEFAULT current_date,
niveau varchar DEFAULT 'Normal',
temps_total integer DEFAULT 0,		-- à calculer par la somme de chaque question.temps
note_total float DEFAULT 0.0,		-- à calculer par la somme de chaque question.valeur
visible boolean DEFAULT FALSE,		-- indique si le qcm peut etre vu par un repondeur ou non
fini boolean DEFAULT FALSE			-- indique si le qcm est complet ou non
);

-- La relation Qcm_Question existe uniquement pour lier plusieurs fois une unique question à plusieurs qcm
CREATE TABLE IF NOT EXISTS Qcm_Question(
id_qcm integer REFERENCES Qcm(id_qcm),
id_question integer REFERENCES Question(id_question),
PRIMARY KEY(id_qcm, id_question)
);

-- La relation recap_repondeur stocke les infos réunis pendant l'exécution d'un qcm et sert de sauvegarde
CREATE TABLE IF NOT EXISTS recap_repondeur(
id_repondeur integer REFERENCES Repondeur(id_repondeur),
id_qcm integer REFERENCES Qcm(id_qcm),	
domaine varchar REFERENCES Domaine(domaine),		
sous_domaine varchar REFERENCES Sous_domaine(sous_domaine),
date_qcm_fait timestamp,
note_qcm float,
temps_qcm integer,
PRIMARY KEY(id_repondeur, date_qcm_fait)
);

-- Le role qcm_default est primordial au fonctionnement du site qcm car il permet de dialoguer entre la bdd et le site
-- Il possède des permissions précises pour chaque requête préparée afin de garantir une sécurité maximale
CREATE ROLE qcm_default WITH NOSUPERUSER NOCREATEDB NOINHERIT LOGIN ENCRYPTED PASSWORD 'vX3Hg8i65Z';
GRANT SELECT, INSERT, UPDATE, DELETE ON question TO qcm_default;
GRANT SELECT, INSERT, UPDATE, DELETE ON reponse TO qcm_default;
GRANT SELECT, INSERT, UPDATE, DELETE ON qcm TO qcm_default;
GRANT SELECT, INSERT, UPDATE, DELETE ON qcm_question TO qcm_default;
GRANT SELECT, INSERT ON recap_repondeur TO qcm_default;
GRANT SELECT, INSERT ON domaine TO qcm_default;
GRANT SELECT, INSERT ON sous_domaine TO qcm_default;
GRANT SELECT, UPDATE ON questionneur TO qcm_default;
GRANT SELECT, UPDATE ON repondeur TO qcm_default;
GRANT USAGE ON ALL SEQUENCES IN SCHEMA public TO qcm_default; 
REVOKE CREATE on SCHEMA public FROM qcm_default;
REVOKE CREATE on DATABASE postgres FROM qcm_default;
