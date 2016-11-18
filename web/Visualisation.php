<!DOCTYPE html>


<html>
	<head>
	<title>QCM-Visualisation</title>
	
	</head>
	
	
<body> 
<?php 
require_once('Connexionbdd.php');
if(isset($_GET['q']) and trim($_GET['q']!=''))
{
	$req=$bdd->prepare("SELECT * FROM public.question NATURAL JOIN public.qcm_question WHERE id_question=:id");
	$req->bindValue(':id',$_GET['q']);
	$req->execute();
	$ligne=$req->fetch(PDO::FETCH_ASSOC);
		
			echo '<p>Question:'.$ligne['question'].'</p> <p>Domaine:'.$ligne['domaine'].'</p><p>Sous-domaine: '.$ligne['sous_domaine'].'</p>';
			
		
		if(isset($_GET['domaine']) and trim($_GET['domaine']!='') and isset($_GET['sdomaine']) and trim($_GET['sdomaine']!=''))
		{echo '<form action="Importer.php?domaine='.$_GET['domaine'].'&sdomaine='.$_GET['sdomaine'].'" method="post"><input type="hidden" name="idquest" value="'.$_GET['q'].'"/><input type="submit" value="Ajouter cette question à la liste de questions a Importer"/></form>';
	
	
		
		echo '<form action="Creation.php" method="post">
		<input type="hidden" name="domaine" value="'.$_GET['domaine'].'"/>';
		if($_GET['sdomaine']!='general')
		{
			echo '<input type="hidden" name="sdomaine" value="'.$_GET['sdomaine'].'"/>';
		}
		
		echo'<input type="hidden" name="question" 
									value="'.$ligne['id_question'].'"/>
									<input type="submit" value="Importer cette question" /></form>';
		}
	
	
}
?>
</body>
</html>
