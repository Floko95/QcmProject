

/* Script d'insertion des données dans la BDD, à n'utiliser qu'une seule fois après init */

INSERT INTO questionneur (nom_questionneur, mdp_questionneur ) values
('quest','quest'); 	-- questionneur test

INSERT INTO repondeur (nom_repondeur, mdp_repondeur) values
('rep','rep'); 		-- répondeur test

INSERT INTO domaine (nom_domaine) values
('Informatique'),('Mathématiques'),('Culture Générale'),('Médecine'),('Langues'),('Physique Chimie');

INSERT INTO sous_domaine (id_domaine, nom_sous_domaine) values
(1,'BDD'),(1,'PHP'),(1,'JAVA'),(1,'C'),(1,'HTML'),
(2,'Algèbre'),(2,'Géometrie'),(3,'Histoire'),(3,'Cinéma'),
(4,'Neurologie'),(4,'Chirurgie'),(5,'Anglais'),(5,'Espagnol'),
(6,'Physique'),(6,'Chimie');

INSERT INTO question (question) values
('Qu''est ce qu''une clef étrangère ?'),('Combien y a-t-il de formes normales en SQL ?'),('Quelle instruction produit une erreur de syntaxe ?'),
('Quelles sont les balises pour utiliser le php ?'),('Peut-on exécuter du code php depuis un navigateur seul?'),('Que signifie l''acronyme PHP ?'),
('Quelle la principale différence entre le Java et le C ?'),('De combien de Classe peut-on hériter ?'),('Qu''est ce qu''une interface ?'),
('Quel est l''instruction de retour par défaut ?'),('Existe t-il un type boolean en langage C ?'),('A quoi sert le symbole * ?'),
('A quoi sert le langage HTML en informatique ?'),('Avec quel autre langage utilise t-on très souvent l'' HTML ?'),('Comment reconnait-on du code html ?'),
('Quel est le nom de l''algèbre qui se base sur la logique ?'),('Quels sont les trois opérateurs logiques de base ?'),('Quel algorithme permet de résoudre un système à 3 équations ?'),
('Comment appelle t-on un objet avec 7 faces ?'),('Combien d''arrêtes possède un cube ?'),('Si deux plans sont sécants, comment appelle-t-on leur intersection ?'),
('Quand a eu lieu la bataille de Waterloo ?'),('Quel est le vrai nom de l''empereur romain Auguste ?'),('Quelle est la date précise du début de la 2ème guerre mondiale pour la France ?'),
('Dans quel film DiCaprio remporte-t-il son premier Oscar ?'),('Quel est le film le plus rentable de l''Histoire du cinéma ?'),('Quel est le premier long-métrage de Pixar créé uniquement par animation 3D ?');


INSERT INTO reponse (id_question, reponse, correct) values
(1,'Une valeur qui détermine l''unicité de chaque tuple',DEFAULT),(1,'Une valeur qui permet de lier une relation à une autre', TRUE),(1,'Une valeur qui permet d''accéder au rôle d''admin',DEFAULT),(1,'Je ne sais pas',DEFAULT),
(2,'1', DEFAULT),(2,'2', DEFAULT),(2,'3', TRUE),(2,'4', DEFAULT),
(3,'drop <table>',DEFAULT),(3,'select * from <table>',DEFAULT),(3,'delete * from <table>', TRUE),(3,'create <table>', DEFAULT),
(4,'<php> </php>', DEFAULT),(4,'<?php ?>', TRUE),(4,'<php >', DEFAULT),(4,'<!php !>', DEFAULT),
(5,'Oui', DEFAULT),(5,'Seulement si on est connecté à Internet', DEFAULT),(5,'Seulement si le navigateur supporte le php', DEFAULT),(5,'Non', TRUE),
(6,'Physical HTML Processor', DEFAULT),(6,'Hypertext Pre Processor', TRUE),(6,'Hyperserver Post Proxy', DEFAULT),(6,'Processus Host PostgreSQL', DEFAULT),
(7,'Le C est plus utilisé que le Java', DEFAULT),(7,'Le Java sait mieux gérer les ressources systèmes que le C', DEFAULT),(7,'Le Java est un langage objet mais pas le C', TRUE),(7,'Le C possède sa propre machine virtuelle mais pas Java', DEFAULT),
(8,'On ne peut pas utiliser l''héritage en Java', DEFAULT),(8,'1 seule', TRUE),(8,'3 au maximum', DEFAULT),(8,'Autant que l''on souhaite', DEFAULT),
(9,'C''est la manière dont est affichée le code', DEFAULT),(9,'Représente un contrat que doit remplir l''objet implémentant cette interface', TRUE),(9,'Permet d''effectuer un échange de données de manière invisible pour l''utilisateur', DEFAULT),(9,'Montre à quel point le Java est utile', DEFAULT),
(10,'return 0', TRUE),(10,'return 1', DEFAULT),(10,'exit 0', DEFAULT),(10,'exit 1', DEFAULT),
(11,'Non', TRUE),(11,'Non mais il existe bool', DEFAULT),(11,'Oui mais on ne l''utilise jamais', DEFAULT),(11,'Oui', DEFAULT),
(12,'Permet d''ignorer le type d''une variable', DEFAULT),(12,'C''est la marque de fabrique des pointeurs en C', TRUE),(12,'On l''utilise uniquement pour instancier des tableaux', DEFAULT),(12,'Permet d''ignorer le nom d''une variable', DEFAULT),
(13,'C''est utilisé pour la modélisation objet', DEFAULT),(13,'C''est utilisé pour la conception objet', DEFAULT),(13,'C''est utilisé pour la conception web', TRUE),(13,'C''est utilisé pour la modélisation web', DEFAULT),
(14,'Le CSS', TRUE),(14,'Le C sharp', DEFAULT),(14,'Le Python', DEFAULT),(14,'L''UML', DEFAULT),
(15,'On ne peut le comprendre à la première lecture', DEFAULT),(15,'On utilise que des balises', TRUE),(15,'On utilise que des pointeurs', DEFAULT),(15,'On doit le lire de droite à gauche', DEFAULT),
(16,'Descartes', DEFAULT),(16,'Pascal', DEFAULT),(16,'Bool', TRUE),(16,'Gauss', DEFAULT),
(17,'PLUS MOINS EGALE', DEFAULT),(17,'ET OU NON', TRUE),(17,'MULTIPLIE DIVISE RACINE', DEFAULT),(17,'Il n''y en a pas que 3', DEFAULT),
(18,'Algorithme Euclide', DEFAULT),(18,'Algorithme Gauss', TRUE),(18,'Algorithme de Pythagore', DEFAULT),(18,'Algorithme RSA', DEFAULT),
(19,'Septaèdre', DEFAULT),(19,'Heptaèdre', TRUE),(19,'Heptoèdre', DEFAULT),(19,'Septoèdre', DEFAULT),
(20,'10', DEFAULT),(20,'12', TRUE ),(20,'14', DEFAULT),(20,'Il n''y a pas d''arrêtes dans un cube', DEFAULT),
(21,'Un autre plan', DEFAULT),(21,'Une droite', TRUE),(21,'Un segment', DEFAULT),(21,'Un point', DEFAULT),
(22,'1615', DEFAULT),(22,'1715', DEFAULT),(22,'1815', TRUE),(23,'1915', DEFAULT),
(23,'Augustin', DEFAULT),(23,'Hector', DEFAULT),(23,'Octave', TRUE),(23,'Spartacus', DEFAULT),
(24,'1 septembre 1939', DEFAULT),(24,'2 septembre 1939', DEFAULT),(24,'3 septembre 1939', TRUE),(24,'4 septembre 1939', DEFAULT),
(25,'Titanic', DEFAULT),(25,'Le Loup de Wall Street', DEFAULT),(25,'Inception', DEFAULT),(25,'The Revenant', TRUE),
(26,'Avatar', DEFAULT),(26,'Le Monde de Nemo', DEFAULT),(26,'Autant on emporte le vent', TRUE),(26,'Star Wars IV', DEFAULT),
(27,'Les Indestructibles', DEFAULT),(27,'1001 pattes', DEFAULT),(27,'Toy Story', TRUE),(27,'Monstres et cie', DEFAULT);

INSERT INTO qcm (auteur) values
('quest'),
('quest'),
('quest'),
('quest'),
('quest'),
('quest'),
('quest'),
('quest'),
('quest'),
('quest'),
('quest'),
('quest'),
('quest'),
('quest'),
('quest');

INSERT INTO qcm_question values 
(1,1,'Informatique','BDD'),(1,2,'Informatique','BDD'),(1,3,'Informatique','BDD'),(9,4,'Informatique','PHP'),(9,5,'Informatique','PHP'),(9,6,'Informatique','PHP'),
(2,7,'Informatique','JAVA'),(2,8,'Informatique','JAVA'),(2,9,'Informatique','JAVA'),(10,10,'Informatique','C'),(10,11,'Informatique','C'),(10,12,'Informatique','C'),
(3,13,'Informatique','HTML'),(3,14,'Informatique','HTML'),(3,15,'Informatique','HTML'),(11,16,'Mathématiques','Algèbre'),(11,17,'Mathématiques','Algèbre'),(11,18,'Mathématiques','Algèbre'),
(4,19,'Mathématiques','Géometrie'),(4,20,'Mathématiques','Géometrie'),(4,21,'Mathématiques','Géometrie'),(12,22,'Culture Générale','Histoire'),(12,23,'Culture Générale','Histoire'),(12,24,'Culture Générale','Histoire'),
(5,25,'Culture Générale','Cinéma'),(5,26,'Culture Générale','Cinéma'),(5,27,'Culture Générale','Cinéma');
