CREATE TABLE Qcm (
id_qcm int,
auteur varchar,
theme varchar,
sous_theme varchar,
date_creation date,
niveau varchar,
note double,
PRIMARY KEY(id_qcm),
FOREIGN KEY (auteur) REFERENCES Acteur(utilisateur)
);

CREATE TABLE QCM_Question(
id_qcm int,
id_question int,
PRIMARY KEY (id_qcm,id_question),
FOREIGN KEY(id_qcm) REFERENCES Qcm(id_qcm),
FOREIGN KEY(id_question) REFERENCES Question(id_question)
);

CREATE TABLE Question(
id_question int,
question varchar,
PRIMARY KEY (id_question)
);

CREATE TABLE Question_Reponse(
id_question int,
id_reponse int,
PRIMARY KEY(id_question,id_qcm),
FOREIGN KEY(id_question) REFERENCES Question(id_question),
FOREIGN KEY(id_reponse) REFERENCES Reponse(id_reponse)
);

CREATE TABLE Reponse(
id_reponse int,
reponse varchar,
PRIMARY KEY (id_reponse)
);

CREATE TABLE Acteur(
utilisateur varchar,
rep_ques boolean,
nb_qcm int,
PRIMARY KEY (utilisateur)
);

CREATE TABLE ReponsesQCMRepondant(
utilisateur varchar,
id_qcm int,
id_reponse int,
rep_donnee varchar,
PRIMARY KEY (utilisateur,id_qcm),
FOREIGN KEY(utilisateur) REFERENCES Acteur(utilisateur)
);

CREATE TABLE Statistiques(
utilisateur varchar,
moyenne double,
note_qcm double,
temps_passe double,
PRIMARY KEY (utilisateur),
FOREIGN KEY(utilisateur) REFERENCES ReponsesQCMRepondant(utilisateur)
);