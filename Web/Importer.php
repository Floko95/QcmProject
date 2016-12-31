<!DOCTYPE html>


<html>
	<head>
	<title>QCM-Importer</title>
	
	</head>
	
	
<body> 




<form action="Importer.php">
<p>Domaine:</p>
<input type="text" name="domaine" />
<p>Sous-Domaine:</p>
<input type="text" name="sdomaine" />
<input type="submit"/>
</form>
<?php


require_once('Connexionbdd.php');



if (isset($_POST['idd']) and trim($_POST['idd']!=''))
{
	$req=$bdd->prepare("SELECT distinct sous_domaine,domaine from qcm where id_qcm=:id");
	$req->bindValue(':id',$_POST['idd']);
	$req->execute();
	$ligne=$req->fetch(PDO::FETCH_ASSOC);
	if ($ligne['sous_domaine']=='')
	{
		$req=$bdd->prepare("SELECT * FROM question INNER JOIN qcm_question ON question.id_question = qcm_question.id_question INNER JOIN qcm ON qcm.id_qcm = qcm_question.id_qcm WHERE qcm.domaine = :domaine");
		$req->bindValue(':domaine',$ligne['domaine']);
		$req->execute();
		
	}
	else
	{
		$req=$bdd->prepare("SELECT * FROM public.question NATURAL JOIN public.qcm WHERE qcm.sous_domaine=:sdomaine and qcm.domaine=:domaine");
		$req->bindValue(':sdomaine',$ligne['sous_domaine']);
		$req->bindValue(':domaine',$ligne['domaine']);
		$req->execute();
	}
		
		while($ligne=$req->fetch(PDO::FETCH_ASSOC))
		{
			
			echo '<form action="Visualisation.php" method="post">
				<input type="hidden" name="id" value="'.$_POST['idd'].'"/>
				<input type="hidden" name="q" value="'.$ligne['id_question'].'"/>
				<input type="submit" value="'.$ligne['question'].'"/></form>';
			
		}

		
		
	
}
?>

</body>
</html>
