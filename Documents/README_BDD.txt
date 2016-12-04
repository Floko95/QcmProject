Dernière Modification BDD : 04/12/16


>> init_BDD.sql

+ ajout d'un varchar explication dans la relation Question (null par défaut)
+ ajout d'un boolean visible dans la relation QCM (false par défaut)
+ ajout d'un boolean fini dans la relation QCM (false par défaut)

= modification de date_creation dans la relation QCM pour qu'elle corresponde à la date actuelle lors de la création d'une question
= modification du niveau dans la relation QCM (Normal par défaut)
= modification du temps_total dans la relation QCM
= modification de note_total dans la relation QCM

+ ajout de l'autorisation pour utiliser les sequences en tant que qcm_default
+ ajout de l'interdiction pour créer des tables et des schémas en tant que qcm_default

- suppression complète de la relation Question_Reponse
- suppression complète de la relation Statistique



>> insert_BDD.sql

- suppression de la date pour l'insertion dans la relation QCM
- suppression des questions qui n'avaient pas d'énoncé
- suppression des liens correspondants dans la relation QCM_question
- suppression du copier-coller de niveau pour l'insertion dans la relation QCM


>> reset_BDD.sql

+ ajout de la  du role qcm_default
- suppression complète de la relation Question_Reponse
- suppression complète de la relation Statistique