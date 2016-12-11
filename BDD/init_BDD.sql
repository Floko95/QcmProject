

/* Script d'initialisation de la BDD */

-- connexion qcm_default vX3Hg8i65Z

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
nb_qcm_fait integer DEFAULT 0,
UNIQUE (id_questionneur, nom_questionneur, mdp_questionneur)
);

CREATE TABLE IF NOT EXISTS Repondeur(
id_repondeur integer PRIMARY KEY DEFAULT nextval('ID_REPONDEUR'), 
nom_repondeur varchar NOT NULL UNIQUE,
mdp_repondeur varchar NOT NULL,
									-- preparer et executer les 3 requetes suivantes avant les 3 dernieres pour remplir les attributs de Repondeur
									--> $req1 = SELECT count(id_qcm) FROM recap_repondeur WHERE id_repondeur = ?;
									--> $req2 = SELECT round(avg(note_qcm)::numeric,2) FROM recap_repondeur WHERE id_repondeur = ?;
									--> $req3 = SELECT sum(temps_qcm) FROM recap_repondeur WHERE id_repondeur = ?;
									--> UPDATE recap_repondeur SET nb_qcm_fait = $req1 WHERE id_repondeur = ?;
									--> UPDATE recap_repondeur SET moyenne = $req2 WHERE id_repondeur = ?;
									--> UPDATE recap_repondeur SET temps_total = $req3 WHERE id_repondeur = ?;
nb_qcm_fait integer DEFAULT 0,
moyenne float DEFAULT 0.00,
temps_total integer DEFAULT 0,
UNIQUE (id_repondeur, nom_repondeur, mdp_repondeur)
);

CREATE TABLE IF NOT EXISTS Question(
id_question integer PRIMARY KEY DEFAULT nextval('ID_QUESTION'),
question varchar NOT NULL UNIQUE,
valeur float NOT NULL DEFAULT 1.0,	-- points gagnés lors d'une bonne réponse à la question
temps integer NOT NULL DEFAULT 30, 	-- champs de durée en secondes 
explication varchar DEFAULT NULL	-- texte explicatif à afficher lors de la correction (pas nécessaire)
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
date_creation date DEFAULT current_date,
niveau varchar DEFAULT 'Normal',
temps_total integer,				-- à calculer par la somme de chaque question.temps
note_total float,					-- à calculer par la somme de chaque question.valeur
visible boolean DEFAULT FALSE,		-- indique si le qcm peut etre vu par un repondeur ou non
fini boolean DEFAULT FALSE			-- indique si le qcm est complet ou non
);

CREATE TABLE IF NOT EXISTS Qcm_Question(
id_qcm integer REFERENCES Qcm(id_qcm),
id_question integer REFERENCES Question(id_question),
nom_domaine varchar REFERENCES Domaine(nom_domaine),
nom_sous_domaine varchar REFERENCES Sous_Domaine(nom_sous_domaine),
PRIMARY KEY(id_qcm, id_question)
);

CREATE TABLE IF NOT EXISTS recap_repondeur(
id_repondeur integer REFERENCES Repondeur(id_repondeur),
									-- à récupérer à la fin d'un qcm A TITRE D'EXEMPLE :
									--> $req1 = Recuperer l'id_qcm que le repondeur va faire
									--> $req2 = SELECT nom_domaine FROM qcm_question JOIN qcm ON id_qcm WHERE id_qcm = $req1;
									--> $req3 = SELECT nom_sous_domaine FROM qcm_question JOIN qcm On id_qcm WHERE id_qcm = $req1;
									--> INSERT INTO recap_repondeur (id_qcm, domaine, sous_domaine, date_qcm, note_qcm, temps_qcm) 
									--> VALUES ($req1, $req2, $req3, date_trunc('seconds', now()), $note_obtenue, $temps_passee);
id_qcm integer REFERENCES Qcm(id_qcm),	
nom_domaine varchar REFERENCES Domaine(nom_domaine),		
nom_sous_domaine varchar REFERENCES Sous_Domaine(nom_sous_domaine),
date_qcm_fait timestamp,
note_qcm float,
temps_qcm integer,
PRIMARY KEY(id_repondeur, date_qcm_fait)
);

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
