Derni�re Modification BDD : 09/12/16


>> init_BDD.sql

+ ajout d'une relation Recap_Repondeur avec les statistiques pour chaque r�pondeur :
	+ id_repondeur
	+ id_qcm FOREIGN KEY 
	+ domaine FOREIGN KEY 
	+ sous_domaine FOREIGN KEY
	+ date_qcm_fait
	+ note_qcm
	+ temps_qcm
	+ PRIMARY KEY (id_repondeur, date_qcm_fait)
+ ajout de commentaires pour faciliter l'int�gration dans le code php
+ ajout de nb_qcm_fait ; moyenne ; temps_total dans la relation Repondeur
+ ajout d'un commentaire pour 

= modification du typage des variables de float � integer :
 	= question.temps 
	= qcm.temps_total
	= recap_repondeur.temps_qcm 
	= recap_repondeur.temps_total

- suppression de la relation Recapitulatif (redondance de donn�es avec Profil_Repondeur)
- suppression de quelques erreurs

>> reset_BDD.sql

+ ajout de la commande de suppression de la relation recap_repondeur 



Modification BDD : 04/12/16


>> init_BDD.sql

+ ajout d'un varchar explication dans la relation Question (null par d�faut)
+ ajout d'un boolean visible dans la relation QCM (false par d�faut)
+ ajout d'un boolean fini dans la relation QCM (false par d�faut)

= modification de date_creation dans la relation QCM pour qu'elle corresponde � la date actuelle lors de la cr�ation d'une question
= modification du niveau dans la relation QCM (Normal par d�faut)
= modification du temps_total dans la relation QCM
= modification de note_total dans la relation QCM

+ ajout de l'autorisation pour utiliser les sequences en tant que qcm_default
+ ajout de l'interdiction pour cr�er des tables et des sch�mas en tant que qcm_default

- suppression compl�te de la relation Question_Reponse
- suppression compl�te de la relation Statistique



>> insert_BDD.sql

- suppression de la date pour l'insertion dans la relation QCM
- suppression des questions qui n'avaient pas d'�nonc�
- suppression des liens correspondants dans la relation QCM_question
- suppression du copier-coller de niveau pour l'insertion dans la relation QCM


>> reset_BDD.sql

+ ajout de la commande de suppression du role qcm_default
- suppression compl�te des commandes concernant la relation Question_Reponse
- suppression compl�te des commandes concernant la relation Statistique