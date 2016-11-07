INSERT INTO questionneur values
(nextval('ID_QUESTIONNEUR'),'quest','quest',2); -- questionneur test

INSERT INTO repondeur values
(nextval('ID_REPONDEUR'),'rep','rep');  -- répondeur test

INSERT INTO domaine values
(nextval('ID_DOMAINE'),'Informatique'),(nextval('ID_DOMAINE'),'Mathématiques'),(nextval('ID_DOMAINE'),'Culture Générale'),(nextval('ID_DOMAINE'),'Médecine'),(nextval('ID_DOMAINE'),'Langues'),(nextval('ID_DOMAINE'),'Physique Chimie');

INSERT INTO sous_domaine values
(nextval('ID_SOUS_DOMAINE'),1,'BDD'),(nextval('ID_SOUS_DOMAINE'),1,'PHP'),(nextval('ID_SOUS_DOMAINE'),1,'JAVA'),(nextval('ID_SOUS_DOMAINE'),1,'C'),(nextval('ID_SOUS_DOMAINE'),1,'HTML'),
(nextval('ID_SOUS_DOMAINE'),2,'Algèbre'),(nextval('ID_SOUS_DOMAINE'),2,'Géometrie'),(nextval('ID_SOUS_DOMAINE'),3,'Histoire'),(nextval('ID_SOUS_DOMAINE'),3,'Cinéma'),
(nextval('ID_SOUS_DOMAINE'),4,'Neurologie'),(nextval('ID_SOUS_DOMAINE'),4,'Chirurgie'),(nextval('ID_SOUS_DOMAINE'),5,'Anglais'),(nextval('ID_SOUS_DOMAINE'),5,'Espagnol'),
(nextval('ID_SOUS_DOMAINE'),6,'Physique'),(nextval('ID_SOUS_DOMAINE'),6,'Chimie');

INSERT INTO question values
(nextval('ID_QUESTION'),'Qu''est ce qu''une clef étrangère ?'),(nextval('ID_QUESTION'),'Combien y a-t-il de formes normales en SQL ?'),(nextval('ID_QUESTION'),'Quelle instruction ne produit pas d''erreur de syntaxe ?'),
(nextval('ID_QUESTION'),'Qu''est ce que l''informatique ?'),(nextval('ID_QUESTION'),'Comment fonctionne un processeur ?'),(nextval('ID_QUESTION'),'Comment fonctionne un serveur ?'),
(nextval('ID_QUESTION'),'Quelles sont les balises pour utiliser le php ?'),(nextval('ID_QUESTION'),'Peut-on exécuter du code php depuis un navigateur ?'),(nextval('ID_QUESTION'),'Que signifie l''acronyme PHP ?'),
(nextval('ID_QUESTION'),'Quelle la principale différence entre le Java et le C ?'),(nextval('ID_QUESTION'),'De combien de Classe peut-on hériter ?'),(nextval('ID_QUESTION'),'Qu''est ce qu''une interface ?'),
(nextval('ID_QUESTION'),'Quel est l''instruction de retour par défaut ?'),(nextval('ID_QUESTION'),'Existe t-il un type boolean en langage C ?'),(nextval('ID_QUESTION'),'A quoi sert le symbole * ?'),
(nextval('ID_QUESTION'),'A quoi sert le langage HTML en informatique ?'),(nextval('ID_QUESTION'),'Avec quel autre langage utilise t-on très souvent l'' HTML ?'),(nextval('ID_QUESTION'),'Comment reconnait-on du code html ?'),
(nextval('ID_QUESTION'),'Quel est le nom de l''algèbre qui se base sur la logique ?'),(nextval('ID_QUESTION'),'Quels sont les trois opérateurs logiques ?'),(nextval('ID_QUESTION'),'Quel algorithme permet de résoudre un système à 3 équations ?'),
(nextval('ID_QUESTION'),'Comment appelle t-on un objet avec 7 sommets ?'),(nextval('ID_QUESTION'),'Combien d''arrêtes possède un cube ?'),(nextval('ID_QUESTION'),'Si deux plans sont sécants, comment appelle-t-on leur intersection ?'),
(nextval('ID_QUESTION'),'Quand a eu lieu la bataille de Waterloo ?'),(nextval('ID_QUESTION'),'Quel est le vrai nom de l''empereur romain Auguste ?'),(nextval('ID_QUESTION'),'Quelle est la date précise du début de la 2ème guerre mondiale pour la France ?'),
(nextval('ID_QUESTION'),'Dans quel film DiCaprio remporte-t-il son premier Oscar ?'),(nextval('ID_QUESTION'),'Quel est le film le plus rentable de l''Histoire du cinéma ?'),(nextval('ID_QUESTION'),'Quel est le premier long-métrage de Pixar créé uniquement par animation 3D ?'),
(nextval('ID_QUESTION'),'Q1neuro'),(nextval('ID_QUESTION'),'Q2neuro'),(nextval('ID_QUESTION'),'Q3neuro'),
(nextval('ID_QUESTION'),'Q1chir'),(nextval('ID_QUESTION'),'Q2chir'),(nextval('ID_QUESTION'),'Q3chir'),
(nextval('ID_QUESTION'),'Q1ang'),(nextval('ID_QUESTION'),'Q2ang'),(nextval('ID_QUESTION'),'Q3ang'),
(nextval('ID_QUESTION'),'Q1esp'),(nextval('ID_QUESTION'),'Q2esp'),(nextval('ID_QUESTION'),'Q3esp'),
(nextval('ID_QUESTION'),'Q1phys'),(nextval('ID_QUESTION'),'Q2phys'),(nextval('ID_QUESTION'),'Q3phys'),
(nextval('ID_QUESTION'),'Q1chim'),(nextval('ID_QUESTION'),'Q2chim'),(nextval('ID_QUESTION'),'Q3chim');

INSERT INTO qcm values
(nextval('ID_QCM'),'quest','18/10/2016','facile',20),
(nextval('ID_QCM'),'quest','05/11/2016','facile',20),
(nextval('ID_QCM'),'quest','05/11/2016','facile',20),
(nextval('ID_QCM'),'quest','05/11/2016','facile',20),
(nextval('ID_QCM'),'quest','05/11/2016','facile',20),
(nextval('ID_QCM'),'quest','05/11/2016','facile',20),
(nextval('ID_QCM'),'quest','05/11/2016','facile',20),
(nextval('ID_QCM'),'quest','05/11/2016','facile',20);

INSERT INTO qcm_question values
(1,1,'Informatique','BDD'),(1,2,'Informatique','BDD'),(1,3,'Informatique','BDD'),(1,4,'Informatique','PHP'),(1,5,'Informatique','PHP'),(1,6,'Informatique','PHP'),
(2,7,'Informatique','JAVA'),(2,8,'Informatique','JAVA'),(2,9,'Informatique','JAVA'),(2,10,'Informatique','C'),(2,11,'Informatique','C'),(2,12,'Informatique','C'),
(3,13,'Informatique','HTML'),(3,14,'Informatique','HTML'),(3,15,'Informatique','HTML'),(3,16,'Mathématiques','Algèbre'),(3,17,'Mathématiques','Algèbre'),(3,18,'Mathématiques','Algèbre'),
(4,19,'Mathématiques','Géometrie'),(4,20,'Mathématiques','Géometrie'),(4,21,'Mathématiques','Géometrie'),(4,22,'Culture Générale','Histoire'),(4,23,'Culture Générale','Histoire'),(4,24,'Culture Générale','Histoire'),
(5,25,'Culture Générale','Cinéma'),(5,26,'Culture Générale','Cinéma'),(5,27,'Culture Générale','Cinéma'),(5,28,'Médecine','Neurologie'),(5,29,'Médecine','Neurologie'),(5,30,'Médecine','Neurologie'),
(6,31,'Médecine','Chirurgie'),(6,32,'Médecine','Chirurgie'),(6,33,'Médecine','Chirurgie'),(6,34,'Langues','Anglais'),(6,35,'Langues','Anglais'),(6,36,'Langues','Anglais'),
(7,37,'Langues','Espagnol'),(7,38,'Langues','Espagnol'),(7,39,'Langues','Espagnol'),(7,40,'Physique Chimie','Physique'),(7,41,'Physique Chimie','Physique'),(7,42,'Physique Chimie','Physique'),
(8,43,'Physique Chimie',NULL),(8,44,'Physique Chimie',NULL),(8,45,'Physique Chimie',NULL);
