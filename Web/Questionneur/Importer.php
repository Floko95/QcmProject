<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		 <link rel="stylesheet" href="Importer.css" />
        <link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet">
	<title>Importer Question</title>
	</head>
<body> 
    
    
           	  <div id="desk-nav">
  <nav>
    <ul>
      <li><a href="AccueilQ.php">Home</a></li>
      <li><a href="Profil.php">Profil</a></li>
      <li><a href="ChoixQC.php">QCM</a></li>
      <li><a href="../Index.php">Déconnexion</a></li>
    </ul>
  </nav>
</div>

<div class="container cf">
  <div class="task-wrapper cf">
    <div class="the-days">
	
<?php


require_once('../Autres/Connexionbdd.php');
if (isset($_POST['idd']) and trim($_POST['idd']!='') and isset($_POST['desc']) and trim($_POST['desc'])!='')
{
	$req=$bdd->prepare("UPDATE qcm set description=:d where id_qcm = :id");
	$req->bindValue(':id',$_POST['idd']);
	$req->bindValue(':d',$_POST['desc']);
	$req->execute();
}

if (isset($_POST['idd']) and trim($_POST['idd']!=''))//id du qcm en cours de modification reçu
{
	$req=$bdd->prepare("SELECT distinct sous_domaine,domaine from qcm where id_qcm=:id");//on sélectionne le sous domaine et le domaine de ce qcm
	$req->bindValue(':id',$_POST['idqcm']);
	$req->execute();
	$ligne=$req->fetch(PDO::FETCH_ASSOC);
	
	
	echo '<h2> '.$ligne['sous_domaine'].' '.$ligne['domaine'].'</h2>'; //on les affiche
	
	if($ligne['sous_domaine']==null){//on sélectionne toutes les questions de la table de ce domaine
		
		$req=$bdd->prepare("Select distinct id_question,question from question natural join qcm_question natural join qcm where domaine=:domaine ");
		$req->bindValue(':domaine',$ligne['domaine']);
		
		$req->execute();	
	
	}else{//si le domaine n'est pas null,on sélectionne toutes les questions de la table de ce sous domaine inclus dans ce domaine 
		$req=$bdd->prepare("SELECT distinct id_question,question FROM question NATURAL JOIN qcm natural join qcm_question WHERE sous_domaine=:sdomaine and domaine=:domaine ");
		$req->bindValue(':sdomaine',$ligne['sous_domaine']);
		$req->bindValue(':domaine',$ligne['domaine']);
		
		$req->execute();
	}
	
	while($ligne=$req->fetch(PDO::FETCH_ASSOC))
		{
			
		$req2=$bdd->prepare("select * from qcm_question where id_qcm=:id");//on selectionne en parallele les questions déjà dans le qcm en cours
		$req2->bindValue(':id',$_POST['idd']);
		$req2->execute();
		$test=0;
			while($ligne2=$req2->fetch(PDO::FETCH_ASSOC))
			{
				if($ligne2['id_question']==$ligne['id_question'])
					$test=1;
			}
			if($test==0)//Si la question de la table est déjà dans le qcm en cours,on ne la propose pas à l'insertion.
			{
			echo '<form action="Visualisation.php" method="post">
				<input type="hidden" name="id" value="'.$_POST['idd'].'"/>';
				echo '<input type="hidden" name="q" value="'.$ligne['id_question'].'"/>
                
	<div class="notes-module cf">
          <ul id="notes-001" class="notes-list">
	
	
	
				<li></i><input type="submit" value="'.htmlspecialchars($ligne['question'],ENT_QUOTES).'"/></li></ul>';
				echo '</form>';//la question devient un bouton,envoyant sur visualisation.php
			}
			
		}

	
		
echo '<form class="notes-form" action="Questions.php" method="post"><input type="hidden" name="id" value="'.$_POST['idd'].'"/><input class="retour" type="submit" value="Retour"/></form>';	//si on change d'avis,on peut toujours retourner à questions.php
}
?>

		</div>
	  </div>
	</div>
	</div>
</body>
</html>
