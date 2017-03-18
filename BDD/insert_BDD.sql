

/* Script d'insertion des données dans la BDD, à n'utiliser qu'une seule fois après init */

/* ATTENTION LES MDP ONT ETE CRYPTES DANS LA BDD */

INSERT INTO utilisateur (login, password,role) values
('Gayral',crypt('Projetqcm16',gen_salt('bf',8)),'questionneur'),
('Santini',crypt('System16',gen_salt('bf',8)),'questionneur'),
('Avril',crypt('Java16',gen_salt('bf',8)),'questionneur'),
('Charroux',crypt('Method16',gen_salt('bf',8)),'questionneur'),
('Buscaldi',crypt('Linux16',gen_salt('bf',8)),'questionneur'),
('Hebert',crypt('Math16',gen_salt('bf',8)),'questionneur'),
('Noel',crypt('Culture16',gen_salt('bf',8)),'questionneur'),
('Martinez',crypt('Anglais16',gen_salt('bf',8)),'questionneur'),
('Desigual',crypt('Espagnol16',gen_salt('bf',8)),'questionneur'),
('Daloz',crypt('Latin16',gen_salt('bf',8)),'questionneur'),
('Ayme',crypt('Francais16',gen_salt('bf',8)),'questionneur'),
('Mayeur',crypt('Nature16',gen_salt('bf',8)),'questionneur'),
('Dubois',crypt('Chimie16',gen_salt('bf',8)),'questionneur'),

('Françoise',crypt('Gayral',gen_salt('bf',8)),DEFAULT),
('Charlie',crypt('Didier',gen_salt('bf',8)),DEFAULT),
('Lucie',crypt('Godefert',gen_salt('bf',8)),DEFAULT);

INSERT INTO domaine (domaine) values
('Informatique'),('Mathématiques'),('Culture Générale'),('Langues'),('Français'),('Sciences');

INSERT INTO sous_domaine (id_domaine, sous_domaine) values
(1,'BDD'),(1,'PHP'),(1,'JAVA'),(1,'C'),(1,'HTML'),(1,'UML'),(1,'Linux'),(1,'Python'),
(2,'Algèbre'),(2,'Géometrie'),(2,'Cryptanalyse'),(2,'Graphes et langages'),
(3,'Histoire'),(3,'Géographie'),(3,'Musique'),(3,'Cinéma'),
(4,'Anglais'),(4,'Espagnol'),(4,'Latin'),
(5,'Conjugaison'),(5,'Orthographe'),(5,'Grammaire'),
(6,'SVT'),(6,'Physique Chimie');

INSERT INTO question (question,explication) values
('Qu''est ce qu''une clef étrangère ?',DEFAULT),('Combien y a-t-il de formes normales en SQL ?',DEFAULT),('Quelle instruction produit une erreur de syntaxe ?',DEFAULT),
('Lequel de ces systèmes de SGBD n''existe pas ?',DEFAULT),('A quoi sert un index ?',DEFAULT),('Existe t-il un moyen de faire des instructions procédurales couplées à des requêtes ?',DEFAULT),

('Quelles sont les balises pour utiliser le php ?',DEFAULT),('Peut-on exécuter du code php depuis un navigateur seul?','Sans manipulation extérieur au navigateur'),('Que signifie l''acronyme PHP ?',DEFAULT),
('Les fichiers php peuvent-ils se subsituer aux fichiers html ?','Dans le sens peut-on faire un site avec uniquement des fichiers php'),('Comment prévenir d''une attaque par injection SQL ?',DEFAULT),('Que fait la fonction krsort() ?',DEFAULT),

('Quelle est la principale différence entre le Java et le C ?',DEFAULT),('De combien de classe peut-on hériter ?',DEFAULT),('Qu''est ce qu''une interface ?',DEFAULT),
('Comment récupérer une saisie utilisateur ?',DEFAULT),('Quelle classe permet l''instanciation de fenêtre en Java ?','Cette classe est située dans Javax.swing'),('Comment lève t-on une exception en Java ?',DEFAULT),

('Quelle est l''instruction de retour par défaut ?',DEFAULT),('Existe t-il un type boolean en langage C ?',DEFAULT),('A quoi sert le symbole * ?',DEFAULT),
('Comment créer une constante dans un code en C ?',DEFAULT),('Quelle ligne permet d''afficher en erreur ?',DEFAULT),('Quel est l''extension des bibliothèques en C ?','Uniquement la lettre après le point'),

('A quoi sert le langage HTML en informatique ?',DEFAULT),('Avec quel autre langage utilise t-on très souvent l'' HTML ?',DEFAULT),('Comment reconnait-on du code html ?',DEFAULT),
('Quel balise permet d''afficher des images ?',DEFAULT),('Peut-on substituer le css par le html ?',DEFAULT),('Quel balise permet de faire des liens hyper-texte ?',DEFAULT),

('Que signifie le sigle UML ?',DEFAULT),('A quoi sert la modélisation en général ?',DEFAULT),('Citez différents diagrammes que l''on peut réaliser','Cochez les diagrammes qui existent réellement'),
('Comment s''appelle la fonction qui permet de créer le code java à partir d''un diagramme uml ?',DEFAULT),('Comment traduire un cahier des charges en diagramme uml ?',DEFAULT),('Peut-on symboliser des contraintes avec UML ?',DEFAULT),

('Quand est-ce que le système UNIX a été créé ?',DEFAULT),('Citez quelques distributions réelles de Linux',DEFAULT),('Comment appelle t-on un processus fils qui continue alors que son processus père est mort ?',DEFAULT),
('Quel est le système de fichier propre à Linux ?',DEFAULT),('Quels sont les avantages à utiliser Linux par rapport à Windows ?',DEFAULT),('Que permet le bash sous Linux ?',DEFAULT),

('A quel(s) type(s) de langage appartient Python ?','Donnez ses caractéristiques'),('Comment sont identifiés les blocs d''instruction ?',DEFAULT),
('Que fait le mot clef yield ?',DEFAULT),('Quelles fonctions sont inexistantes de base avec Python ?',DEFAULT),('Est ce que Python comporte un Garbage Collector ?','Un videur de mémoire automatique'),

('Quel est le nom de l''algèbre qui se base sur la logique ?',DEFAULT),('Quels sont les trois opérateurs logiques de base ?',DEFAULT),('Quel algorithme permet de résoudre un système à 3 équations ?',DEFAULT),
('Quelles sont les propriétés de la loi de composition interne " + " ?',DEFAULT),('En algèbre linéaire, qu''est ce qu''un vecteur ?',DEFAULT),('Comment inverser une matrice ?','De quoi a t-on besoin ?'),

('Comment appelle t-on un objet avec 7 faces ?',DEFAULT),('Combien d''arrêtes possède un cube ?',DEFAULT),('Si deux plans sont sécants, comment appelle-t-on leur intersection ?',DEFAULT),
('Que signifie géométrie complexe ?',DEFAULT),('Que signifie qu''un objet est coplanaire ?',DEFAULT),('A quel moment un produit scalaire de deux vecteurs est-il égal à 0 ?',DEFAULT),

('Quelle est la fonction de chiffrement en méthode affine ?',DEFAULT),('Quelle est la condition pour que 2 nombres soient premiers entre eux ?',DEFAULT),('Enoncez le théorème de la division euclidienne',DEFAULT),
('En méthode César, décodez 18-00-15-07-08-17',DEFAULT),('Comment appelle t-on l''écriture en base 150 ?',DEFAULT),('Qu''est ce qui différencie RSA des autres cryptosystèmes ?','Ne cherchez pas compliqué !'),

('Quelles sont les différences entre un graphe orienté et un graphe non orienté ?',DEFAULT),('Qu''est ce qu''un langage ?',DEFAULT),('Comment appelle t-on les élements Γ−(x, G) ?',DEFAULT),
('A quelle condition un graphe est-il sans circuit ?',DEFAULT),('Quel algorithme permet de déterminer le nombre chromatique d''un graphe ?',DEFAULT),('Quel algorithme permet de trouver le plus court chemin entre chaque sommet ?',DEFAULT),

('Quand a eu lieu la bataille de Waterloo ?',DEFAULT),('Quel est le vrai nom de l''empereur romain Auguste ?',DEFAULT),('Quelle est la date précise du début de la 2ème guerre mondiale pour la France ?',DEFAULT),
('Quel traité est constitutif de l''Union Européenne ?',DEFAULT),('Qui a découvert l''Amérique et en quelle année ?',DEFAULT),('A quel siècle le mouvement architectural gothique apparait-il en France ?',DEFAULT),

('Où se situe l''ile de la Réunion ?',DEFAULT),('Qu''appelle-t-on les pays développés ?','Quelle est leur caractéristique'),('A quel enjeu géo-politique répondit le protocole de Kyoto ?',DEFAULT),
('De quoi est majoritairement composé l''Antarctique ?',DEFAULT),('Quelle est la première puissance économique mondiale actuelle ?','Depuis 2014'),('Où se situe le cap de bonne-espérance ?',DEFAULT),

('Quel groupe britannique a chanté "Let it be" ?',DEFAULT),('Quel pays triompha lors de l''eurovision de 2014 ?',DEFAULT),('Quel chanteur français a fait son grand retour en 2016 ?',DEFAULT),
('Qui chante le tube des années 80 "Take on Me" ?',DEFAULT),('Quel consortium d''artiste effectue un spectacle annuel au nom des Restos du Cœur ?',DEFAULT),('Quelle chanteuse est d''origine québéquoise ?',DEFAULT),

('Dans quel film DiCaprio remporte-t-il son premier Oscar ?',DEFAULT),('Quel est le film le plus rentable de l''Histoire du cinéma ?',DEFAULT),('Quel est le premier long-métrage de Pixar créé uniquement par animation 3D ?',DEFAULT),

('Quelle est la marque de la 3ème personne du singulier ?',DEFAULT),('Comment dit-on "Escalier" en anglais ?',DEFAULT),('Parmi ces verbes, lesquels sont irréguliers ?',DEFAULT),
('Quelle est la principale différence entre l''anglais britannique et américain ?',DEFAULT),('Comment traduire "informatique" en anglais ?',DEFAULT),('Quel est la marque du superlatif régulier en anglais ?','Quel mot faut-il ajouter'),

('Parmi ces pays, lequels ne sont pas hispanophones ?',DEFAULT),('A quoi sert le "usted" en espagnol ?',DEFAULT),('Comment bien utiliser le verbe "Gustar" ?','De quoi a t-on besoin pour la structure'),

('A quoi correspond la dernière forme d''un verbe latin ?','Quand on cherche un verbe dans le dictionnaire'),('Quel est le genre du mot "arma" ?',DEFAULT),('Quel est l''impératif du verbe "eo" ?','Verbe aller : eo, is, ire, ivi, itum'),
('Quelle est la différence entre l''utilisation du démonstratif "hic" et "ille" ?','Différence de sens'),('Quel temps du subjonctif se forme à partir de l''infinitif du verbe ?',DEFAULT),('Dans la 3ème déclinaison, dans quel cas le génitif pluriel donne "-ium" ?',DEFAULT),

('Quelle est le groupe du verbe "Aller" ?',DEFAULT),('Quelle est la forme du verbe "Savoir" à la 1ere personne du singulier du subjonctif imparfait ?',DEFAULT),('A quels temps le verbe courir prend deux "r" ?',DEFAULT),
('Comment se forme le conditionnel passé ?',DEFAULT),('Quel est le participe passé de "Dire" ?',DEFAULT),

('Quels modes sont le plus souvent utilisés dans une tournure interrogative ?',DEFAULT),('A quel moment utilise t-on un complément d''agent ?',DEFAULT),('Parmi ces mots, lesquels sont des conjonctions de coordination ?',DEFAULT),
('Avec quel auxiliaire faut-il toujours accorder en genre et en nombre ?',DEFAULT),('Le mot "second" est un...',DEFAULT),

('Quand faut-il rajouter un "s" à la fin du mot "vingt" ?',DEFAULT),('Comment se forme le pluriel des noms en "-ail" en général ?','Sauf les exceptions'),('Complétez la phrase suivante ; J''ai pris des chaussettes ...',DEFAULT),
('Complétez la phrase suivante : Tu étais ... venir ce matin.',DEFAULT),('Complétez la phrase suivante : Tu m''as mis ... de moi',DEFAULT),

('Quelle est la différence entre mitose et méiose ?',DEFAULT),('Comment appelle-t-on l''équivalent de l''ovaire pour une fleur ?',DEFAULT),('L''ADN est une molécule ...',DEFAULT),('Comment appelle-t-on une roche volcanique qui s''est solidifée rapidement ?',DEFAULT),
('Quelle roche est le principal constituant de la croûte océanique ?',DEFAULT),('Comment s''appelle le procédé permettant à la majorité des plantes de transformer le CO2 en O2 ?',DEFAULT),('Quel nerf permet de ralentir la fréquence cardiaque si stimulé ?',DEFAULT),

('Quel domaine de la physique se concentre sur la lumière ?',DEFAULT),('Quel loi de Newton permet de vérifier qu''un système est isolé ou pseudo-isolé ?',DEFAULT),('Quelle couleur est absorbée par une faisceau de longueur d''onde 650 nm ?',DEFAULT),
('Combien vaut la vitesse de la lumière ?','En mètres/secondes'),('Quel est le symbole de l''Azote ?',DEFAULT),('Comment appelle-t-on une solution avec un pH supérieur à 7 ?',DEFAULT);

INSERT INTO reponse (id_question, reponse, correct) values
-- BDD
(1,'Une valeur qui détermine l''unicité de chaque tuple',DEFAULT),(1,'Une valeur qui permet de lier une relation à une autre', TRUE),(1,'Une valeur qui permet d''accéder au rôle d''admin',DEFAULT),
(2,'1', DEFAULT),(2,'2', DEFAULT),(2,'3', TRUE),(2,'4', DEFAULT),
(3,'drop <table>',DEFAULT),(3,'select * from <table>',DEFAULT),(3,'delete * from <table>', TRUE),(3,'create <table>', DEFAULT),
(4,'MySQL',DEFAULT),(4,'PostgreSQL',DEFAULT),(4,'Oracle',DEFAULT),(4,'MySQL',DEFAULT),(4,'Microsoft Access',DEFAULT),(4,'ExSQL',TRUE),
(5,'A trier les données',TRUE),(5,'Pour obtenir une aide lors d''une requete',DEFAULT),(5,'Pour optimiser les temps d''accès',TRUE),
(6,'Oui avec le C',DEFAULT),(6,'Oui avec le PL/SQL',TRUE),(6,'Oui avec le JavaScript',DEFAULT),(6,'Non c''est impossible',DEFAULT),(6,'Non le standard SQL ne le permet pas',DEFAULT),

-- PHP
(7,'<php> </php>', DEFAULT),(7,'<?php ?>', TRUE),(7,'<php >', DEFAULT),(7,'<!php !>', DEFAULT),
(8,'Oui', DEFAULT),(8,'Seulement si on est connecté à Internet', DEFAULT),(8,'Seulement si le navigateur supporte le php', DEFAULT),(8,'Non', TRUE),
(9,'Physical HTML Processor', DEFAULT),(9,'Hypertext Pre Processor', TRUE),(9,'Hyperserver Post Proxy', DEFAULT),(9,'Processus Host PostgreSQL', DEFAULT),
(10,'Oui totalement',TRUE),(10,'Oui partiellement',DEFAULT),(10,'Non, le HTML reste nécessaire',DEFAULT),(10,'Non, car le navigateur a besoin de code HTML pour l''affichage',DEFAULT),
(11,'En utilisant une methode de hachage',DEFAULT),(11,'Impossible de se protéger de ce type d''attaque',DEFAULT),(11,'En utilisant un marqueur de place',TRUE),
(12,'Trie le tableau aléatoirement',DEFAULT),(12,'Trie le tableau en fonction des clefs',TRUE),(12,'Trie le tableau à l''envers',TRUE),(12,'Trie le tableau en ordre décroissant des clefs',DEFAULT),

-- JAVA
(13,'Le C est plus utilisé que le Java', DEFAULT),(13,'Le Java sait mieux gérer les ressources systèmes que le C', DEFAULT),(13,'Le Java est un langage objet mais pas le C', TRUE),(13,'Le C possède sa propre machine virtuelle mais pas Java', DEFAULT),
(14,'On ne peut pas utiliser l''héritage en Java', DEFAULT),(14,'1 seule', TRUE),(14,'3 au maximum', DEFAULT),(14,'Autant que l''on souhaite', DEFAULT),
(15,'C''est la manière dont est affichée le code', DEFAULT),(15,'Représente un contrat que doit remplir l''objet implémentant cette interface', TRUE),(15,'Permet d''effectuer un échange de données de manière invisible pour l''utilisateur', DEFAULT),(15,'Montre à quel point le Java est utile', DEFAULT),
(16,'Elle est récupérée automatiquement par la JVM', DEFAULT),(16,'Il faut faire appel à un scanner', TRUE),(16,'C''est à la fonction main de s''en occuper', DEFAULT),(16,'Elle ne peut pas être récupérer en Java', DEFAULT),
(17,'JFrame', TRUE),(17,'JFen', DEFAULT),(17,'JWindows', DEFAULT),(17,'JBorder', DEFAULT),(17,'JavaFenetre', DEFAULT),
(18,'On utilise les blocs Try{} et Catch{}', TRUE),(18,'On délègue à la classe Exception.java', TRUE),(18,'On s''arrange pour que le code ne puisse pas engendrer d''exception', DEFAULT),(18,'On crée sa propre classe pour gérer les exceptions', TRUE),

-- C
(19,'return 0', TRUE),(19,'return 1', DEFAULT),(19,'exit 0', DEFAULT),(19,'exit 1', DEFAULT),
(20,'Non', TRUE),(20,'Non mais il existe bool', DEFAULT),(20,'Oui mais on ne l''utilise jamais', DEFAULT),(20,'Oui', DEFAULT),
(21,'Permet d''ignorer le type d''une variable', DEFAULT),(21,'C''est la marque de fabrique des pointeurs en C', TRUE),(21,'On l''utilise uniquement pour instancier des tableaux', DEFAULT),(21,'Permet d''ignorer le nom d''une variable', DEFAULT),
(22,'On utilise @', DEFAULT),(22,'On utilise #', TRUE),(22,'On utilise %', DEFAULT),(22,'On utilise ?', DEFAULT),(22,'On utilise !', DEFAULT),
(23,'fprint(error)', DEFAULT),(23,'printErr', DEFAULT),(23,'callErr(error)', DEFAULT),(23,'stderr', TRUE),
(24,'B', DEFAULT),(24,'C', DEFAULT),(24,'H', TRUE),(24,'L', DEFAULT),(24,'X', DEFAULT),

-- HTML
(25,'C''est utilisé pour la modélisation objet', DEFAULT),(25,'C''est utilisé pour la conception objet', DEFAULT),(25,'C''est utilisé pour la conception web', TRUE),(25,'C''est utilisé pour la modélisation web', DEFAULT),
(26,'Le CSS', TRUE),(14,'Le C sharp', DEFAULT),(26,'Le Python', DEFAULT),(26,'L''UML', DEFAULT),
(27,'On ne peut le comprendre à la première lecture', DEFAULT),(27,'On utilise que des balises', TRUE),(27,'On utilise que des pointeurs', DEFAULT),(27,'On doit le lire de droite à gauche', DEFAULT),
(28,'<pic: >', DEFAULT),(28,'<img: >', TRUE),(28,'<photo: >', DEFAULT),
(29,'Oui totalement', DEFAULT),(29,'Oui partiellement', TRUE),(29,'Non, le css est totalement à part', DEFAULT),(29,'Je ne pense pas', DEFAULT),
(30,'<a /a>', TRUE),(30,'<ht /ht>', DEFAULT),(30,'<link /link>', DEFAULT),(30,'<text /text>', DEFAULT),

-- UML
(31,'Unified Modeling Language', TRUE),(31,'United Mod Lambda', DEFAULT),(31,'Unicode Method Language', DEFAULT),
(32,'Pour que ça fasse joli lors de la démonstration au client', DEFAULT),(32,'Permet l''analyse des besoins du client', TRUE),(32,'Permet de mettre en place une base saine avant de coder', TRUE),(32,'A pas grand chose sauf perdre du temps', DEFAULT),
(33,'Diagramme de classe', TRUE),(33,'Diagramme de fonction', DEFAULT),(33,'Diagramme de séquence', TRUE),(33,'Diagramme d''activité', TRUE),(33,'Diagramme de répartition', DEFAULT),(33,'Diagramme d''objet', TRUE),
(34,'L''inversion de code', DEFAULT),(34,'L''exportation des fonctions', DEFAULT),(34,'La rétro ingénierie', TRUE),(34,'L''exportation des classes objets', DEFAULT),
(35,'Avec un diagramme de classe', TRUE),(35,'Avec une modélisation sur un logiciel de conception 3D', DEFAULT),(35,'Avec un diagramme de cas d''utilisation', TRUE),(35,'Avec un éditeur de texte', DEFAULT),
(36,'Non', DEFAULT),(36,'Non il faut le coupler à un autre langage de contrainte', TRUE),(36,'Oui avec des flèches en pointillés', DEFAULT),

-- LINUX
(37,'1967', DEFAULT),(37,'1969', TRUE),(37,'1971', DEFAULT),(37,'1973', DEFAULT),(37,'1975', DEFAULT),
(38,'Ubuntu', TRUE),(38,'Debian', TRUE),(38,'Velian', DEFAULT),(38,'Lubuntu', TRUE),(38,'Dubuntu', DEFAULT),
(39,'Un survivant', DEFAULT),(39,'Un orphelin', TRUE),(39,'Un zombie', DEFAULT),(39,'Ce n''est pas possible, le fils est tué lorsque son père meurt', DEFAULT),
(40,'FAT32', DEFAULT),(40,'NTFS', DEFAULT),(40,'HFS+', DEFAULT),(40,'ext4', TRUE),
(41,'Linux utilise mieux la mémoire disponible', TRUE),(41,'Windows a du mal à gérer les fichiers de grande taille', DEFAULT),(41,'Linux est gratuit et open-source', TRUE),
(42,'La programmation en ligne de commande', TRUE),(42,'Créer des alias pour certaines commandes', TRUE),(42,'Utiliser n''importe quelle application installée', TRUE),(42,'Faire un café', DEFAULT),

-- PYTHON
(43,'Objet', TRUE),(43,'Interprété', TRUE),(43,'Contrainte', DEFAULT),(43,'Base de données', DEFAULT),(43,'Multiplateforme', TRUE),(43,'Contrainte', DEFAULT),
(44,'Avec des accolades', DEFAULT),(44,'Avec des sauts de ligne', TRUE),(44,'Pas besoin de les identifier', DEFAULT),(44,'Avec des antislashs', DEFAULT),(44,'Avec des points virgules', DEFAULT),
(45,'Elle retourne les valeurs données par un générateur', DEFAULT),(45,'Elle retourne un générateur', TRUE),(45,'Elle permet de sortir d''une itération', DEFAULT),
(46,'While{}', DEFAULT),(46,'Do{} While', TRUE),(46,'Switch{ case }', TRUE),(46,'For{}', DEFAULT),
(47,'Oui mais il faut l''appeler au début du main', DEFAULT),(47,'Oui comme en Java', TRUE),(47,'Non il faut désallouer à la main', DEFAULT),(47,'Non un script python ne requiert par de mémoire', DEFAULT),

-- ALGEBRE
(48,'Descartes', DEFAULT),(48,'Pascal', DEFAULT),(48,'Bool', TRUE),(48,'Gauss', DEFAULT),
(49,'PLUS MOINS EGALE', DEFAULT),(49,'ET OU NON', TRUE),(49,'MULTIPLIE DIVISE RACINE', DEFAULT),(49,'Il n''y en a pas que 3', DEFAULT),
(50,'Algorithme Euclide', DEFAULT),(50,'Algorithme Gauss', TRUE),(50,'Algorithme de Pythagore', DEFAULT),(50,'Algorithme RSA', DEFAULT),
(51,'On peut utiliser l''addition', TRUE),(51,'On peut utiliser la soustraction', DEFAULT),(51,'On peut utiliser la multiplication', TRUE),(51,'On peut utiliser la division', DEFAULT),
(52,'Un élement réel', DEFAULT),(52,'Un segment dans l''espace', DEFAULT),(52,'La solution à un système à plusieurs inconnues', TRUE),(52,'Une flèche dans un repère', DEFAULT),
(53,'Il faut une autre matrice', DEFAULT),(53,'Il existe un déterminant inversible non nul', TRUE),(53,'La somme des nombres des lignes est égale à la somme des nombres des colonnes', DEFAULT),

-- GEOMETRIE
(54,'Septaèdre', DEFAULT),(54,'Heptaèdre', TRUE),(54,'Heptoèdre', DEFAULT),(54,'Septoèdre', DEFAULT),
(55,'10', DEFAULT),(55,'12', TRUE ),(55,'14', DEFAULT),(55,'Il n''y a pas d''arrêtes dans un cube', DEFAULT),
(56,'Un autre plan', DEFAULT),(56,'Une droite', TRUE),(56,'Un segment', DEFAULT),(56,'Un point', DEFAULT),
(57,'C''est plus compliqué que la géométrie de base', DEFAULT),(57,'Géométrie dans l''espace vectoriel complexe', TRUE),(57,'Géométrie dans la 4eme Dimension', DEFAULT),(57,'Aucune Idée', DEFAULT),
(58,'Si ils appartiennent au même plan', TRUE),(58,'Si ils ont une intersection en un point unique', DEFAULT),(58,'Si ils sont de même longeur', DEFAULT),(58,'Si ils sont confondus', DEFAULT),
(59,'Lorsque les vecteurs possèdent une intersection en leur milieu', DEFAULT),(59,'Lorsque les vecteurs sont identiques non nuls', DEFAULT),(59,'Lorsque les vecteurs sont inverse l''un de l''autre ', DEFAULT),(59,'Lorsque les vecteurs sont orthogonaux', TRUE),

-- CRYPTANALYSE
(60,'b-x/a modulo 26', DEFAULT),(60,'a*x^2 modulo 26', DEFAULT),(60,'ax+b modulo 26', TRUE),(60,'a^x*b^x modulo 26', DEFAULT),
(61,'Leur pgcd doit être égal à 1', TRUE),(61,'Leur soustraction doit être nulle', DEFAULT),(61,'Leur carré respectif doit être un multiple de 3 ', DEFAULT),(61,'Ils doivent être pairs', DEFAULT),
(62,'a = b*q+r', TRUE),(62,'b/(q-a) = r', DEFAULT),(62,'b/q > a^r',DEFAULT),(62,'0 <= r <b', TRUE),
(63,'Saleté', DEFAULT),(63,'Sobres', DEFAULT),(63,'Saphir', TRUE),(63,'Salami', DEFAULT),(63,'Zéphyr', DEFAULT),
(64,'Ecriture en base 150', DEFAULT),(64,'Ecriture en base Coréenne', DEFAULT),(64,'Ecriture en base Indienne', TRUE),(64,'Ecriture en base Cyrillique', DEFAULT),
(65,'Le RSA n''est en fait pas un cryptosystème entier', DEFAULT),(65,'Le RSA est asymétrique', TRUE),(65,'Le RSA n''est plus utilisé depuis 1944', DEFAULT),

-- GRAPHE ET LANGAGE
(66,'Le premier comprend des flèches mais pas le second', TRUE),(66,'Le second est constitué d''arêtes et le premier, d''arcs', TRUE),(66,'Le premier a des sommets mais pas le second', DEFAULT),(66,'Le second a une cardinalité mais pas le premier', DEFAULT),
(67,'La manière de créer un graphe orienté', DEFAULT),(67,'Une partie d''un alphabet', TRUE),(67,'Un ensemble de mot formant des anagrammes', DEFAULT),
(68,'Les successeurs', DEFAULT),(68,'Les prédécesseurs', DEFAULT),(68,'Les descendants', DEFAULT),(68,'Les ascendants', TRUE),
(69,'Si on peut recréer ce même graphe à l''identique', DEFAULT),(69,'Si il ne comporte aucune chaines', TRUE),(69,'Si il contient 2 ou plusieurs boucles', DEFAULT),(69,'Si il ne comporte pas de redondance de sommet', DEFAULT),
(70,'Algorithme de Gauss', DEFAULT),(70,'Algorithme de Braun', DEFAULT),(70,'Algorithme de Brélaz', TRUE),(70,'Algorithme de Kuratowski', DEFAULT),
(71,'Algorithme de Dichotomie', DEFAULT),(71,'Algorithme de Dijkstra', TRUE),(71,'Algorithme de Kruskal', DEFAULT),(71,'Algorithme de Pythagore', DEFAULT),

-- HISTOIRE
(72,'1615', DEFAULT),(72,'1715', DEFAULT),(72,'1815', TRUE),(73,'1915', DEFAULT),
(73,'Octave', TRUE),(73,'Augustin', DEFAULT),(73,'Hector', DEFAULT),(73,'Spartacus', DEFAULT),
(74,'1 septembre 1939', DEFAULT),(74,'2 septembre 1939', DEFAULT),(74,'3 septembre 1939', TRUE),(74,'4 septembre 1939', DEFAULT),
(75,'Traité de Kyoto', DEFAULT),(75,'Traité de Londres', DEFAULT),(75,'Traité de Genève', DEFAULT),(75,'Traité de Maastricht', TRUE),
(76,'Alexandre le Grand en 1392', DEFAULT),(76,'Christophe Colomb en 1492', TRUE),(76,'Jules Vernes en 1592', DEFAULT),(76,'Fernand de Magellan en 1692', DEFAULT),
(77,'XI ème siècle', DEFAULT),(77,'XII ème siècle', TRUE),(77,'XIII ème siècle', DEFAULT),(77,'XIV ème siècle', DEFAULT),

-- GEOGRAPHIE
(78,'Océan Atlantique', DEFAULT),(78,'Océan Pacifique', DEFAULT),(78,'Océan Indien', TRUE),(78,'Mer Morte', DEFAULT),(78,'Mer Baltique', DEFAULT),
(79,'Ce sont les pays avec le meilleur IDH', TRUE),(79,'Ce sont les pays qui siègent à l''ONU', DEFAULT),(79,'Ce sont les pays qui ont les plus grandes populations', DEFAULT),(79,'Ce sont les pays possédant le plus de pétrole', DEFAULT),
(80,'Le néo-libéralisme dans le monde', DEFAULT),(80,'Le réchauffement climatique', TRUE),(80,'La surconsommation de ressources épuisables', DEFAULT),(80,'La chute de l''URSS', DEFAULT),
(81,'De terre', DEFAULT),(81,'De roches volcaniques', DEFAULT),(81,'De glace', TRUE),(81,'De plastique', DEFAULT),
(82,'Les Etats-Unis', DEFAULT),(82,'Le Brésil', DEFAULT),(82,'La Corée du Sud', DEFAULT),(82,'La Chine', TRUE),(82,'L''Allemagne', DEFAULT),
(83,'Au sud de l''Argentine', DEFAULT),(83,'Au sud de l''Afrique du Sud', TRUE),(83,'Au sud du Japon', DEFAULT),

-- MUSIQUE
(84,'The Beatles', TRUE),(84,'U2', DEFAULT),(84,'Coldplay', DEFAULT),(84,'Trust', DEFAULT),
(85,'France', DEFAULT),(85,'Italie', DEFAULT),(85,'Autriche', TRUE),(85,'Pologne', DEFAULT),(85,'Portugal', DEFAULT),
(86,'Frero De La Vega', DEFAULT),(86,'Renaud', TRUE),(86,'Alain Souchon', DEFAULT),(86,'MC Solaar', DEFAULT),
(87,'Duran Duran', DEFAULT),(87,'Wham!', DEFAULT),(87,'Depeche Mode', DEFAULT),(87,'A-ha', TRUE),
(88,'Les margoulins', DEFAULT),(88,'Les enfoirés', TRUE),(88,'Les vendus', DEFAULT),(88,'Les salopards', DEFAULT),
(89,'Céline Dion', TRUE),(89,'Lara Fabian', DEFAULT),(89,'Coeur De Pirate', TRUE),(89,'Natasha St-Pier', DEFAULT),

-- CINEMA
(90,'Titanic', DEFAULT),(90,'Le Loup de Wall Street', DEFAULT),(90,'Inception', DEFAULT),(90,'The Revenant', TRUE),
(91,'Avatar', DEFAULT),(91,'Le Monde de Nemo', DEFAULT),(91,'Autant on emporte le vent', TRUE),(91,'Star Wars IV', DEFAULT),
(92,'Les Indestructibles', DEFAULT),(92,'1001 pattes', DEFAULT),(92,'Toy Story', TRUE),(92,'Monstres et cie', DEFAULT),

-- ANGLAIS
(93,'Il faut mettre le sujet en majuscule', DEFAULT),(93,'Il faut mettre un S à la fin du verbe conjugué', TRUE),(93,'Il faut écrire "do" entre le verbe et le COD', DEFAULT),
(94,'Ladders', DEFAULT),(94,'Roofs', DEFAULT),(94,'Floors', DEFAULT),(94,'Stairs', TRUE),
(95,'Travel', DEFAULT),(95,'Go', TRUE),(95,'Be', TRUE),(95,'Run', DEFAULT),(95,'Come', TRUE),(95,'Live', DEFAULT),
(96,'Les américains préfèrent dire Center au lieu de Centre', TRUE),(96,'Les américains font des abréviations en permanence', TRUE),(96,'Les britanniques utilisent moins de ponctuation orale', DEFAULT),
(97,'Computer Science', TRUE),(97,'Informatic', DEFAULT),(97,'Computer', DEFAULT),(97,'Engineering', DEFAULT),
(98,'Best', DEFAULT),(98,'More', DEFAULT),(98,'Less', DEFAULT),(98,'Most', TRUE),

-- ESPAGNOL
(99,'Portugal', TRUE),(99,'Mexique', DEFAULT),(99,'Cuba', DEFAULT),(99,'Pérou', DEFAULT),(99,'Malte', TRUE),
(100,'Il permet de préciser à qui on s''adresse', DEFAULT),(100,'Il permet de vouvoyer quelqu''un', TRUE),(100,'Il permet de rendre concret quelque chose qui est abstrait', DEFAULT),
(101,'Sujet + Gustar + COI', DEFAULT),(101,'COI + Gustar + Sujet', TRUE),(101,'Sujet + Gustar', DEFAULT),(101,'COI + Gustar + COI', DEFAULT),

-- LATIN
(102,'Indicatif Présent', DEFAULT),(102,'Subjonctif Présent', DEFAULT),(102,'Indicatif Parfait ', DEFAULT),(102,'Supin', TRUE),(102,'Infinitif', DEFAULT),
(103,'Féminin', DEFAULT),(103,'Neutre', TRUE),(103,'Masculin', DEFAULT),
(104,'a', DEFAULT),(104,'e', DEFAULT),(104,'i', TRUE),(104,'o', DEFAULT),(104,'u', DEFAULT),
(105,'Hic met en avant la proximité', TRUE),(105,'Ille indique que l''objet n''est plus là', DEFAULT),(105,'Ille a une connotation méliorative', TRUE),(105,'Hic indique un ensemble de quelque chose', DEFAULT),
(106,'Présent', DEFAULT),(106,'Imparfait', TRUE),(106,'Parfait', DEFAULT),(106,'Plus que parfait', DEFAULT),
(107,'Le radical se termine par 2 consonnes', TRUE),(107,'Le radical se termine par 2 voyelles', DEFAULT),(107,'Le mot est neutre', DEFAULT),(107,'Le mot est masculin', DEFAULT),(107,'Le mot est féminin', DEFAULT),

-- CONJUGAISON
(108,'1er Groupe', DEFAULT),(108,'2ème Groupe', DEFAULT),(108,'3ème Groupe', TRUE),(108,'C''est un auxiliaire', DEFAULT),
(109,'Saches', DEFAULT),(109,'Susses', TRUE),(109,'Seusses', DEFAULT),(109,'Saves', DEFAULT),
(110,'Indicatif Futur', TRUE),(110,'Subjonctif Passé', DEFAULT),(110,'Conditionnel Présent', TRUE),(110,'Participe Passé', DEFAULT),
(111,'Subjonctif Imparfait + participé passé', DEFAULT),(111,'Indicatif Passé + participé passé', DEFAULT),(111,'Condionnel Présent + participé passé', TRUE),
(112,'Dit', TRUE),(112,'Dis', DEFAULT),(112,'Di', DEFAULT),(112,'Die', DEFAULT),

-- GRAMMAIRE
(113,'Indicatif', TRUE),(113,'Subjonctif', DEFAULT),(113,'Conditionnel', TRUE),(113,'Gérondif', DEFAULT),
(114,'Lorsque le sujet n''est pas explicitement indiqué', DEFAULT),(114,'Dans une phrase avec un verbe à la voix passive', TRUE),(114,'Dans une proposition relative', DEFAULT),
(115,'Sous', DEFAULT),(115,'Donc', TRUE),(115,'Dans', DEFAULT),(115,'Sur', DEFAULT),(115,'Ou', TRUE),(115,'Ni', TRUE),
(116,'Avoir', DEFAULT),(116,'Aller', DEFAULT),(116,'Etre', TRUE),
(117,'Adjectif Quantitatif', DEFAULT),(117,'Adjectif Cardinal', DEFAULT),(117,'Adjectif Ordinal', TRUE),(117,'Adjectif Positionnel', DEFAULT),

-- ORTHOGRAPHE
(118,'Lorsque Vingt est tout seul', DEFAULT),(118,'Lorsque Vingt termine le nombre', TRUE),(118,'Lorsque Vingt est multiplié', TRUE),(118,'Lorsque Vingt est suivi d''un seul chiffre', DEFAULT),
(119,'Avec -ails', TRUE),(119,'Avec -ailx', DEFAULT),(119,'Avec -aus', DEFAULT),(119,'Avec -aux', DEFAULT),
(120,'bleu', DEFAULT),(120,'bleus', DEFAULT),(120,'bleue', DEFAULT),(120,'bleues', TRUE),
(121,'Sensé', DEFAULT),(121,'Censé', TRUE),(121,'Sans C', DEFAULT),
(122,'Or', DEFAULT),(122,'Ore', DEFAULT),(122,'Hors', TRUE),(122,'Hore', DEFAULT),

-- SVT
(123,'Le nombre de divisions successives effectuées', TRUE),(123,'La méiose ne concerne que les cellules germinales', TRUE),(123,'Il n''y a pas de différence notable', DEFAULT),
(124,'Les étamines', DEFAULT),(124,'Le pistil', TRUE),(124,'Les sépales', DEFAULT),(124,'Les pétales', DEFAULT),
(125,'Composée de 2 chaînes de nucléotides strictement identiques', DEFAULT),(125,'Composée de 2 chaînes de nucléotides complémentaires', TRUE),(125,'Contient l''information génétique', TRUE),(125,'Ne peut pas être transféré à un autre organisme', DEFAULT),
(126,'Une obsidienne', DEFAULT),(126,'Une andésite', DEFAULT),(126,'Un granite', DEFAULT),(126,'Un basalte', TRUE),
(127,'Le granite', DEFAULT),(127,'Le gabbro',TRUE),(127,'La pierre ponce', DEFAULT),(127,'La réticulite', DEFAULT),
(128,'La photosynthèse', TRUE),(128,'La photoreflexion', DEFAULT),(128,'La luminescence', DEFAULT),(128,'La phosphorescence', DEFAULT),
(129,'Le nerf sympathique', DEFAULT),(129,'Le nerf parasympathique', TRUE),(129,'Le nerf symptomathique', DEFAULT),(129,'Le nerf parasymptomathique', DEFAULT),

--PHYSIQUE CHIMIE
(130,'Astronomie', DEFAULT),(130,'Optique', TRUE),(130,'Mécanique', DEFAULT),(130,'Quantique', DEFAULT),
(131,'La première loi', TRUE),(131,'La seconde loi', DEFAULT),(131,'La troisième loi', DEFAULT),(131,'Aucune ne permet cela', DEFAULT),
(132,'Le bleu', DEFAULT),(132,'Le mauve', DEFAULT),(132,'Le vert', DEFAULT),(132,'Le jaune', DEFAULT),(132,'Le rouge', TRUE),(132,'L''orange', DEFAULT),
(133,'199 792 458 m / s', DEFAULT),(133,'299 792 458 m / s', TRUE),(133,'399 792 458 m / s', DEFAULT),(133,'499 792 458 m / s', DEFAULT),
(134,'A', DEFAULT),(134,'Z', DEFAULT),(134,'D', DEFAULT),(134,'T', DEFAULT),(134,'N', TRUE),
(135,'Solution Basique', TRUE),(135,'Solution Neutre', DEFAULT),(135,'Solution Acide', DEFAULT),(135,'Solution tempérée', DEFAULT);

INSERT INTO qcm (auteur,domaine,sous_domaine,note_total,visible,fini,description) values 
('Santini','Informatique','BDD',4,true,true,DEFAULT),
('Santini','Informatique','BDD',4,true,true,DEFAULT),

('Gayral','Informatique','PHP',6,true,true,'Qcm complet en php'),
('Gayral','Informatique','PHP',4,true,true,'QCM de révision pour php'),

('Avril','Informatique','JAVA',5,true,true,DEFAULT),
('Avril','Informatique','JAVA',3,true,true,DEFAULT),

('Santini','Informatique','C',4,true,true,DEFAULT),
('Santini','Informatique','C',3,true,true,DEFAULT),

('Gayral','Informatique','HTML',3,true,true,'QCM d introduction à l HTML'),
('Gayral','Informatique','HTML',5,true,true,'QCM complémentaire pour l HTML'),

('Charroux','Informatique','UML',3,true,true,DEFAULT),
('Charroux','Informatique','UML',4,true,true,DEFAULT),

('Buscaldi','Informatique','Linux',3,true,true,DEFAULT),
('Buscaldi','Informatique','Linux',4,true,true,DEFAULT),

('Avril','Informatique','Python',5,true,true,DEFAULT),
('Avril','Informatique','Python',3,true,true,DEFAULT),

('Hebert','Mathématiques','Algèbre',4,true,true,DEFAULT),
('Hebert','Mathématiques','Algèbre',4,true,true,DEFAULT),

('Hebert','Mathématiques','Géometrie',4,true,true,DEFAULT),
('Hebert','Mathématiques','Géometrie',3,true,true,DEFAULT),

('Hebert','Mathématiques','Cryptanalyse',4,true,true,DEFAULT),
('Hebert','Mathématiques','Cryptanalyse',3,true,true,DEFAULT),

('Hebert','Mathématiques','Graphes et langages',4,true,true,DEFAULT),
('Hebert','Mathématiques','Graphes et langages',3,true,true,DEFAULT),

('Noel','Culture Générale','Histoire',4,true,true,DEFAULT),
('Noel','Culture Générale','Histoire',3,true,true,DEFAULT),

('Noel','Culture Générale','Géographie',5,true,true,DEFAULT),
('Noel','Culture Générale','Géographie',4,true,true,DEFAULT),

('Noel','Culture Générale','Musique',5,true,true,DEFAULT),
('Noel','Culture Générale','Musique',4,true,true,DEFAULT),

('Noel','Culture Générale','Cinéma',3,true,true,DEFAULT),

('Martinez','Langues','Anglais',5,true,true,DEFAULT),
('Martinez','Langues','Anglais',4,true,true,DEFAULT),

('Desigual','Langues','Espagnol',3,true,true,DEFAULT),

('Daloz','Langues','Latin',5,true,true,DEFAULT),
('Daloz','Langues','Latin',4,true,true,DEFAULT),

('Ayme','Français','Conjugaison',5,true,true,DEFAULT),
('Ayme','Français','Conjugaison',3,true,true,DEFAULT),

('Ayme','Français','Grammaire',5,true,true,DEFAULT),
('Ayme','Français','Grammaire',3,true,true,DEFAULT),

('Ayme','Français','Orthographe',5,true,true,DEFAULT),
('Ayme','Français','Orthographe',4,true,true,DEFAULT),

('Mayeur','Sciences','SVT',5,true,true,DEFAULT),
('Mayeur','Sciences','SVT',4,true,true,DEFAULT),

('Dubois','Sciences','Physique Chimie',4,true,true,DEFAULT),
('Dubois','Sciences','Physique Chimie',4,true,true,DEFAULT),

('Gayral','Informatique',DEFAULT,10,true,true,'QCM global d informatique,parceque c est fun'),
('Gayral','Informatique',DEFAULT,10,true,true,DEFAULT),
('Noel','Culture Générale',DEFAULT,5,true,true,DEFAULT),
('Ayme','Français',DEFAULT,3,true,true,DEFAULT);

INSERT INTO qcm_question values 
--BDD
(1,1),(1,2),(1,3),(1,4),
(2,3),(2,4),(2,5),(2,6),

--PHP
(3,7),(3,8),(3,9),(3,10),(3,11),(3,12),
(4,7),(4,9),(4,10),(4,12),

--JAVA
(5,13),(5,14),(5,15),(5,16),(5,18),
(6,14),(6,15),(6,17),

--C
(7,19),(7,20),(7,23),(7,24),
(8,19),(8,21),(8,22),

--HTML
(9,25),(9,26),(9,27),
(10,27),(10,28),(10,29),(10,30),

--UML
(11,31),(11,33),(11,35),
(12,31),(12,32),(12,34),(12,36),

--LINUX
(13,38),(13,39),(13,42),
(14,37),(14,38),(14,40),(14,41),

--PYTHON
(15,43),(15,44),(15,45),(15,46),(15,47),
(16,43),(16,45),(16,47),

--ALGEBRE
(17,48),(17,50),(17,51),(17,53),
(18,49),(18,50),(18,52),(18,53),

--GEOMETRIE
(19,54),(19,55),(19,58),(19,59),
(20,55),(20,56),(20,57),

--CRYPTANALYSE
(21,60),(21,61),(21,63),(21,65),
(22,62),(22,63),(22,64),

--GRAPHE ET LANGAGES
(23,66),(23,68),(23,70),(23,71),
(24,66),(24,67),(24,69),

--HISTOIRE
(25,72),(25,73),(25,75),(25,77),
(26,74),(26,75),(26,76),

--GEOGRAPHIE
(27,78),(27,79),(27,80),(27,81),(27,82),
(28,79),(28,81),(28,82),(28,83),

--MUSIQUE
(29,84),(29,85),(29,86),(29,88),(29,89),
(30,85),(30,86),(30,87),(30,89),

--CINEMA
(31,90),(31,91),(31,92),

--ANGLAIS
(32,93),(32,94),(32,95),(32,97),(32,98),
(33,94),(33,95),(33,96),(33,98),

--ESPAGNOL
(34,99),(34,100),(34,101),

--LATIN
(35,102),(35,103),(35,104),(35,106),(35,107),
(36,103),(36,105),(36,106),(36,107),

--CONJUGAISON
(37,108),(37,109),(37,110),(37,111),(37,112),
(38,109),(38,110),(38,112),

--GRAMMAIRE
(39,113),(39,114),(39,115),(39,116),(39,117),
(40,113),(40,115),(40,116),

--ORTHOGRAPHE
(41,118),(35,119),(35,120),(35,121),(35,122),
(42,118),(36,120),(36,121),(36,122),

--SVT
(43,123),(43,124),(43,126),(43,127),(43,129),
(44,125),(44,126),(44,127),(44,128),

--PHYSIQUE CHIMIE
(45,130),(45,132),(45,133),(45,134),
(46,131),(46,132),(46,133),(46,135),

--GENERAL
(47,2),(47,5),(47,11),(47,14),(47,18),(47,22),(47,36),(47,37),(47,44),(47,47),
(48,1),(48,3),(48,6),(48,8),(48,9),(48,12),(48,16),(48,19),(48,23),(48,24),
(49,72),(49,73),(49,76),(49,79),(49,82),(49,83),(49,85),(49,89),(49,90),(49,92),
(50,106),(50,108),(50,111),(50,116),(50,117),(50,118),(50,121),(50,122);
