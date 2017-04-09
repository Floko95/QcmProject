/!\ CHANGEMENT DANS LA BDD /!\

GENERAL
- Suppression de la relation r�pondeur et questionneur
- Suppression des s�quences d�di�es � r�pondeur et questionneur
- Suppression des privil�ges d�di�es � r�pondeur et questionneur
- Modification pour la coh�rence suite aux remarques de M Hamdouni
- Appel aux fonctions de crypto incluses dans PostgreSQL (pour crypter les mdp)

RELATION QCM
- domaine (varchar) --> id_domaine (integer)
- sous_domaine (varchar) --> id_sous_domaine (integer) 
  Le syst�me de qcm g�n�ral reste le m�me
- auteur (varchar) --> id_utilisateur (integer)

RELATION RECAP REPONDEUR
- id_repondeur (integer) --> id_utilisateur (integer)
- Suppression des attributs domaines et sous_domaines (redondance d'infos car id_qcm permet de les d�terminer)

RELATION UTILISATEUR
- Fusion des relations r�pondeur et questionneur en une seule relation utilisateur :
	# id_utilisateur (integer) CLEF PRIMAIRE (avec la s�quence ID_UTILISATEUR)
	# login (varchar) UNIQUE
	# password (text) UNIQUE
	# role (varchar) PAR DEFAUT 'repondeur'
	# nb_qcm_fait (integer) PAR DEFAUT 0
	# temps_total (integer) PAR DEFAUT NULL
	# moyenne (float) PAR DEFAUT NULL
- Les valeurs de password sont crypt�es en BlowFish /8 gr�ce aux fonctions pr�sentes dans pgcrypto : crypt() et gen_salt()
  Plus d'info sur https://www.postgresql.org/docs/9.6/static/pgcrypto.html
- Pour l'authentification dans le code php, il faut sauvegarder les saisies utilisateurs dans des variables puis utiliser la requete
  SELECT * FROM utilisateur WHERE login = $user AND password = crypt($mdp,password);
- Pour le role, vous pouvez attribuer la bonne partie du site en fonction de ce que retourne la requ�te pr�c�dente
- Pas de boolean au cas o� vous auriez besoin d'un autre role (genre mod�rateur du site, correcteur, etc...)

MODIFICATION DU SCRIPT INSERT ET RESET EN CONCORDANCE AVEC LES CHANGEMENTS CI-DESSUS