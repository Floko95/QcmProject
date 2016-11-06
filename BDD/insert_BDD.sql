INSERT INTO questionneur values
(nextval('questionneur_id_questionneur_seq'),'quest','quest',2); -- questionneur test

INSERT INTO repondeur values
(nextval('repondeur_id_repondeur_seq'),'rep','rep');  -- répondeur test

INSERT INTO domaine values
(nextval('domaine_id_domaine_seq'),'Informatique'),(nextval('domaine_id_domaine_seq'),'Mathématiques'),(nextval('domaine_id_domaine_seq'),'Culture Générale'),(nextval('domaine_id_domaine_seq'),'Médecine'),(nextval('domaine_id_domaine_seq'),'Langues'),(nextval('domaine_id_domaine_seq'),'Physique Chimie');

INSERT INTO sous_domaine values
(nextval('sous_domaine_id_sous_domaine_seq'),1,'BDD'),(nextval('sous_domaine_id_sous_domaine_seq'),1,'PHP'),(nextval('sous_domaine_id_sous_domaine_seq'),1,'JAVA'),(nextval('sous_domaine_id_sous_domaine_seq'),1,'C'),(nextval('sous_domaine_id_sous_domaine_seq'),1,'HTML'),
(nextval('sous_domaine_id_sous_domaine_seq'),2,'Algèbre'),(nextval('sous_domaine_id_sous_domaine_seq'),2,'Géometrie'),(nextval('sous_domaine_id_sous_domaine_seq'),3,'Histoire'),(nextval('sous_domaine_id_sous_domaine_seq'),3,'Cinéma'),
(nextval('sous_domaine_id_sous_domaine_seq'),4,'Neurologie'),(nextval('sous_domaine_id_sous_domaine_seq'),4,'Chirurgie'),(nextval('sous_domaine_id_sous_domaine_seq'),5,'Anglais'),(nextval('sous_domaine_id_sous_domaine_seq'),5,'Espagnol'),
(nextval('sous_domaine_id_sous_domaine_seq'),6,'Physique'),(nextval('sous_domaine_id_sous_domaine_seq'),6,'Chimie');

INSERT INTO question values
(nextval('question_id_question_seq'),'Qu''est ce qu''une clef étrangère ?'),(nextval('question_id_question_seq'),'Combien y a-t-il de formes normales en SQL ?'),(nextval('question_id_question_seq'),'Quelle instruction ne produit pas d''erreur de syntaxe ?'),
(nextval('question_id_question_seq'),'Quelles sont les balises pour utiliser le php ?'),(nextval('question_id_question_seq'),'Peut-on exécuter du code php depuis un navigateur ?'),(nextval('question_id_question_seq'),'Que signifie l''acronyme PHP ?'),
(nextval('question_id_question_seq'),'Quelle la principale différence entre le Java et le C ?'),(nextval('question_id_question_seq'),'De combien de Classe peut-on hériter ?'),(nextval('question_id_question_seq'),'Qu''est ce qu''une interface ?'),
(nextval('question_id_question_seq'),'Quel est l''instruction de retour par défaut ?'),(nextval('question_id_question_seq'),'Existe t-il un type boolean en langage C ?'),(nextval('question_id_question_seq'),'A quoi sert le symbole * ?'),
(nextval('question_id_question_seq'),'A quoi sert le langage HTML en informatique ?'),(nextval('question_id_question_seq'),'Avec quel autre langage utilise t-on très souvent l'' HTML ?'),(nextval('question_id_question_seq'),'Comment reconnait-on du code html ?'),
(nextval('question_id_question_seq'),'Quel est le nom de l''algèbre qui se base sur la logique ?'),(nextval('question_id_question_seq'),'Quels sont les trois opérateurs logiques ?'),(nextval('question_id_question_seq'),'Quel algorithme permet de résoudre un système à 3 équations ?'),
(nextval('question_id_question_seq'),'Comment appelle t-on un objet avec 7 sommets ?'),(nextval('question_id_question_seq'),'Combien d''arrêtes possède un cube ?'),(nextval('question_id_question_seq'),'Si deux plans sont sécants, comment appelle-t-on leur intersection ?'),
(nextval('question_id_question_seq'),'Quand a eu lieu la bataille de Waterloo ?'),(nextval('question_id_question_seq'),'Quel est le vrai nom de l''empereur romain Auguste ?'),(nextval('question_id_question_seq'),'Quelle est la date précise du début de la 2ème guerre mondiale pour la France ?'),
(nextval('question_id_question_seq'),'Dans quel film DiCaprio remporte-t-il son premier Oscar ?'),(nextval('question_id_question_seq'),'Quel est le film le plus rentable de l''Histoire du cinéma ?'),(nextval('question_id_question_seq'),'Quel est le premier long-métrage de Pixar créé uniquement par animation 3D ?'),
(nextval('question_id_question_seq'),'Q1neuro'),(nextval('question_id_question_seq'),'Q2neuro'),(nextval('question_id_question_seq'),'Q3neuro'),
(nextval('question_id_question_seq'),'Q1chir'),(nextval('question_id_question_seq'),'Q2chir'),(nextval('question_id_question_seq'),'Q3chir'),
(nextval('question_id_question_seq'),'Q1ang'),(nextval('question_id_question_seq'),'Q2ang'),(nextval('question_id_question_seq'),'Q3ang'),
(nextval('question_id_question_seq'),'Q1esp'),(nextval('question_id_question_seq'),'Q2esp'),(nextval('question_id_question_seq'),'Q3esp'),
(nextval('question_id_question_seq'),'Q1phys'),(nextval('question_id_question_seq'),'Q2phys'),(nextval('question_id_question_seq'),'Q3phys'),
(nextval('question_id_question_seq'),'Q1chim'),(nextval('question_id_question_seq'),'Q2chim'),(nextval('question_id_question_seq'),'Q3chim');

INSERT INTO qcm values
(nextval('qcm_id_qcm_seq'),'quest','18/10/2016','facile',20),
(nextval('qcm_id_qcm_seq'),'quest','05/11/2016','facile',20);


INSERT INTO qcm_question values
(1,1,'Informatique','BDD'),(1,2,'Informatique','BDD'),(1,3,'Informatique','BDD'),(1,4,'Informatique','PHP'),(1,5,'Informatique','PHP'),(1,6,'Informatique','PHP'),
(1,7,'Informatique','JAVA'),(1,8,'Informatique','JAVA'),(1,9,'Informatique','JAVA'),(1,10,'Informatique','C'),(1,11,'Informatique','C'),(1,12,'Informatique','C'),
(1,13,'Informatique','HTML'),(1,14,'Informatique','HTML'),(1,15,'Informatique','HTML'),(1,16,'Mathématiques','Algèbre'),(1,17,'Mathématiques','Algèbre'),(1,18,'Mathématiques','Algèbre'),
(1,19,'Mathématiques','Géometrie'),(1,20,'Mathématiques','Géometrie'),(1,21,'Mathématiques','Géometrie'),(1,22,'Culture Générale','Histoire'),(1,23,'Culture Générale','Histoire'),(1,24,'Culture Générale','Histoire'),
(1,25,'Culture Générale','Cinéma'),(1,26,'Culture Générale','Cinéma'),(1,27,'Culture Générale','Cinéma'),(1,28,'Médecine','Neurologie'),(1,29,'Médecine','Neurologie'),(1,30,'Médecine','Neurologie'),
(1,31,'Médecine','Chirurgie'),(1,32,'Médecine','Chirurgie'),(1,33,'Médecine','Chirurgie'),(1,34,'Langues','Anglais'),(1,35,'Langues','Anglais'),(1,36,'Langues','Anglais'),
(1,37,'Langues','Espagnol'),(1,38,'Langues','Espagnol'),(1,39,'Langues','Espagnol'),(1,40,'Physique Chimie','Physique'),(1,41,'Physique Chimie','Physique'),(1,42,'Physique Chimie','Physique'),
(1,43,'Physique Chimie','Chimie'),(1,44,'Physique Chimie','Chimie'),(1,45,'Physique Chimie','Chimie');
