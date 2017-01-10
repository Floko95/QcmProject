<!DOCTYPE html>


<html>
	<head>
	<title>Créer_Domaine</title>
	
	</head>
	
	
<body> 


<?php 
require_once('Connexionbdd.php');

	if(isset($_POST['bouton']) and $_POST['bouton']=='Créer Domaine'){			//si le questionneur a choisi de créer un domaine
																				//formulaire qui conduit sur la même page et prend en parmètre le nom de domaine entré
		echo "<form action='CreerDomaine.php' method='post'>					
			<p>Nom du domaine à créer : </p>
			<input type='text' name='domainec'/>
			<input type='submit' value='Créer domaine'/></form>";
		echo"<form action='ChoixQC.php'><input type=submit value='Retour'/></form>";		//bouton de retour si le questionneur change d'avis- 
	
	}else if(isset($_POST['sbouton']) and $_POST['sbouton']=='Créer Sous-domaine' and isset($_POST['domaine']) and trim($_POST['domaine']!='')){ //si il a choisi de créer un sous-domaine
																				//formulaire qui conduit sur la même page et prend en parmètre le nom de sous-domaine entré
		echo "<form action='CreerDomaine.php' method='post'>
			<p>Nom du sous-domaine à créer dans le domaine:".$_POST['domaine']."</p>
			<input type='text' name='sdomainec'/>
			<input type='hidden' name='do' value='".$_POST['domaine']."'/>
			<input type='submit' value='Créer sous-domaine'/></form>";
		echo"<form action='ChoixQC.php'><input type=submit value='Retour'/></form>";		//bouton de retour si le questionneur change d'avis
	}

	if(isset($_POST['domainec']) and trim($_POST['domainec'])){						//si le questionneur a créé un domaine
	
		$req=$bdd->prepare("INSERT INTO domaine(domaine) values (:dom)");			//insertion du domaine dans la base 
		$req->bindValue(':dom',$_POST['domainec']);
		$req->execute();
		echo'<p>Le domaine '. $_POST['domainec'].' a bien été créé.</p>'; 
		echo"<form action='ChoixQC.php'><input type=submit value='Retour'/></form>";
	}

	if(isset($_POST['sdomainec']) and trim($_POST['sdomainec'])){					//si le questionneur a créé un sous-domaine
		
		$req1=$bdd->prepare("SELECT id_domaine FROM domaine WHERE domaine=:dom");			//récupération du domaine auquel le sous-domaine se rapporte
		$req1->bindValue(':dom',$_POST['do']);
		$req1->execute();
		$ligne=$req1->fetch(PDO::FETCH_ASSOC);
		
		$req=$bdd->prepare("INSERT INTO sous_domaine (id_domaine,sous_domaine) values (:do,:sdom)");	//insertion du sous-domaine et du domaine auquel il appartient dans la base 
		$req->bindValue(':do',$ligne['id_domaine']);
		$req->bindValue(':sdom',$_POST['sdomainec']);
		$req->execute();
		echo'<p>Le domaine '. $_POST['sdomainec'].' a bien été créé dans le domaine '.$_POST['do'].'.</p>';
		echo"<form action='ChoixQC.php'><input type=submit value='Retour'/></form>";	
	}
	
?>
</body>
</html>
